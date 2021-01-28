<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterviewAnswers extends Model
{
    public function answers()
    {
        return $this->hasMany('App\UserInterviewAnswers', 'question_id');
    }
}
