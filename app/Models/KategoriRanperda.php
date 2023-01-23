<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRanperda extends Model
{
    use HasFactory;
    protected $table = 'kategoriranperda';
    protected $fillable = [
     'name',
     'deskripsi',
   ];



}
