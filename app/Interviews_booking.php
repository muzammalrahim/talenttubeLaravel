<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_booking extends Model
{

	 protected $table = 'interviews_bookings';
	 
     public function slots()
    {
        return $this->hasMany('App\Interview', 'interview_id');
    }
}
