<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait; //Import The Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'language' => 'array',
        'hobbies' => 'array',
    ];


    function isAdmin(){
       return  $this->hasRole('admin');
    }

 

    public function GeoCountry(){
        return $this->belongsTo(GeoCountry::class, 'country','country_id');
    }
    public function GeoState(){
        return $this->belongsTo(GeoState::class, 'state','state_id');
    }
    public function GeoCity(){
        return $this->belongsTo(GeoCity::class, 'city','city_id');
    }

}
