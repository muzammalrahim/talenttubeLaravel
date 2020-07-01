<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model {

    // added by Hassan
    protected $attributes = [
    'description' => 0,
    'vacancies' => 0,
    'salary' => 0,
    'gender' => 0,
    'age' => 0,
    ];     

    protected $table = 'jobs';

     // added by Hassan

    protected $casts = [
        'expiration' => 'datetime'
    ];

    public function GeoCountry(){
        return $this->belongsTo(GeoCountry::class, 'country','country_id');
    }

    public function GeoState(){
        return $this->belongsTo(GeoState::class, 'state','state_id');
    }

    public function GeoCity(){
        return $this->belongsTo(GeoCity::class, 'city','city_id');
    }

    public function applicationCount() {
        return $this->hasOne(JobsApplication::class, 'job_id')->selectRaw('job_id, count(*) as aggregate')->groupBy('job_id');

        // return $this->hasOne('Product') // or App\Product or any namespace you use
        // ->selectRaw('category_id, count(*) as aggregate')
        // ->groupBy('category_id');

    }

}
