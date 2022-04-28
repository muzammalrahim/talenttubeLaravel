<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    

    public function jobseeker()
    {
        return $this->belongsTo('App\User', 'js_id');
    }
}
