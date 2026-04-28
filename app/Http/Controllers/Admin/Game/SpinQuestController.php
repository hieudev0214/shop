<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InventoryVar;
use App\Models\SpinQuest;
use Helper;
use Illuminate\Http\Request;

class SpinQuestController extends Controller
{
  public function index()
  {
    $spinQuests    = SpinQuest::all();
    $categories    = Category::where('status', true)->get();
    $inventoryVars = InventoryVar::where('is_active', true)->orderBy('id', 'desc')->get();

    return view('admin.game.spin-quest.index', compact('spinQuests', 'categories', 'inventoryVars'));
  }

  public function store(Request $request)
  {
    $payload = $request->validate([
      'name'         => 'required|string',
      'cover'        => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'button_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'price'        => 'required|integer',
      'status'       => 'required|boolean',
      'invar_id'     => 'nullable|integer|exists:inventory_vars,id',
      'category_id'  => 'nullable|integer|exists:categories,id',
    ]);

    if ($request->hasFile('cover')) {
      $payload['cover'] = Helper::uploadFile($request->file('cover'), 'public');
    }

    if ($request->hasFile('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'public');
    }

    if ($request->hasFile('button_image')) {
      $payload['button_image'] = Helper::uploadFile($request->file('button_image'), 'public');
    }

    $payload['prizes'] = [];

    $spin = SpinQuest::create($payload);

    Helper::addHistory("Tạo vòng quay mới ($spin->name)");

    return redirect()->back()->with('success', 'Tạo vòng quay thành công');
  }

  public function show($id)
  {
    $spinQuest     = SpinQuest::findOrFail($id);
    $categories    = Category::where('status', true)->get();
    $inventoryVars = InventoryVar::where('is_active', true)->orderBy('id', 'desc')->get();

    return view('admin.game.spin-quest.show', compact('spinQuest', 'categories', 'inventoryVars'));
  }

  public function update(Request $request)
  {
    $payload = $request->validate([
      'id'           => 'required|integer',
      'name'         => 'required|string',
      'type'         => 'required|string',
      'cover'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'button_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
      'descr'        => 'nullable|string',
      'price'        => 'required|integer',
      'status'       => 'required|boolean',
      'store_id'     => 'nullable|integer',
      'invar_id'     => 'nullable|integer|exists:inventory_vars,id',
      'category_id'  => 'nullable|integer|exists:categories,id',
    ]);

    $spinQuest = SpinQuest::findOrFail($payload['id']);

    if ($request->hasFile('cover')) {
      $payload['cover'] = Helper::uploadFile($request->file('cover'), 'public');
    } else {
      $payload['cover'] = $spinQuest->cover;
    }

    if ($request->hasFile('image')) {
      $payload['image'] = Helper::uploadFile($request->file('image'), 'public');
    } else {
      $payload['image'] = $spinQuest->image;
    }

    if ($request->hasFile('button_image')) {
      $payload['button_image'] = Helper::uploadFile($request->file('button_image'), 'public');
    } else {
      $payload['button_image'] = $spinQuest->button_image;
    }

    $payload['descr'] = Helper::htmlPurifier($payload['descr'] ?? '');

    $spinQuest->update($payload);

    Helper::addHistory("Cập nhật vòng quay ($spinQuest->name)");

    return redirect()->back()->with('success', 'Cập nhật vòng quay thành công');
  }

  public function updatePrize(Request $request)
  {
    $payload = $request->validate([
      'id'     => 'required|integer',
      'prizes' => 'required|array',
    ]);

    $spinQuest = SpinQuest::findOrFail($payload['id']);

    $prizes = [];

    foreach ($payload['prizes'] as $prize) {
      $prize['value'] = $prize['value'] == '' ? 0 : $prize['value'];
      $prize['percent'] = $prize['percent'] == '' ? 0 : $prize['percent'];

      if (!is_numeric($prize['value'])) {
        $range = explode('-', $prize['value']);

        if (count($range) == 2) {
          $prize['min']    = $range[0];
          $prize['max']    = $range[1];
          $prize['random'] = true;
        }
      } else {
        $prize['min']    = $prize['value'];
        $prize['max']    = $prize['value'];
        $prize['random'] = false;
      }

      $prize['game_invar_id'] = $prize['game_invar_id'] ?? null;

      $prizes[] = $prize;
    }

    $spinQuest->update([
      'prizes' => $prizes,
    ]);

    Helper::addHistory("Cập nhật giải thưởng vòng quay ($spinQuest->name)");

    return redirect()->back()->with('success', 'Cập nhật giải thưởng thành công');
  }
}