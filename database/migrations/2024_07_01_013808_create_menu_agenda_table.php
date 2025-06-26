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
    Schema::create('menu_agenda', function (Blueprint $table) {
      $table->id();
      $table->unsignedBiginteger('schedule_id');
      $table->unsignedBiginteger('kategori_id');
      $table->unsignedBiginteger('user_id');
      $table->string('judul');
      $table->text('latar_belakang_keputusan');
      $table->string('keputusan_komite');
      $table->string('tempat');
      $table->string('biaya');
      $table->string('rincian_biaya');
      $table->string('panitia');
      $table->string('peserta');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('menu_agenda');
  }
};
