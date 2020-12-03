<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    public function slots()
    {
        return $this->hasMany('App\Slot', 'interview_id');
    }


    public function employerData()
    {
        return $this->belongsTo('App\User', 'emp_id');
    }

    public function jsData()
    {
        return $this->belongsTo('App\Interviews_booking', 'id');
    }


    public function interviewBookings()
    {
        // return $this->hasMany('App\Interviews_booking', 'interview_id');
        return $this->hasOne(Interviews_booking::class, 'interview_id')->selectRaw('interview_id, count(*) as aggregate')->groupBy('interview_id');
        
    }
}
