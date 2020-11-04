<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    public function slots()
    {
        return $this->hasMany('App\Slot', 'interview_id');
    }
}
