<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $fillable = [
        'menu_agenda_id',
        'status',
        'keterangan',
    ];
    public function menu_agenda()
  {
    return $this->belongsTo(Menu_agenda::class);
  }
}
