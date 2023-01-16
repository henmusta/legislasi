<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapanLegislasi extends Model
{
    use HasFactory;
    protected $table = 'tahapanlegislasi';
    protected $fillable = [
     'name',
     'badge',
     'icon',
   ];

   public function agenda()
   {
     return $this->hasMany(Agenda::class, 'tahapan_id')->with('agendafile');
   }

   public function legislasi()
   {
     return $this->hasMany(Legislasi::class, 'tahapan_id');
   }
//    public function legislasi()
//    {
//      return $this->belongsToMany(Legislasi::class);
//    }

}
