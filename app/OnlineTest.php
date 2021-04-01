<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineTest extends Model
{
    //

    public function testQuestions()
    {
        return $this->hasMany('App\TestQuestion', 'test_id');
    }

    public function nextQuestions($current)
    {
        return $this->hasMany('App\TestQuestion', 'test_id');
    }
}
