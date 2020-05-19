<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use App\BlockUser;


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


    function isEmployer(){
        return  $this->hasRole('employer');
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


    function getJobSeekers( $request, $user ){
        // $data = $this->where('type','user')->get();
        // dd($this->id);
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        // dd($block);
        if(!empty($block)){
            $data = $this->with('profileImage')->where('type','user')->whereNotIn('id', $block)->get();
        }else{
            $data = $this->with('profileImage')->where('type','user')->get();
        }

        return $data;
    }


    function scopeJobSeeker($query){
        return $query->where('type','user');
    }

    function scopeEmployer($query){
        return $query->where('type','employer');
    }

    // function getProfileImage(){
    //     $profileGallery   = UserGallery::where('user_id',$this->id)->where('status',1)->where('profile',1)->first();
    //     $profile_image   = asset('images/user/'.$this->id.'/gallery/'.$profileGallery->image);
    //     return $profile_image;
    // }

    function profileImage(){
        // return $this->hasMany('App\UserGallery','user_id')->where('status',1)->where('profile',1);
        return $this->hasOne('App\UserGallery','user_id')->where('status',1)->where('profile',1);
        // return $this->hasMany('App\UserGallery','user_id'); //->limit(1);
    }


    // function like(){
    //     return $this->belongsTo('App\LikeUser','user_id');
    // }

    // function block(){
    //     return $this->hasMany('')
    // }



    //====================================================================================================================================//
    // Get listing of employers.
    //====================================================================================================================================//
    function getEmployers( $request, $user ){
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        if(!empty($block)){
            $data = $this->with('profileImage')->where('type','employer')->whereNotIn('id', $block)->get();
        }else{
            $data = $this->with('profileImage')->where('type','employer')->get();
        }
        return $data;
    }



}
