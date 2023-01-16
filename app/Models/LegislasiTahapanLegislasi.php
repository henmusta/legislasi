<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegislasiTahapanLegislasi extends Model
{
    use HasFactory;
    protected $table = 'legislasi_tahapanlegislasi';
    protected $fillable = [
     'legislasi_id',
     'tahapan_legislasi_id',
     'keterangan'
   ];


//    public function Tahapan()
//    {
//      return $this->belongsTo(TahapanLegislasi::class, 'tahapan_id');
//    }
}
