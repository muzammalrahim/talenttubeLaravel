<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulkEmail extends Model
{
    //
 
    protected $casts = [
        'user_ids' => 'array', 
    ];

}
