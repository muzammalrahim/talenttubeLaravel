<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crossreference extends Model
{
    public function jsdata()
    {
        return $this->belongsTo('App\User', 'jobseekerId');
    }
}
