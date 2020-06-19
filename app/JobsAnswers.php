<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsAnswers extends Model { 
    //


	 public function question() {
        return $this->belongsTo('App\JobsQuestions', 'question_id');
    }

}
