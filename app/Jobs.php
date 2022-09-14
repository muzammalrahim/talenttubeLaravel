<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobsQuestions;
use App\JobsApplication;
use Illuminate\Support\Facades\Auth;

use JustBetter\PaginationWithHavings\PaginationWithHavings;
use Carbon\Carbon;
class Jobs extends Model {
    use PaginationWithHavings;
    // added by Hassan
    protected $attributes = [
    'description' => 0,
    'vacancies' => 0,
    'salary' => 0,
    'gender' => 0,
    'age' => 0,
    ];

    // this is testing ;

    protected $table = 'jobs_data';

     // added by Hassan
     public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }

    public function getDescriptionAttribute($value){

        $remSpecialCharQues = str_replace("\&#39;","'",$value);
        return $remSpecialCharQues;
    }

    protected $casts = [
        'expiration' => 'datetime'
    ];

    public function GeoCountry(){
        return $this->belongsTo(GeoCountry::class, 'country','country_id');
    }

    public function GeoState(){
        return $this->belongsTo(GeoState::class, 'state','state_id');
    }

    public function GeoCity(){
        return $this->belongsTo(GeoCity::class, 'city','city_id');
    }

    public function applicationCount() {
        return $this->hasOne(JobsApplication::class, 'job_id')->selectRaw('job_id, count(*) as aggregate')->groupBy('job_id');
        // return $this->hasOne('Product') // or App\Product or any namespace you use
        // ->selectRaw('category_id, count(*) as aggregate')
        // ->groupBy('category_id');
    }



    public function questions(){
        return $this->hasMany('App\JobsQuestions', 'job_id');
    }

    public function jobEmployerLogo(){
        // return $this->belongsTo(User::class, 'state','state_id');
        // return $this->hasOne('App\UserGallery', 'user_id', 'user_id')->selectRaw('job_id, count(*) as aggregate')->groupBy('job_id');
        return $this->hasOne('App\UserGallery', 'user_id', 'user_id')->where('profile',1);
    }



    public function jobApplication(){
        return $this->hasOne('App\JobsApplication', 'job_id', 'id')->where('user_id',Auth::user()->id);
    }
    


    public function jobEmployer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //  itertaion-9 online test

    public function onlineTest(){
        return $this->belongsTo('App\OnlineTest', 'onlineTest_id');
    }

    function addJobQuestions($questions){

        if(!empty($questions)){
            foreach ($questions as $qkey => $qv) {
                // dd($qv);
                $newQuestion = new JobsQuestions();
                $newQuestion->title = $qv['title'];
                // $newQuestion->options = json_encode($qv['option']);

                $options_list = array();
                $preffer_list = array();
                $goldstar_list = array();

                if(!empty($qv['option'])){

                    foreach ($qv['option'] as $opKey => $opValue) {
                        array_push($options_list,  $opValue['text']);

                        if(isset($opValue['preffer'])){
                             array_push($preffer_list,  $opKey);
                        }

                        if(isset($opValue['goldstar'])){
                             array_push($goldstar_list,  $opKey);
                        }
                    }
                }

                 // $newQuestion->options = json_encode($options_list);
                 // $newQuestion->preffer = json_encode($preffer_list);
                 // $newQuestion->goldstar = json_encode($goldstar_list);

                 $newQuestion->options =  $options_list;
                 $newQuestion->preffer =  $preffer_list;
                 $newQuestion->goldstar = $goldstar_list;

                $this->questions()->save($newQuestion);
            }
        }

    }


    static function generateCode(){
        $code = str_pad(mt_rand(999, 999999), 6, '0', STR_PAD_LEFT);
        $exist = Jobs::where('code', $code)->first();
        if($exist){
            $this->generateCode();
        }else{
            return $code;
        }
    }






    //====================================================================================================================================//
    // Function to filter jobs. // called from jobs layout.
    //====================================================================================================================================//
    public function filterJobs($request){


        $keyword = my_sanitize_string($request->filter_keyword);
        $salaryRange = $request->filter_salary;
        $jobType = $request->filter_jobType;


           // Filter by industry experience
        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;


        $filter_location =  (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on'))?true:false;
        $latitude = $request->location_lat;
        $longitude = $request->location_long;
        $radius = $request->filter_location_radius;


        $query    = $this::with(['applicationCount','jobEmployerLogo']);


        if($filter_location){
            if(isset($latitude) && isset($longitude)  && isset($radius)){
                $radius_sign = ($radius <= 50)?'<':'>';
                // $query = $query->selectRaw("*,
                $query = $query->selectRaw("*,
                ( 6371 * acos( cos(radians('".$latitude."'))
                * cos( radians(location_lat))
                * cos( radians(location_long) - radians('".$longitude."'))
                + sin( radians('".$latitude."'))
                * sin( radians( location_lat )))
                ) AS distance")
                ->having("distance", $radius_sign, $radius);
               // dd($latitude);
                //$query = $query->where('location_lat', '<=', -33.8688);
    //             $query = $query->selectRaw("(3959 * acos(cos(radians($latitude)) * cos(radians(venues.latitude)) * cos(radians(venues.longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(venues.latitude)))) AS distance"))

    // ->orderBy('distance', 'asc')
    // ->having('distance', '<', $distance);
                //->orderBy("distance",'asc');
            }
        }

        if(!empty($salaryRange))
           {
               $query = $query->where('salary', '>=', $salaryRange);
                // dd( $query);
            }


        // Filter by jobType.
        if(!empty($jobType)){ $query->where('type', '=', $jobType); }


        // Filter by Keyword filter_keyword
        if(varExist('filter_keyword', $request)){
            $keyword = $request->filter_keyword;
            $query = $query->where(function($q) use($keyword) {
                        $q->where('code','LIKE', "%{$keyword}%")
                        ->orWhere('title','LIKE', "%{$keyword}%")
                        ->orWhere('description','LIKE', "%{$keyword}%");
                });
        }

        // if( $filter_location ||  !empty($qualification_type) || !empty($salaryRange) || !empty($keyword) || $industry_status ){
        //     $applications = $applications->whereHas('jobseeker', function ($query) use($filter_location,$latitude,$longitude,$radius,$qualification_type,$salaryRange,$keyword, $qualifications, $industry_status, $industries){
        //         if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
        //         if(!empty($keyword)){  $query->where('username', 'LIKE', "%{$keyword}%"); }
        //         return $query;
        //     });


        // }






        // if(varExist('ja_filter_sortBy', $request)){
        //     // dd($request->ja_filter_sortBy);
        //     $filter_column = 'goldstar';
        //     if($request->ja_filter_sortBy == 'all_candidates'){
        //         $applications = $applications->orderBy('created_at', 'DESC');
        //     }else if($request->ja_filter_sortBy == 'goldstars'){
        //         $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
        //     }else if($request->ja_filter_sortBy == 'applied'){
        //         $applications  = $applications->where('status','=','applied');
        //     }else if($request->ja_filter_sortBy == 'inreview'){
        //         $applications  = $applications->where('status','=','inreview');
        //     }else if($request->ja_filter_sortBy == 'interview'){
        //         $applications  = $applications->where('status','=','interview');
        //     }else if($request->ja_filter_sortBy == 'unsuccessful'){
        //         $applications  = $applications->where('status','=','unsuccessful');
        //     }
        // }else{
        //     $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
        // }

        //  dd( $query->toSql() );

        if($industry_status && !empty($industries)){
            $query = $query->where(function($q) use($industries) {
                $q->where('experience','LIKE', "%{$industries[0]}%");
                if(count($industries) > 1){
                    foreach ($industries as $indk =>  $industry) {
                        if($indk == 0) continue;
                        $q->orWhere('experience','LIKE', "%{$industry}%");
                    }
                }
            });
        }

        // dd( $query->toSql() );





        $jobsList = $query->paginate(10)->onEachSide(1);
       // dd($jobsList);
        return $jobsList;

    }


}
