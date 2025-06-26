<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  use HasFactory;
  protected $table = 'pegawai';
  protected $fillable = ['nama_pegawai', 'user_id', 'departemen_id','tempat_lahir','tanggal_lahir','jenis_kelamin'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function departemen()
  {
    return $this->belongsTo(Departemen::class);
  }
}
