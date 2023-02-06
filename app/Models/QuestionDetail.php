<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionDetail extends Model
{
    use HasFactory;
    protected $table = 'question_detail';
    protected $fillable = [
     'answer',
     'deskripsi',
     'question_id'
   ];

   public function question()
   {
     return $this->belongsTo(Question::class, 'question_id')->with('survey');
   }
}
