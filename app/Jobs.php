<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobsQuestions;

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

 

    public function questions(){
        return $this->hasMany('App\JobsQuestions', 'job_id');
    }



    function addJobQuestions($questions){
       
        if(!empty($questions)){
            foreach ($questions as $qkey => $qv) {
                // dd($qv); 
                $newQuestion = new JobsQuestions(); 
                $newQuestion->title = $qv['title'];  
                // $newQuestion->options = json_encode($qv['option']);

                $options_list = array();
                $preffer_list = array();
                $goldstar_list = array();

                if(!empty($qv['option'])){
                    foreach ($qv['option'] as $opKey => $opValue) {
                        array_push($options_list,  $opValue['text']);

                        if(isset($opValue['preffer'])){
                             array_push($preffer_list,  $opValue['text']);
                        }

                        if(isset($opValue['goldstar'])){
                             array_push($goldstar_list,  $opValue['text']);
                        }
                    }
                } 

                 $newQuestion->options = json_encode($options_list);
                 $newQuestion->preffer = json_encode($preffer_list);
                 $newQuestion->goldstar = json_encode($goldstar_list);

                $this->questions()->save($newQuestion); 
            }
        }

    }


}
