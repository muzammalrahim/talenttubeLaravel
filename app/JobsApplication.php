<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsApplication extends Model{
    //

    public function job() {
        // return $this->belongsToMany(Job::class);
        return $this->belongsTo('App\Jobs', 'job_id');
     }

}
