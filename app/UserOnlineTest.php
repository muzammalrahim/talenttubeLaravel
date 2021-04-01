<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOnlineTest extends Model
{
    public function onlineTest()
    {
        return $this->belongsTo('App\OnlineTest', 'test_id');
    }

    public function nextQuestion(){
        // dd( $this   ) ;
        // dd(   ) ;
        $current = $this->current_qid;
        return $this->onlineTest()->first()->testQuestions()->get()[$current];
 		 

    }



    public function jobApplication()
    {
        return $this->belongsTo('App\JobsApplication', 'jobApp_id');
    }
}
