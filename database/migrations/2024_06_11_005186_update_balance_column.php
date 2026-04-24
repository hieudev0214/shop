<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('users', function (Blueprint $table) {
      // update column
      $table->decimal('balance', 11, 2)->default(0)->change();
      $table->decimal('balance_1', 11, 2)->default(0)->change();
      $table->decimal('balance_2', 11, 2)->default(0)->change();
      $table->decimal('total_deposit', 11, 2)->default(0)->change();
      $table->decimal('total_withdraw', 11, 2)->default(0)->change();
      $table->decimal('colla_balance', 11, 2)->default(0)->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('spin_quest_logs', function (Blueprint $table) {
      //
      $table->dropColumn('is_fake_data');
    });
  }
};
