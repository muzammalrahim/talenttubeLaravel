<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_booking extends Model
{

	 protected $table = 'interviews_bookings';
	 
    //  public function slots()
    // {
    //     return $this->hasMany('App\Interview', 'interview_id');
    // }

    public function slot()
    {
        return $this->belongsTo('App\Slot', 'slot_id');
    }

    public function interview()
    {
        return $this->belongsTo('App\Interview', 'interview_id');
    }
    
}
