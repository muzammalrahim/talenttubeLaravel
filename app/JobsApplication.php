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


    public function userInterviewCount(){
        // return $this->hasOne(UserInterview::class, 'user_id')->selectRaw('user_id, count(*) as aggregate')->groupBy('user_id');  
         return $this->hasMany('App\UserInterview', 'jobApp_id');
        // ->withTimestamps()
        // ->withPivot(['status','type']);

    }


   /* public function user_interviewsAccount(){
        return $this->hasOne(UserInterview::class, 'user_id')->where('status' , 'Interview Confirmed')->selectRaw('user_id, count(*) as aggregate')->groupBy('user_id');        
    }*/


    //====================================================================================================================================//
    // Function to filter jobApplication. // called from jobSeeker->job->applications layout.
    //====================================================================================================================================//
    public function getFilterApplication($request){
        // dd($request->toArray());
        $job_id = $request->job_id;
        $keyword = my_sanitize_string($request->ja_filter_keyword);

        $qualification_type = $request->ja_filter_qualification_type;
        $qualifications = $request->ja_filter_qualification;
        $salaryRange = $request->ja_filter_salary;
        $filter_location =  (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on'))?true:false;
        $latitude = $request->location_lat;
        $longitude = $request->location_long;
        $radius = $request->filter_location_radius;
        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;

        // $country = $request->ja_filter_country;

        // select * from `users`
        // where `users`.`id` in (90) and exists (select * from `qualifications` inner join `user_qualifications` on `qualifications`.`id` = `user_qualifications`.`qualification_id` where `users`.`id` = `user_qualifications`.`user_id` and `qualifications`.`id` IN (40) )


        // if(!empty($qualifications)){
        //      $applications    = $this::with(['job','jobseeker' => function($q) use($qualifications){
        //         $q->whereHas('qualificationRelation', function($query) use($qualifications) {
        //             $query->whereIn('qualifications.id', $qualifications);
        //             // $query->where('jobseeker.id', 1);
        //             // dd($query->toSql());
        //         });
        //      }]);
        // }else{
             $applications    = $this::with(['job','jobseeker']);
        // }

        // dd($applications->toSql() );

        // Project::with(['tasks' => function($q) {
        //     $q->whereHas('tags', function($query) {
        //         $query->where('tag_id', 1);
        //     });
        // }])->get();

         // Filter by job_id
         if(varExist('job_id', $request)){
            $applications  = $applications->where('job_id','=',$job_id);
         }


         if( $filter_location ||  !empty($qualification_type) || !empty($salaryRange) || !empty($keyword) || $industry_status ){
                $applications = $applications->whereHas('jobseeker', function ($query) use($filter_location,$latitude,$longitude,$radius,$qualification_type,$salaryRange,$keyword, $qualifications, $industry_status, $industries){
                    // if(!empty($country)){ $query->where('country', '=', $country);  }

                    if(!empty($salaryRange)){ $query->where('salaryRange', '>=', $salaryRange); }
                    if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
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
                        ->having("distance", "<", $radius)
                        ->orderBy("distance",'asc');
                            //->orderBy("distance",'asc');
                        }
                    }

                    // check if specific qualificaton is selected.
                    if(!empty($qualifications)){
                        $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                            $query2->whereIn('qualifications.id', $qualifications);
                            // $query->where('jobseeker.id', 1);
                            // dd($query->toSql());
                            return $query2;
                        });
                    }


                    // check if industry filter is enabled.
                    if($industry_status && !empty($industries)){
                        $query = $query->where(function($q) use($industries) {
                            $q->where('industry_experience','LIKE', "%{$industries[0]}%");
                            if(count($industries) > 1){
                                foreach ($industries as $indk =>  $industry) {
                                    if($indk == 0) continue;
                                    $q->orWhere('industry_experience','LIKE', "%{$industry}%");
                                }
                            }
                        });
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


            // ja_filter_qualification



            if(varExist('ja_filter_sortBy', $request)){
                // dd($request->ja_filter_sortBy);
                $filter_column = 'goldstar';
                if($request->ja_filter_sortBy == 'all_candidates'){
                    $applications = $applications->orderBy('created_at', 'DESC');
                }else if($request->ja_filter_sortBy == 'goldstars'){
                    $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
                }else if($request->ja_filter_sortBy == 'applied'){
                    $applications  = $applications->where('status','=','applied');
                }else if($request->ja_filter_sortBy == 'inreview'){
                    $applications  = $applications->where('status','=','inreview');
                }else if($request->ja_filter_sortBy == 'interview'){
                    $applications  = $applications->where('status','=','interview');
                }else if($request->ja_filter_sortBy == 'unsuccessful'){
                    $applications  = $applications->where('status','=','unsuccessful');
                }else if($request->ja_filter_sortBy == 'pending'){
                    $applications  = $applications->where('status','=','pending');
                }
            }else{
                $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
            }


        //    dd( $applications->toSql() );

            $applications = $applications->get();

            return $applications;
    }


    //=========================================================================
    // iteration-9 relation with user's online test
    //=========================================================================

    public function userOnlineTests(){
        return $this->hasMany('App\UserOnlineTest', 'jobApp_id');
    }

    public function userstestAndStatus(){
        $id = $this->id;
        // $user_id = $this->user_id;
        // dd($user_id);
        return $this->belongsTo(UserOnlineTest::class, $id);

        // return $this->belongsTo('App\UserOnlineTest', $user_id)->where('jobApp_id' , $id)->first();
    }


}
