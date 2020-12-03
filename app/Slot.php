<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //


    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function bookings()
    {
        // return $this->belongsTo(Interviews_booking::class);
        return $this->belongsTo('App\Interviews_booking', 'slot_id');
    }


    public function bookings2()
    {
        return $this->belongsTo('App\Interviews_booking', 'slot_id');
    }

    public function bookings3()
    {
        return $this->hasMany('App\Interviews_booking', 'slot_id');
    }
 
}
