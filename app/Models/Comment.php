<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
     'parent_id',
     'legislasi_id',
     'user_id',
     'name',
     'email',
     'nik',
     'telp',
     'comment',
     'status',
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
