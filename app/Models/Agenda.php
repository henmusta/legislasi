<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agenda';
    protected $fillable = [
     'judul',
     'deskripsi',
     'tahapan_id',
     'legislasi_id'
   ];

   public function agendafile()
   {
     return $this->hasMany(AgendaFile::class);
   }

   public function legislasi()
   {
     return $this->belongsTo(Legislasi::class, 'legislasi_id');
   }
   public function Tahapan()
   {
     return $this->belongsTo(TahapanLegislasi::class, 'tahapan_id');
   }
}
