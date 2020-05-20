<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
				//

				protected $casts = [
					'date' => 'datetime',
	];

}
