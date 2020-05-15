<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model {





    public function GeoCountry(){
        return $this->belongsTo(GeoCountry::class, 'country','country_id');
    }
    public function GeoState(){
        return $this->belongsTo(GeoState::class, 'state','state_id');
    }
    public function GeoCity(){
        return $this->belongsTo(GeoCity::class, 'city','city_id');
    }


}
