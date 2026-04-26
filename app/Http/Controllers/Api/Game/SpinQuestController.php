<?php

namespace App\Http\Controllers\Api\Game;

use App\Http\Controllers\Controller;
use App\Models\InventoryLog;
use App\Models\InventoryVar;
use App\Models\SpinQuest;
use App\Models\SpinQuestLog;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class SpinQuestController extends Controller
{
  public function turn(Request $request)
  {
    $payload = $request->validate([
      'id' => 'required|integer',
    ]);

    $user = User::findOrFail(auth()->user()->id);
    $spinQuest = SpinQuest::where('id', $payload['id'])->where('status', true)->firstOrFail();

    if ($spinQuest->canPlay() !== true) {
      return response()->json([
        'status' => 400,
        'message' => 'Trò chơi đang bảo trì, vui lòng thử lại sau #1',
      ], 400);
    }

    if ($user->balance < $spinQuest->price) {
      return response()->json([
        'status' => 400,
        'message' => 'Số dư không đủ để chơi trò chơi này, vui lòng nạp thêm.',
      ], 400);
    }

    $result = $spinQuest->playGame();

    if (
      !isset($result['data']) ||
      $result['data'] === null ||
      !isset($result['data']['value'])
    ) {
      return response()->json([
        'status' => 400,
        'message' => 'Trò chơi đang bảo trì hoặc thiếu dữ liệu phần thưởng #2',
        'debug' => $result,
      ], 400);
    }

    $unit = Helper::getConfig('mng_withdraw') ?? null;
    $type = 'legacy';

    $gameInvarId = $result['data']['game_invar_id'] ?? null;

    if ($gameInvarId) {
      $unit = InventoryVar::find($gameInvarId);

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng inventory #3',
        ], 400);
      }

      $type = 'inventory';
    } elseif ($spinQuest->invar_id) {
      $unit = $spinQuest->inventoryVar;

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng inventory #4',
        ], 400);
      }

      $type = 'inventory';
    } else {
      $unit = $unit['unit'] ?? null;

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng legacy #5',
        ], 400);
      }

      $type = 'legacy';
    }

    if (!$user->decrement('balance', $spinQuest->price)) {
      return response()->json([
        'status' => 400,
        'message' => 'Không thể thực hiện trừ tiền trong tài khoản của bạn #6',
      ], 400);
    }

    $kqNhan = $result['data']['value'];
    $spinQuest->increment('play_times', 1);

    if (!is_numeric($kqNhan)) {
      $exp = explode('-', $kqNhan);

      if (count($exp) === 2 && is_numeric($exp[0]) && is_numeric($exp[1])) {
        $kqNhan = mt_rand((int)$exp[0], (int)$exp[1]);
      } else {
        $user->increment('balance', $spinQuest->price);

        return response()->json([
          'status' => 400,
          'message' => 'Không xử lý được dữ liệu nhận được từ trò chơi này #7',
        ], 400);
      }
    }

    if ($type === 'legacy') {
      $user->transactions()->create([
        'code' => 'MNG-' . Helper::randomString(7, true),
        'amount' => $spinQuest->price,
        'cost_amount' => 0,
        'balance_after' => $user->balance,
        'balance_before' => $user->balance + $spinQuest->price,
        'type' => 'play-game',
        'extras' => [
          'id' => $spinQuest->id,
          'type' => 'spin-quest',
        ],
        'status' => 'paid',
        'content' => "Chơi trò chơi {$spinQuest->name}, rev: {$kqNhan} {$unit}",
        'user_id' => $user->id,
        'username' => $user->username,
      ]);

      $user->increment('balance_2', $kqNhan);

      $content = "Bạn đã nhận được {$kqNhan} {$unit} từ trò chơi này!";
    } else {
      $user->transactions()->create([
        'code' => 'MNG-' . Helper::randomString(7, true),
        'amount' => $spinQuest->price,
        'cost_amount' => 0,
        'balance_after' => $user->balance,
        'balance_before' => $user->balance + $spinQuest->price,
        'type' => 'play-game',
        'extras' => [
          'id' => $spinQuest->id,
          'type' => 'spin-quest',
        ],
        'status' => 'paid',
        'content' => "Chơi trò chơi {$spinQuest->name}, rev: {$kqNhan} {$unit->unit}",
        'user_id' => $user->id,
        'username' => $user->username,
      ]);

      $inventoryStock = $user->inventories()->where('var_id', $unit->id)->first();

      if ($inventoryStock === null) {
        $inventoryStock = $user->inventories()->create([
          'name' => $unit->name,
          'value' => 0,
          'var_id' => $unit->id,
          'user_id' => $user->id,
          'username' => $user->username,
          'is_active' => true,
        ]);
      }

      $inventoryStock->increment('value', $kqNhan);
      $inventoryStock->refresh();

      $content = 'Bạn đã quay trúng ' . number_format($kqNhan, 0, ',', '.') . ' ' . $unit->unit . '!';

      InventoryLog::create([
        'unit' => $unit->unit,
        'unit_id' => $unit->id,
        'type' => 'spin',
        'value' => $kqNhan,
        'content' => $content,
        'after_value' => $inventoryStock->value,
        'before_value' => $inventoryStock->value - $kqNhan,
        'user_id' => $user->id,
        'username' => $user->username,
        'source' => 'lucky_wheel',
        'source_id' => $spinQuest->id,
      ]);
    }

    SpinQuestLog::create([
      'unit' => $type === 'legacy' ? $unit : $unit->unit,
      'prize' => $kqNhan,
      'price' => $spinQuest->price,
      'status' => 'Completed',
      'content' => $content,
      'user_id' => $user->id,
      'username' => $user->username,
      'is_fake_data' => false,
      'spin_quest_id' => $spinQuest->id,
    ]);

    return response()->json([
      'status' => 200,
      'message' => $content,
      'location' => $result['location'] ?? null,
    ]);
  }

  public function turnTest(Request $request)
  {
    $payload = $request->validate([
      'id' => 'required|integer',
    ]);

    $user = User::findOrFail(auth()->user()->id);
    $spinQuest = SpinQuest::where('id', $payload['id'])->where('status', true)->firstOrFail();

    $lock = SpinQuestLog::where('user_id', $user->id)
      ->where('created_at', '>=', now()->subMinutes(15))
      ->where('is_fake_data', true)
      ->count();

    if ($lock > 7) {
      return response()->json([
        'status' => 400,
        'message' => 'Vui lòng không spam trò chơi này, hãy thử lại sau 15 phút.',
      ], 400);
    }

    if ($spinQuest->canPlay() !== true) {
      return response()->json([
        'status' => 400,
        'message' => 'Trò chơi đang bảo trì, vui lòng thử lại sau #1',
      ], 400);
    }

    $result = $spinQuest->playGame(true);

    if (
      !isset($result['data']) ||
      $result['data'] === null ||
      !isset($result['data']['value'])
    ) {
      return response()->json([
        'status' => 400,
        'message' => 'Trò chơi đang bảo trì hoặc thiếu dữ liệu phần thưởng #2',
        'debug' => $result,
      ], 400);
    }

    $unit = Helper::getConfig('mng_withdraw') ?? null;
    $type = 'legacy';

    $gameInvarId = $result['data']['game_invar_id'] ?? null;

    if ($gameInvarId) {
      $unit = InventoryVar::find($gameInvarId);

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng inventory #3',
        ], 400);
      }

      $type = 'inventory';
    } elseif ($spinQuest->invar_id) {
      $unit = $spinQuest->inventoryVar;

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng inventory #4',
        ], 400);
      }

      $type = 'inventory';
    } else {
      $unit = $unit['unit'] ?? null;

      if (!$unit) {
        return response()->json([
          'status' => 400,
          'message' => 'Không có dữ liệu phần thưởng legacy #5',
        ], 400);
      }

      $type = 'legacy';
    }

    $kqNhan = $result['data']['value'];
    $spinQuest->increment('play_times', 1);

    if (!is_numeric($kqNhan)) {
      $exp = explode('-', $kqNhan);

      if (count($exp) === 2 && is_numeric($exp[0]) && is_numeric($exp[1])) {
        $kqNhan = mt_rand((int)$exp[0], (int)$exp[1]);
      } else {
        return response()->json([
          'status' => 400,
          'message' => 'Không xử lý được dữ liệu nhận được từ trò chơi này #6',
        ], 400);
      }
    }

    if ($type === 'legacy') {
      $content = "Bạn đã nhận được {$kqNhan} {$unit} từ trò chơi này!";
    } else {
      $content = 'Bạn đã quay trúng ' . number_format($kqNhan, 0, ',', '.') . ' ' . $unit->unit . '!';
    }

    return response()->json([
      'status' => 200,
      'message' => $content,
      'location' => $result['location'] ?? null,
    ]);
  }
}