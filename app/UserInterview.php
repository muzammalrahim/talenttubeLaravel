<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterview extends Model
{
    

    public function tempQuestions()
    {
        return $this->hasMany('App\InterviewTempQuestion', 'temp_id');
    }


    public function questions()
    {
        return $this->belongsTo('App\InterviewTempQuestion', 'temp_id');
    }

    public function employer()
    {
        return $this->belongsTo('App\User', 'emp_id');
    }

    public function js()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function template()
    {
        return $this->belongsTo('App\InterviewTemplate', 'temp_id');
    }
}


