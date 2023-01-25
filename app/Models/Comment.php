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



   public function legislasi()
   {
     return $this->belongsTo(Legislasi::class);
   }

}
