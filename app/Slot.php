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


}
