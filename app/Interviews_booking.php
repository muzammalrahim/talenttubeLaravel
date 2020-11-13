<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_booking extends Model
{
     public function slots()
    {
        return $this->hasMany('App\Interview', 'interview_id');
    }
}
