<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JustBetter\PaginationWithHavings\PaginationWithHavings;

use App\BlockUser;


class User extends Authenticatable
{

     use PaginationWithHavings;

    // added by Hassan
    protected $attributes = [
    'username' => 0,
    ];     

    protected $table = 'users';

     // added by Hassan


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
        'industry_experience' => 'array'
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
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        
        if(!empty($block)){
            $data = $this->with('profileImage')->where('type','user')->whereNotIn('id', $block);
        }else{
            $data = $this->with('profileImage')->where('type','user');
        }

       
        // Filter by salaryRange. 
        if (isset($request->filter_salary) && !empty($request->filter_salary)){ 
            $data->where('salaryRange', '>=', $request->filter_salary); 
        }

        // Filter by google map location radius. 
        if (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on')){  
            if( isset($request->location_lat) && isset($request->location_long)  && isset($request->filter_location_radius)){
                $data =  $this->findByLatLongRadius($data, $request->location_lat, $request->location_long, $request->filter_location_radius);
            }
        }
         
        // DB::enableQueryLog();

        // print_r( $data->toSql() );exit; 

        // $data =  $data->paginate(2);
        return $data;
    }




    private function findByLatLongRadius($query, $latitude, $longitude, $radius = 5) {
    /*
     * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
     * replace 6371000 with 6371 for kilometer and 3956 for miles
     */
 


        
        $query = $query->selectRaw("*,
                     ( 6371 * acos( cos(radians('".$latitude."'')) 
                     * cos( radians(location_lat))
                     * cos( radians(location_long) - radians('".$longitude."'')) 
                     + sin( radians('".$latitude."'')) 
                     * sin( radians( location_lat )))
                     ) AS distance")
        ->having("distance", "<", $radius)
        ->orderBy("distance",'asc'); 

        return $query;

        // $restaurants = Restaurant::selectRaw("id, name, address, latitude, longitude, rating, zone ,
        //              ( 6371000 * acos( cos( radians(?) ) *
        //                cos( radians( latitude ) )
        //                * cos( radians( longitude ) - radians(?)
        //                ) + sin( radians(?) ) *
        //                sin( radians( latitude ) ) )
        //              ) AS distance", [$latitude, $longitude, $latitude])
        // ->where('active', '=', 1)
        // ->having("distance", "<", $radius)
        // ->orderBy("distance",'asc')
        // ->offset(0)
        // ->limit(20)
        // ->get();

        // return $restaurants;
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
    

    function Gallery(){ 
        return $this->hasMany('App\UserGallery','user_id');  
    }


    function vidoes(){
        return $this->hasMany('App\Video','user_id');
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



    function tags(){
        // return $this->hasMany('App\UserTags','user_id');
        return $this->belongsToMany('App\Tags', 'user_tags','user_id','tag_id');
    }

    function qualificationRelation(){
        // return $this->hasMany('App\UserTags','user_id');
        return $this->belongsToMany('App\Qualification', 'user_qualifications','user_id','qualification_id');
    }



}
