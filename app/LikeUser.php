<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeUser extends Model
{
    //


    function addEntry($user, $like){
        $record = $this->where('user_id', $user->id)->where('like',$like)->first();
        if (!empty($record)){
             return $record;
        }else{
             $this->user_id = $user->id;
             $this->like = $like;
             $this->save();
             return $this;
        }
     }

}
