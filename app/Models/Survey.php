<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'survey';
    protected $fillable = [
     'kategorisurvey_id',
     'name',
     'deskripsi',
   ];

   public function kategorisurvey()
   {
     return $this->belongsTo(KategoriSurvey::class, 'kategorisurvey_id');
   }

   public function partisipan()
   {
     return $this->hasMany(Partisipan::class, 'survey_id');
   }

   public function Question()
   {
     return $this->hasMany(Question::class, 'survey_id');
   }

}
