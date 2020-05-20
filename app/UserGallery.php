<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGallery extends Model
{
    protected $table = 'user_gallery';


    function scopePublic($query){
        return $query->where('access',1);
    }

    function scopeActive($query){
        return $query->where('status',1);
    }
}
