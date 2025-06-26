<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_agenda extends Model
{
  use HasFactory;
  protected $table = 'menu_agenda';
  protected $fillable = [
    'schedule_id',
    'kategori_id',
    'user_id',
    'judul',
    'latar_belakang_keputusan',
    'keputusan_komite',
    'tempat',
    'biaya',
    'rincian_biaya',
    'panitia',
    'peserta',
  ];
  public function kategori()
  {
    return $this->belongsTo(Kategori::class);
  }
   public function user()
  {
    return $this->belongsTo(User::class);
  }
}
