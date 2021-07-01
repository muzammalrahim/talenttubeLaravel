<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    public function qualificationNames() {
        return $this->belongsTo('App\Qualification', 'qualification_id');
    }
}
