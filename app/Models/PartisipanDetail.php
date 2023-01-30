<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartisipanDetail extends Model
{
    use HasFactory;
    protected $table = 'participants_detail';
    protected $fillable = [
     'participants_id',
     'question_id',
     'answer',
   ];

   public function question()
   {
     return $this->belongsTo(Question::class, 'question_id');
   }

}
