<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaFile extends Model
{
    use HasFactory;
    protected $table = 'agenda_file';
    protected $fillable = [
     'name',
     'agenda_id',
     'legislasi_id',
     'keterangan',
   ];

   public function agenda()
   {
     return $this->belongsToMany(User::class);
   }
}
