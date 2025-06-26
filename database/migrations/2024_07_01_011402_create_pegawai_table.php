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
    Schema::create('pegawai', function (Blueprint $table) {
      $table->id();
      $table->string('nama_pegawai');
      $table->unsignedBiginteger('user_id');
      $table->unique('user_id');
      $table->unsignedBiginteger('departemen_id');
      $table->string('tempat_lahir');
      $table->date('tanggal_lahir');
      $table->string('jenis_kelamin');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  
  public function down(): void
  {
    Schema::dropIfExists('pegawai');
  }
};
