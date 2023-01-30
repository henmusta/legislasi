<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partisipan extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $fillable = [
     'kategorisurvey_id',
     'survey_id',
     'user_id',
     'name',
     'email',
     'nik',
     'telp',
   ];

   public function kategorisurvey()
   {
     return $this->belongsTo(KategoriSurvey::class, 'kategorisurvey_id');
   }

   public function survey()
   {
     return $this->belongsTo(Survey::class, 'survey_id');
   }
}
