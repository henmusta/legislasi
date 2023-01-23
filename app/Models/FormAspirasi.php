<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAspirasi extends Model
{
    use HasFactory;
    protected $table = 'form_aspirasi';
    protected $fillable = [
     'name',
     'status'
   ];

}
