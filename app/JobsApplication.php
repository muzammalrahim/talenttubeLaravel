<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsApplication extends Model{
    //

    public function job() {
        return $this->belongsTo('App\Jobs', 'job_id');
    }


    public function jobseeker() {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function answers(){
        return $this->hasMany('App\JobsAnswers', 'application_id');
    }

}
