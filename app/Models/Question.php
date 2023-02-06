<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'question';
    protected $fillable = [
     'kategorisurvey_id',
     'survey_id',
     'question',
   ];

   public function kategorisurvey()
   {
     return $this->belongsTo(KategoriSurvey::class, 'kategorisurvey_id');
   }

   public function survey()
   {
     return $this->belongsTo(Survey::class, 'survey_id')->withCount('partisipan');
   }

   public function partisipandetail()
   {
     return $this->hasMany(AgendaFile::class);
   }

   public function questiondetail()
   {
     return $this->hasMany(QuestionDetail::class);
   }

}
