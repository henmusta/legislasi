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
        'user_id',
        'nik',
        'name',
        'telp',
        'kabupaten',
        'kecamatan',
        'alamat',
        'aspirasi',
        'komisi',
        'isu',
        'urusan',
        'skpd',
        'anggaran',
        'lampiran',
        'sasaran',
        'dewan',
   ];

   public function get_skpd()
   {
     return $this->belongsTo(Skpd::class, 'skpd');
   }

   public function get_dewan()
   {
     return $this->belongsTo(Dewan::class, 'dewan');
   }

   public function get_kecamatan()
   {
     return $this->belongsTo(Kecamatan::class, 'kecamatan');
   }

   public function get_kabupaten()
   {
     return $this->belongsTo(Kabupaten::class, 'kabupaten');
   }
}
