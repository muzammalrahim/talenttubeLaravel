<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jobs()
    {
        return $this->belongsTo('App\Jobs', 'job_id');
    }

    public function reference()
    {
        return $this->belongsTo('App\crossreference', 'reference_id');
    }


}
