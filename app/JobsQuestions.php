<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsQuestions extends Model
{
    //

 	// protected $fillable = ['questions'];
	protected $casts = [
        'options' => 'array',
        'preffer' => 'array',
        'goldstar' => 'array',
    ];


}
