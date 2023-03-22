<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BlockUser;
use App\LikeUser;
use App\ControlSession;
use App\Jobs;
use App\OnlineTest;
use App\JobsApplication;

use Carbon\Carbon;
use DateTime;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SwiperController extends Controller
{
    


    public function jobseekers(Request $request){

        $user = Auth::user();
        if (!isEmployer($user)){ return redirect(route('jobs')); }

        if ($user->employerStatus != 'paid' || !isMobileNew()) {
            return redirect(route('jobSeekers'));
        }

        // // =========================================== Paid employer viewing jobseeker ===========================================
        // $isallowed = False;
        // if ($user->employerStatus == 'paid') {
        //     $empExpDate = $user->emp_status_exp;
        //     $currentDate = Carbon::now();
        //     $datetime1 = new DateTime($empExpDate);
        //     $datetime2 = new DateTime($currentDate);
        //     // $interval = $datetime1->diff($datetime2);
        //     // dd($interval);
        //     if ($datetime1 >= $datetime2) {
        //         $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
        //         $isallowed = True;
        //         $data['attachments'] = $attachments;
        //     }
        //     else{
        //         $isallowed = False;
        //         $user->employerStatus = 'unpaid';
        //         $user->save();
        //     }

        // }

        // // =========================================== Paid employer viewing jobseeker ===========================================
        // $data['isallowed'] = $isallowed;
        $data['user']           = $user;
        $data['title']          = 'Job Seekers';
        $data['classes_body']   = 'jobSeekers';
        $jobSeekersObj          = new User();
        $jobSeekers             = $jobSeekersObj->swipeJobseeker($request, $user);
        $likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['likeUsers'] = $likeUsers;

        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        return view('web.swiper.jobseekers.index', $data);
        // web/swiper/jobseekers/index
    }


    public function jobSeekersFilter(Request $request){

        // dd($request->toArray());

        $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to access this information',
            ]);
        }

         $data['user']           = $user;
    
        // ================================================ Filter by Industry. ================================================

        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;
        $qualification_type = $request->filter_qualification_type; 
        $qualifications = $request->ja_filter_qualification;

        $query = User::with('profileImage','user_tags')->where('type','user')->Where('step2' , '>=' , '7');
        // $tagsQuery = Tags::get();
        if(!empty($block)){
            $query = $query->whereNotIn('id', $block);
        }


        // ================================================ Filter by salaryRange. ================================================

        // dd($request->filter_salary);
        if (isset($request->filter_salary) && !empty($request->filter_salary)){
            $query = $query->where('salaryRange', $request->filter_salary);
        }

        // ================================================ Filter by google map location radius.================================================

        if (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on')){
            if( isset($request->location_lat) && isset($request->location_long)){
                // $query =  $query->findByLatLongRadius($data, $request->location_lat, $request->location_long, $request->filter_location_radius);

                // dd($request->location_lat);
                $latitude = $request->location_lat;
                $longitude = $request->location_long;
                if (isset($request->filter_location_radius)) {
                    $radius = $request->filter_location_radius;
                    $radius_sign = ($radius <= 50)?'<':'>';

                    $query = $query->selectRaw("*,
                         ( 6371 * acos( cos(radians('".$latitude."'))
                         * cos( radians(location_lat))
                         * cos( radians(location_long) - radians('".$longitude."'))
                         + sin( radians('".$latitude."'))
                         * sin( radians( location_lat )))
                         ) AS distance")
                    ->having("distance", $radius_sign, $radius)
                    ->orderBy("distance",'asc');
                    // code...
                }

                else{
                    
                    $query = $query->selectRaw("*,
                         ( 6371 * acos( cos(radians('".$latitude."'))
                         * cos( radians(location_lat))
                         * cos( radians(location_long) - radians('".$longitude."'))
                         + sin( radians('".$latitude."'))
                         * sin( radians( location_lat )))
                         ) AS distance")
                    ->orderBy("distance",'desc');
                }
                



            }
        }


        // ================================================ Filter by Age brackets.================================================

        if (isset($request->filter_by_age)) {
            // dd(' Value  ');
            $age = $request->filter_by_age;
            // dd($age);
            if ($age == '18-25') {
                $query = $query->whereBetween('age',  [18,25]);
                // dd($query->toSql());
            }
            elseif($age == '25-30'){
                $query = $query->whereBetween('age',  [25,30]);
            }
            elseif($age == '30-40'){
                $query = $query->whereBetween('age',  [30,40]);
            }
            elseif($age == '40-54'){
                $query = $query->whereBetween('age',  [40,54]);
            }
            else{
                $query = $query->where('age', '>=', '55');
            }
            // code...
        }

        // ================================================ Filter by Age gender.================================================


        if (isset($request->filter_by_gender)) {
            $gender = $request->filter_by_gender;
            // dd($gender);
            if ($gender == 'male') {
                $query = $query->where('title','Mr');
            }
            else{
                $query = $query->whereIn('title' , array("Mrs","Miss","Ms"));
            }
        }

        // ================================================ Filter by Keyword filter_keyword ================================================

        if(varExist('filter_keyword', $request)){
            $keyword = $request->filter_keyword;
            $query = $query->where(function($q) use($keyword) {
                        $q->where('username','LIKE', "%{$keyword}%")
                        ->orWhere('name','LIKE', "%{$keyword}%")
                        ->orWhere('email','LIKE', "%{$keyword}%")
                        ->orWhere('about_me','LIKE', "%{$keyword}%")
                        ->orWhere('interested_in','LIKE', "%{$keyword}%")
                        ->orWhere('recentJob','LIKE', "%{$keyword}%");
                });
        }

        // ================================================ Filter by Questions ================================================

        if(varExist('filter_qualification_type', $request)){
            $query = $query->where('qualificationType', '=', $request->filter_qualification_type);
        }

        // ================================================ Filter by Question ================================================

        if(varExist('filter_question', $request) &&varExist('filter_by_questions', $request)&& varExist('filter_question_value', $request) ){
            // SELECT * FROM `users` WHERE `questions` LIKE '%\"relocation\":\"yes\"%' ORDER BY `id` DESC
            $question_like =  '%\"'. $request->filter_question.'\":\"'. $request->filter_question_value.'\"%';
            $query = $query->where('questions', 'LIKE', $question_like);
        }


        // ================================================ Filter by industry status. ================================================

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


        // ================================================ Filter by qualification. ================================================

        if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
        // dd($qualifications);
        if(!empty($qualifications)){
            $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                $query2->whereIn('qualifications.id', $qualifications);
                // $query->where('jobseeker.id', 1);
                // dd($query->toSql());
                return $query2;
            });
        }

            
        // DB::enableQueryLog();
        // print_r( $query->toSql() );exit;
        $jobSeekers =  $query->get();
        $data['jobSeekers'] = $jobSeekers;
        $data['likeUsers']       = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['blockUsers']       = BlockUser::where('user_id',$user->id)->pluck('block')->toArray();

        return view('web.swiper.jobseekers.list', $data); // mobile/employer/jobSeekers/swipe_jobseekerList
    }



    public function employersjobApplications($id){
        $user = Auth::user();
        if(isEmployer($user)){

            $job =  Jobs::find($id);
            // $applications    = JobsApplication::with(['job','jobseeker'])->where('job_id',$id)->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC')->paginate(1);
            // $data['applications'] = $applications;
            $data['job']   = $job;
            $data['user']   = $user;
            $onlineTest = OnlineTest::get();
            $data['onlineTest']   = $onlineTest;
            $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
            $data['controlsession'] = $controlsession;
            $data['title']  = 'Job Detail';
            $data['classes_body'] = 'jobdetail';
            return view('web.swiper.employer-jobApplications.index', $data); // web/swiper/employer-jobApplications/index
        }
    }

    public function employersjobAppFilter(Request $request){
        $user = Auth::user();
        if(isEmployer($user)){
            $applications = new JobsApplication();
            $applications = $applications->getFilterApplicationSwiper($request);
            // dd($applications);
            // $UserOnlineTest = UserOnlineTest::where('jobApp_id', $application->id)->first();
            // dd($UserOnlineTest);
            $likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
            $blockUsers             = BlockUser::where('user_id',$user->id)->pluck('block')->toArray();
            $data['applications'] = $applications;
            $data['user']       = $user;
            $data['title']      = 'Job Detail';
            $data['likeUsers']  =  $likeUsers;
            $data['blockUsers']  =  $blockUsers;
            $data['classes_body'] = 'jobdetail';
            return view('web.swiper.employer-jobApplications.list', $data);
            // web.swiper.employer-jobApplications.list
        }
    }

    public function change_status(Request $request, $id){
        $data = $request->toArray();
        $user = Auth::user();
        $JobsApplication = JobsApplication::where('id', $id)->first();
        if ($JobsApplication) {
            if($JobsApplication->job->jobEmployer->id == $user->id){
                $JobsApplication->status = $data['status'];
                $JobsApplication->save();
                return response()->json([
                    'status' => 1,
                    'message' => 'Status saved successfully',
                    'jobStatus' => $JobsApplication->status

                ]);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'User is not authenticated',

                ]);
            }
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'Job Application does not exist',
            ]);
        } 
    }



}
