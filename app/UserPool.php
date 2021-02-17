<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPool extends Model
{
    //
    public function pool()
    {
        return $this->belongsTo('App\TalentPool', 'pool_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
