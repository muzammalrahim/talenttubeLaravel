<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\GeoState;
use App\GeoCity;

class GeoCountry extends Model{
    protected $table = 'geo_country';


    function  validateState($state){

        // dump(' validateState ', $state);
        // dump(' validateState ', \App\GeoState::where('state_id',$state)->where('country_id', $this->country_id)->first() );
        // dump(' validateState toSql ', \App\GeoState::where('state_id',$state)->toSql() );
        // dump(' $this->country_id ', $this->country_id );
        // DB::enableQueryLog();
        //     $data = \App\GeoState::where('state_id',$state)->where('country_id',$this->country_id)->first();
        // dd( $data);
        // dd(DB::getQueryLog());

           return (GeoState::where('state_id',$state)->where('country_id',$this->country_id)->first())?true:false;
    }

    function  validateCity($state, $city){

        return (GeoCity::where('city_id',$city)->where('state_id',$state)->where('country_id',$this->country_id)->first())?true:false;
        // if (!$geoCountry){ return false; }
        // return true;
    }
}
