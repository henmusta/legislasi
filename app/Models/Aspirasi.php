<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';
    protected $fillable = [
        'tgl_buat', 
        'nik', 
        'name', 	
        'telp',
        'kabupaten_id', 	
        'kecamatan_id',	
        'alamat', 
        'aspirasi', 	
        'komisi',
        'isu', 
        'urusan',
        'skpd_id', 
        'anggaran', 
        'lampiran', 
        'sasaran',
        'dewan_id',
   ];

   public function skpd()
   {
     return $this->belongsTo(Skpd::class, 'skpd_id');
   }
   
   public function dewan()
   {
     return $this->belongsTo(Dewan::class, 'dewan_id');
   }

   public function kecamatan()
   {
     return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
   }

   public function kabupaten()
   {
     return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
   }
}
