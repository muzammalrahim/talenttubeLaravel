<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model {
    //
    public function user(){
        return $this->belongsTo(User::class, 'block');
    }


    function addEntry($user, $block){
       $record = $this->where('user_id', $user->id)->where('block',$block)->first();
       if (!empty($record)){
            return $record;
       }else{
            $this->user_id = $user->id;
            $this->block = $block;
            $this->save();
            return $this;
       }
    }


}
