<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;
    protected $table = 'slider_image';
    protected $fillable = [
     'judul',
     'deskripsi',
     'image',
     'menu_permission_id',
     'urut',
   ];

   public function menupermission()
   {
     return $this->belongsTo(MenuPermission::class, 'menu_permission_id');
   }

}

