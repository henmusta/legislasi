<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dewan extends Model
{
    use HasFactory;
    protected $table = 'dewan';
    protected $fillable = [
     'name',
     'deskripsi',
   ];



}
