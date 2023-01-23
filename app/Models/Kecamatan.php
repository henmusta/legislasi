<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $fillable = [
     'kabupaten_id',
     'name',
   ];



   public function kabupaten()
   {
     return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
   }

   public function users()
   {
     return $this->belongsToMany(User::class);
   }

}
