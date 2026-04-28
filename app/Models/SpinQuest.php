<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinQuest extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'type',
    'unit',
    'price',
    'cover',
    'descr',
    'image',
    'prizes',
    'status',
    'priority',
    'store_id',
    'invar_id',
    'play_times',
    'category_id',
    'button_image',
  ];

  protected $casts = [
    'status'     => 'boolean',
    'prizes'     => 'array',
    'play_times' => 'integer',
  ];

  public function store()
  {
    return $this->belongsTo(Group::class);
  }

  public function canPlay()
  {
    $arr = $this->prizes ?? [];
    $totalPercent = 0;

    foreach ($arr as $item) {
      $totalPercent += (int) ($item['percent'] ?? 0);
    }

    return $totalPercent > 0;
  }

  public function playGame($test = false)
  {
    $items = $this->prizes ?? [];

    /*
    |--------------------------------------------------------------------------
    | 🎯 CHƠI THỬ (FAKE GIẢI TO)
    |--------------------------------------------------------------------------
    */
    if ($test) {
  $fakeRewards = [
    ['value' => 9999, 'location' => 360],
    ['value' => 99,   'location' => 320],
    ['value' => 899,  'location' => 270],
    ['value' => 1299, 'location' => 230],
    ['value' => 3999, 'location' => 180],
    ['value' => 5999, 'location' => 130],
    ['value' => 7999, 'location' => 85],
  ];

  $fake = $fakeRewards[array_rand($fakeRewards)];

  return [
    'data' => [
      'value' => $fake['value'],
      'label' => number_format($fake['value'], 0, ',', '.') . ' KC',
    ],
    'location' => $fake['location'],
  ];
}

    /*
    |--------------------------------------------------------------------------
    | 🎯 CHƠI THẬT (THEO TỈ LỆ ADMIN)
    |--------------------------------------------------------------------------
    */
    $weightedItems = [];

    foreach ($items as $index => $item) {
      $percent = (int) ($item['percent'] ?? 0);

      if ($percent <= 0) continue;

      for ($i = 0; $i < $percent; $i++) {
        $weightedItems[] = $index;
      }
    }

    if (empty($weightedItems)) {
      return [
        'data' => null,
        'location' => null,
      ];
    }

    $randomIndex = $weightedItems[array_rand($weightedItems)] + 1;
    $location = $this->getLocationByIndex($randomIndex);

    return [
      'data' => $items[$randomIndex - 1] ?? null,
      'location' => $location,
    ];
  }

  private function getLocationByIndex($randomIndex)
  {
    switch ((string) $randomIndex) {
      case '1': return 360;
      case '2': return 320;
      case '3': return 270;
      case '4': return 230;
      case '5': return 180;
      case '6': return 130;
      case '7': return 85;
      case '8': return 44;
      default: return null;
    }
  }

  public function inventoryVar()
  {
    return $this->belongsTo(InventoryVar::class, 'invar_id');
  }
}