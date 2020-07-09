<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use App\UserGallery;
use App\Attachment;
use App\BlockUser;
use App\UserActivity;
use App\Video;
use App\Jobs;
use App\LikeUser;
use App\JobsApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Illuminate\Contracts\Queue\Job;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class EmployerController extends Controller {

    public function __construct(){
    	$this->middleware('auth');
    }


    //====================================================================================================================================//
    // Get the Employer profile.
    //====================================================================================================================================//
    public function index(Request $request){
        $user = Auth::user();
        if ( $request->username ===  $user->username ){
            $user_gallery    = UserGallery::where('user_id',$user->id)->where('status',1)->get();
            $profile_image   = UserGallery::where('user_id',$user->id)->where('status',1)->where('profile',1)->first();
            if(!$profile_image){
                if( $user_gallery->count() > 0){
                    // $profile_image   = asset('images/user/'.$user->id.'/'.$user_gallery->first()->image);
                    $profile_image   = assetGallery($user_gallery->first()->access,$user->id,'',$user_gallery->first()->image);
                }else{
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                }
            }else{
				// $profile_image   = asset('images/user/'.$user->id.'/gallery/'.$profile_image->image);
                $profile_image   = assetGallery($profile_image->access,$user->id,'',$profile_image->image);
			}

            $attachments = Attachment::where('user_id', $user->id)->get();
            $activities = UserActivity::where('user_id', $user->id)->get();
            $videos     = Video::where('user_id', $user->id)->get();

            $data['user'] =  $user;
            $data['user_gallery'] = $user_gallery;
            $data['geo_country'] = get_Geo_Country();
             $data['geo_state'] = !empty($user->country)?(get_Geo_State($user->country)):null;
            $data['geo_city'] = !empty($user->country)?(get_Geo_City($user->country,$user->state)):null; 
            $data['profile_image']    = $profile_image;
            $data['title'] = 'profile';
            $data['classes_body'] = 'profile';
            $data['content'] = 'this is page content';
            $data['attachments'] = $attachments;
            $data['activities'] = $activities;
            $data['videos'] = $videos;

			$view_name = 'site.employer.profile.profile';
            return view($view_name, $data);
        }else{
            return view('site.404');
        }
    }



    //====================================================================================================================================//
    // Display Step2 form for Employer, on first time registeration.
    //====================================================================================================================================//
    public function step2Employer(){
        // dd(' step2Employer ');
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Employer';
        $data['classes_body'] = 'empStep2';
        // $data['content'] = 'this is page content';
        return view('site.register.employer_step2', $data);

    }

    //====================================================================================================================================//
    //Ajax Post from step2 layout  // Add user step2 data.
    //====================================================================================================================================//
    public function Step2(Request $request){
        // dump( $request->toArray() );

        $requestData = $request->all();
        $requestData['about_me']        = my_sanitize_string($request->about_me);
        $requestData['interested_in']   =  my_sanitize_string($request->interested_in);
        $requestData['questions']       =  json_decode( $request->questions, true );
        $requestData['industry_experience']= json_decode(stripslashes($request->industry_experience), true);

        // dd( $request->all() );
        // dd(  $requestData );
        if( !empty($requestData['questions']) ){
            foreach($requestData['questions'] as $qk => $qv){
                $requestData['questions'][$qk] = my_sanitize_string($qv);
            }
        }

        // card_step2_validation
        $rules = array(
            'about_me' => 'required|max:150',
            'interested_in' => 'required|max:150',
            "questions"  => "required",
            "industry_experience"  => "required",
        );
        $validator = Validator::make( $requestData , $rules);

        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            $user = Auth::user();
            $user->about_me         = $requestData['about_me'];
            $user->interested_in    = $requestData['interested_in'];
            $user->questions        = json_encode($requestData['questions']);
            $user->step2            = 1;
            $user->industry_experience = $requestData['industry_experience'];
            $user->save();

            if(!empty($request->file('file'))){

                $image = $request->file('file');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                
                $file_thumb  = $user->id.'/gallery/small/'.$fileName;
                $file_path   = $user->id.'/gallery/'.$fileName;

                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) { $constraint->aspectRatio(); });
                $img->stream();
                Storage::disk('publicMedia')->put( $file_thumb , $img);

                $img = Image::make($image->getRealPath());
                $img->stream();

                Storage::disk('publicMedia')->put($file_path, $img, 'public');

                $userGallery = new UserGallery();
                $userGallery->user_id = $user->id;
                $userGallery->image = $fileName;
                $userGallery->status = 1;
                $userGallery->profile = 1;
                $userGallery->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'data saved succesfully',
                    'redirect' => route('employerProfile')
                ]);
            
            }
        }
    }





    //====================================================================================================================================//
    // Get // Add new job layout.
    //====================================================================================================================================//
    public function newJob(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Add New Job';
        $data['classes_body'] = 'newJob';

        $data['geo_state']      = get_Geo_State(default_Country_id());
        $data['geo_cities']     = get_Geo_City(default_Country_id(), default_State_id());
        
        // $jobs =  Jobs::find(12);
        // dd( json_decode($jobs->questions()->first()->options, true) );
        // dd( $jobs->questions()->first()->options );

        $data['geo_country'] = get_Geo_Country();
        return view('site.jobs.new', $data);
    }

    //====================================================================================================================================//
    // Ajax Post // Add new job to database.
    //====================================================================================================================================//
    public function addNewJob(Request $request){
        $user = Auth::user();
        
        // dd( $request->toArray() );  
        // dd( $request->jq );
        // Jobs::find(12)->addJobQuestions($requestData['jq']); 

        $requestData = $request->all();
        $requestData['title']         = my_sanitize_string($request->title);
        $requestData['description']   =  my_sanitize_string($request->description);
        $requestData['experience']    =  my_sanitize_string($request->experience);
        $requestData['type']          =  my_sanitize_string($request->type);
        $requestData['geo_country']   =  my_sanitize_number($request->geo_country);
        $requestData['geo_states']   =  my_sanitize_number($request->geo_states);
        $requestData['geo_cities']   =  my_sanitize_number($request->geo_cities);
        $requestData['vacancies']   =  my_sanitize_number($request->vacancies);
        $requestData['salary']   =  my_sanitize_string($request->salary);
        $requestData['expiration']   =  my_sanitize_string($request->expiration);
        // $requestData['gender']   =  my_sanitize_string($request->gender);
        // $requestData['age']   =  my_sanitize_string($request->age);


        // sanitize all questions data. 
        foreach ($requestData['jq'] as $jqk => $jqv) { 
            
            // dump($requestData['jq']);
            // dump($jqk);
            // dd($jqv['title']);

            $requestData['jq'][$jqk]['title'] = my_sanitize_string($jqv['title']); 
            if(!empty($jqv['option'])){
                foreach ($jqv['option'] as $jqok => $jqov) {
                    $requestData['jq'][$jqk]['option'][$jqok]['text'] = my_sanitize_string($requestData['jq'][$jqk]['option'][$jqok]['text']);  
                }
            }
        }
        
        // Jobs::find(12)->addJobQuestions($requestData['jq']); 
     

        // $requestData['questions']       =  json_encode( $requestData['questions']);
        $rules = array(
            "title" => "required|string|max:255",
            "description" => "required|string",
            "experience"  => "string|max:255",
            "type"  => "required|string|max:10",
            "geo_country"  => "integer",
            "geo_states"  => "integer",
            "geo_cities"  => "integer",
            "vacancies"  => "integer",
            "salary"  => "string|max:255",
            // "gender" => "required|in:male,female,any",
            "expiration" => "string|max:60",
            // "age" => "string|max:20",
        );
        $validator = Validator::make( $requestData , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            // dd(' all valiation correct ');
            $job = new Jobs();
            $job->title =  $requestData['title'];
            $job->description =  $requestData['description'];
            $job->experience =  $requestData['experience'];
            $job->type =  $requestData['type'];
            $job->country =  $requestData['geo_country'];
            $job->state =  $requestData['geo_states'];
            $job->city =  $requestData['geo_cities'];
            $job->vacancies =  $requestData['vacancies'];
            $job->salary =  $requestData['salary'];
            // $job->gender =  $requestData['gender'];
            // $job->age =  $requestData['age'];
            $job->user_id =  $user->id;
            $job->expiration =  $requestData['expiration'].' 00:00:00';
            // $job->questions =  $requestData['questions'];
            $job->save();

            $job->addJobQuestions($requestData['jq']); 

            return response()->json([
                'status' => 1,
                'message' => '<h3>Job Succesfully Created.</h3><p>Click here to view job detail</p>',
                // 'redirect' => route('')
            ]);
        }

    }


   

    //====================================================================================================================================//
    // Get // Show list of jobs posted by employer.
    //====================================================================================================================================//
    public function jobs(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        $data['jobs'] = Jobs::with('applicationCount')->where('user_id',$user->id)->orderBy('created_at', 'DESC')->get();
        return view('site.employer.myjobs', $data);
    }


    //====================================================================================================================================//
    // Get // layout for editing job.
    //====================================================================================================================================//
    public function jobEdit($id){
        $user = Auth::user();
        $job = Jobs::where('id',$id)->first();
        $data['user']   = $user;
        $data['job']    = $job;
        $data['title']  = 'Job Edit';
        $data['classes_body'] = 'jobEdit';
        $data['geo_countries'] = get_Geo_Country();
        $data['geo_states'] = get_Geo_State($job->country);
        $data['geo_cities'] = get_Geo_City($job->country, $job->state);
        return view('site.employer.jobEdit', $data);
    }


    //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    function empJobApplications($id){
        $user = Auth::user();
        if(isEmployer($user)){

            $job =  Jobs::find($id);

            // $applications    = JobsApplication::with(['job','jobseeker'])->where('job_id',$id)->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC')->paginate(1);

            // $data['applications'] = $applications;
            $data['job']   = $job;
            $data['user']   = $user;
            $data['title']  = 'Job Detail';
            $data['classes_body'] = 'jobdetail';
            return view('site.employer.jobApplication', $data);
        }
    }


     //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    function jobAppFilter(Request $request){
        // dd($request->toArray());
        $user = Auth::user();
        if(isEmployer($user)){
            // $job =  Jobs::find($id);

            $job_id = $request->job_id;

            $keyword = my_sanitize_string($request->ja_filter_keyword);
            $country = $request->ja_filter_country;
            $qualification_type = $request->ja_filter_qualification_type;
            $salaryRange = $request->ja_filter_salary;
          
            $applications    = JobsApplication::with(['job','jobseeker'])->where('job_id','=',$job_id);

            if(!empty($country) || !empty($qualification_type) || !empty($salaryRange) || !empty($keyword)){
                $applications = $applications->whereHas('jobseeker', function ($query) use($country, $qualification_type, $salaryRange, $keyword){
                    if(!empty($country)){ $query->where('country', '=', $country);  }   
                    if(!empty($salaryRange)){ $query->where('salaryRange', '>=', $salaryRange); }
                    if(!empty($keyword)){ 
                         $query->where('username', 'LIKE', "%{$keyword}%");
                    }
                    return $query; 
                });  
            }

            $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC')->paginate(1);
            // dd( $applications->toArray());
            $data['applications'] = $applications;
            // $data['job']   = $job;
            $data['user']   = $user;
            $data['title']  = 'Job Detail';
            $data['classes_body'] = 'jobdetail';
            return view('site.employer.jobApplicationAjax', $data);
        }
    }



    //====================================================================================================================================//
    // Ajax Post // Update job details.
    //====================================================================================================================================//
    public function updateJob($job_id, Request $request){
        $user = Auth::user();
        $requestData = $request->all();
        foreach ($requestData as $rk => $rv) { $requestData[$rk] = my_sanitize_string($rv); }
        $rules = array(
            "title" => "required|string|max:255",
            "description" => "required|string",
            "experience"  => "string|max:255",
            "type"  => "required|string|max:10",
            "geo_country"  => "integer",
            "geo_states"  => "integer",
            "geo_cities"  => "integer",
            "vacancies"  => "integer",
            "salary"  => "string|max:255",
            "gender" => "required|in:male,female,any",
            "age" => "string|max:20",
        );
        $validator = Validator::make( $requestData , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            // dd(' all valiation correct ');
            $job = Jobs::where('id',$job_id)->first();
            if ($job->user_id != $user->id){
                return response()->json([
                    'status' => 0,
                    'error' => 'You are not allowed to edit this job'
                ]);
            }else{
                $job->title =  $requestData['title'];
                $job->description =  $requestData['description'];
                $job->experience =  $requestData['experience'];
                $job->type =  $requestData['type'];
                $job->country =  $requestData['geo_country'];
                $job->state =  $requestData['geo_states'];
                $job->city =  $requestData['geo_cities'];
                $job->vacancies =  $requestData['vacancies'];
                $job->salary =  $requestData['salary'];
                $job->gender =  $requestData['gender'];
                $job->age =  $requestData['age'];
                $job->user_id =  $user->id;
                // $expiration =

                $job->expiration =  $requestData['expiration'].' 00:00:00';
                $job->save();
                return response()->json([
                    'status' => 1,
                    'message' => '<h3>Job Succesfully Created.</h3><p>Click here to view job detail</p>',
                    // 'redirect' => route('')
                ]);
            }
        }

    }



    //====================================================================================================================================//
    // Get // layout for listing of jobSeekers.
    //====================================================================================================================================//
    public function jobSeekers(Request $request){
        $user = Auth::user();
        if (!isEmployer($user)){ return redirect(route('jobs')); }
        $data['user']           = $user;
        $data['title']          = 'Job Seekers';
        $data['classes_body']   = 'jobSeekers';
        $jobSeekersObj          = new User();


    //    $userList =  User::with('profileImage')
    //    ->where('type','user')
    //    ->join('block_users', 'users.id', '!=', 'block_users.block')
    //    ->where('block_users.user_id',$user->id)
    //    ->toSql();
    //    ->get();
        // dd( $userList->toArray() );
        // dd( $userList );


        // $q->where('price_date', function($q) use ($start_date){
        //     $q->from('benchmarks_table_name')
        //         ->selectRaw('min(price_date)')
        //         ->where('price_date', '>=', $start_date)
        //         ->where('ticker', $this->ticker);
        // });

        // $userList = User::with('profileImage')
        //             ->where('type','user')
        //             ->whereNotIn('id', function($query) {
        //                 $query->select('block')->from('block_users')->where('user_id','id');
        //             })
        // // ->toSql();
        // ->get();

        // dd(  $userList  );
        // dd(  $userList->toArray()  );

        // $user = User::whereNotIn('id', function($query) {
        //     $query->select('user_id')->from('role_user');
        // })->get();


        $jobSeekers             = $jobSeekersObj->getJobSeekers($request, $user);
        $likeUsers                  = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();

        $data['likeUsers'] = $likeUsers;
        $data['jobSeekers'] = $jobSeekers;
        return view('site.employer.jobSeekers', $data);
    }


    //====================================================================================================================================//
    // Ajax POST // Block job seeker on Employer job seeker listing page.
    //====================================================================================================================================//
    public function blockJobSeeker($jobSekerId){
        $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to block Job Seekers',
                // 'redirect' => route('')
            ]);
        }

        // check if jobSeeker with id exist
        $jobSeeker = User::JobSeeker()->where('id',$jobSekerId);
        if (empty($jobSeeker)){
            return response()->json([
                'status' => 0,
                'error' => 'Job Seeker with id '.$jobSekerId.' do not exist',
            ]);
        }

        // block jos seeker.
        $blockUser = new BlockUser();
        $record = $blockUser->addEntry($user, $jobSekerId);
        return response()->json([
            'status' => 1,
            'message' => 'Job Seeker Succefuly Blocked',
            'data' =>  $record
        ]);

    }



    //====================================================================================================================================//
    // Ajax POST // Like job seeker on Employer job seeker listing page.
    //====================================================================================================================================//
    public function likeJobSeeker($jobSekerId){
        $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to block Job Seekers',
                // 'redirect' => route('')
            ]);
        }

        // check if jobSeeker with id exist
        $jobSeeker = User::JobSeeker()->where('id',$jobSekerId);
        if (empty($jobSeeker)){
            return response()->json([
                'status' => 0,
                'error' => 'Job Seeker with id '.$jobSekerId.' do not exist',
            ]);
        }

        // block jos seeker.
        $LikeUser = new LikeUser();
        $record = $LikeUser->addEntry($user, $jobSekerId);
        return response()->json([
            'status' => 1,
            'message' => 'Job Seeker Succefuly Liked',
            'data' =>  $record
        ]);

    }


    //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    public function credit(){
        $user = Auth::user();
        if(isEmployer($user)){

            $data['title']  = 'Credit';
            $data['user']   =  $user;
            $data['classes_body'] = 'credit';
            return view('site.credit.purchase', $data);
        }
    }


    //====================================================================================================================================//
    // Get // layout for job application question answer.
    //====================================================================================================================================//
    public function getJobAppQA($id){
        $user = Auth::user();
        if(isEmployer($user)){
            $jobsApplication = JobsApplication::with('answers.question')->where('id',$id)->first();
            $data['application'] = $jobsApplication;
            return view('site.layout.parts.jobApplicationQA', $data);
        }
    }


}
