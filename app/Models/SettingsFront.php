<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsFront extends Model
{
    use HasFactory;
    protected $table = 'settings_front';
    protected $fillable = [
     'name',
     'icon',
     'sidebar_logo',
     'favicon',
   ];
}
