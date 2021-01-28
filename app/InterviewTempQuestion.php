<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewTempQuestion extends Model
{
    

    public function answers1()
    {
        return $this->hasMany('App\UserInterviewAnswers', 'question_id');
    }
}
