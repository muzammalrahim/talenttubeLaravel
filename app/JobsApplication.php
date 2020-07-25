<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JustBetter\PaginationWithHavings\PaginationWithHavings;

class JobsApplication extends Model{
    //

    use PaginationWithHavings;

    public function job() {
        return $this->belongsTo('App\Jobs', 'job_id');
    }


    public function jobseeker() {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function answers(){
        return $this->hasMany('App\JobsAnswers', 'application_id');
    }


    //====================================================================================================================================//
    // Function to filter jobApplication. // called from jobSeeker->job->applications layout. 
    //====================================================================================================================================//
    public function getFilterApplication($request){

        $job_id = $request->job_id;
        $keyword = my_sanitize_string($request->ja_filter_keyword);
        $qualification_type = $request->ja_filter_qualification_type;
        $salaryRange = $request->ja_filter_salary;
        $filter_location =  (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on'))?true:false; 
        $latitude = $request->location_lat;
        $longitude = $request->location_long;
        $radius = $request->filter_location_radius;

        // $country = $request->ja_filter_country;
         $applications    = $this::with(['job','jobseeker']); 

         // Filter by job_id
         if(varExist('job_id', $request)){
            $applications  = $applications->where('job_id','=',$job_id);
         }

         
         if( $filter_location ||  !empty($qualification_type) || !empty($salaryRange) || !empty($keyword)){
                $applications = $applications->whereHas('jobseeker', function ($query) use($filter_location,$latitude,$longitude,$radius,$qualification_type,$salaryRange,$keyword){
                    // if(!empty($country)){ $query->where('country', '=', $country);  }   
                    if(!empty($salaryRange)){ $query->where('salaryRange', '>=', $salaryRange); }
                    if(!empty($keyword)){  $query->where('username', 'LIKE', "%{$keyword}%"); }
                    // Filter by google map location radius. 
                    if($filter_location){
                        if(isset($latitude) && isset($longitude)  && isset($radius)){
                            $radius_sign = ($radius <= 50)?'<':'>'; 
                            // $query = $query->selectRaw("*,
                            $query = $query->selectRaw("
                                ( 6371 * acos( cos(radians('".$latitude."')) 
                                * cos( radians(location_lat)) 
                                * cos( radians(location_long) - radians('".$longitude."')) 
                                + sin( radians('".$latitude."')) 
                                * sin( radians( location_lat )))
                            ) AS distance")
                            ->having("distance",$radius_sign,$radius); 
                            //->orderBy("distance",'asc');
                        }
                    }
                    // dd($query->toSql());
                    return $query; 
                });  
            }

            //Filter by Question  
            if(varExist('filter_by_questions', $request) && ( $request->filter_by_questions == 'on')){
              // dd( $request->filter_question );
              foreach ($request->filter_question as $fqKey => $fqValue) {
                   
                    if(!empty($fqValue)){
                         // dump($fqKey, $fqValue  );
                        $applications = $applications->whereHas('answers', function($q) use($fqKey,$fqValue) {
                            $q->where('question_id', '=',  $fqKey)->where('answer', '=',  $fqValue); 
                            return $q;
                        });
                    }
                }  
            }


            $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC')->paginate(1);
            return $applications; 
    }

}
