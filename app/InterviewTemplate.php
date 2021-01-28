<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewTemplate extends Model
{
    public function tempQuestions()
    {
        return $this->hasMany('App\InterviewTempQuestion', 'temp_id');
    }
    
}


