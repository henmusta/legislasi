<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislasi extends Model
{
    use HasFactory;
    protected $table = 'legislasi';
    protected $fillable = [
     'judul',
     'pengusul_id',
     'deskripsi',
     'tahapan_id',
     'keterangan'
   ];

   public function pengusul()
   {
     return $this->belongsTo(Pengusul::class, 'pengusul_id');
   }

   public function Tahapan()
   {
     return $this->belongsTo(TahapanLegislasi::class, 'tahapan_id');
   }
}
