<?php

namespace App\Http\Controllers\Site;

use App\Home;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use App\TestLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Qualification;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use FFMpeg;


class HomeController extends Controller {

    public function index(){
        $data['title'] = 'Home Page';
        $data['content_header'] = 'Content Header';
        $data['content'] = 'this is page content';
        $view_name = 'site.home.home';
        return view($view_name, $data);
    }


    public function create() { }
    public function store(Request $request){ }
    public function show(Home $home){ }
    public function edit(Home $home){ }
    public function update(Request $request, Home $home){ }


    public function profile(){}



    //====================================================================================================================================//
    // Get // layout for User/Employer Registeration.
    //====================================================================================================================================//
    public function join(Request $request){
         
        $data['geo_country']    = get_Geo_Country();
        $data['geo_state']      = get_Geo_State(default_Country_id());
        $data['geo_cities']     = get_Geo_City(default_Country_id(), default_State_id());
        
        if ( $request->get('type') === 'user' ){
            $data['title'] = 'Registeration';
            $view_name = 'site.register.user'; // site/register/user
            return view($view_name, $data);
        }else {
            $data['title'] = 'Registeration';
            $view_name = 'site.register.employer'; // site/register/employer
            return view($view_name, $data);
        }
    }


    public function loginUser(Request $request){

        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:6'
        );
        $validator = Validator::make( $request->all() , $rules);

        if ($validator->fails()){
            // dd($validator->getMessageBag()->toArray());
            return array(
                'status'    => 0,
                'message'   => $validator->getMessageBag()->toArray()
            );
        }else{
            // create our user data for the authentication
            $userdata = array( 
            'email' =>  $request->get('email') ,
            'password' => $request->get('password')
            );

            if( $request->login_type == 'site_ajax' ){
                // check user verification before login
                $userData = User::where('email', $request->get('email'))->first();
                if( !empty($userData) ){
                    // check if employer is verified by admin
                    if ( $userData->email_verified_at == null){
                        return array(
                            'status'    => 1,
                            'message'   => 'not verified account',
                            'redirect' =>   route('employerNotVerified')
                        );
                    }
                }
            }

            // attempt to do the login
            if (Auth::attempt($userdata)){
                // validation successful
                // do whatever you want on success
                if( $request->login_type == 'site_ajax' ){
                     $user = Auth::user();
                    // check if its employee or user.
                    if (isEmployer()){
                        // check if employer has answer the initial question in step2.
                        $redirect_url = ($user->step2)?(route('employerProfile')):(route('step2Employer'));
                        return array(
                            'status'    => 1,
                            'message'   => 'login succesfully',
                            'redirect' =>  $redirect_url
                        );
                    }else{
                        // check if user has answer the initial question in step2.
                        $redirect_url = ($user->step2)?(route('username',$user->username)):(route('step2User'));
                        return array(
                            'status'    => 1,
                            'message'   => 'login succesfully',
                            'redirect' =>  $redirect_url
                        );
                    }

                }else{
                    if( isAdmin() ){  return redirect('admin/adminDashboard');}
                    else{ return redirect('/profile'); }
                }

            }else{
                // validation not successful, send back to form
                return array(
                    'status'    => 0,
                    'message'   => 'Wrong password or log in information'
                );
            }
        }

        // dd( $request->toArray() );
        // exit;
     }




     public function geo_states(Request $request){
        $states = DB::table('geo_state')->where('country_id', $request->get('select_id'))->get();
        $stat_html = '<option value="0">'.__('site.ChooseState').'</option>';
        if($states){
            foreach ($states as $key => $state) {
                $stat_html .= '<option value="'.$state->state_id.'">'. $state->state_title .'</option>';
            }
        }
        return response()->json([
            'status' => 1,
            'list' =>  $stat_html
        ]);
    }

    public function geo_cities(Request $request){
        $cities = DB::table('geo_city')->where('state_id', $request->get('select_id'))->get();
        $cities_html = '<option value="0">'.__('site.choose_a_city').'</option>';
        if($cities){
            foreach ($cities as $key => $city) {
                $cities_html .= '<option value="'.$city->city_id.'">'. $city->city_title .'</option>';
            }
        }
        return response()->json([
            'status' => 1,
            'list' =>  $cities_html
        ]);
    }

    public function register(Request $request){
        
        // "_token" => "aoBTzArrllzmFQ8fw7zFhktY2lzW8jc1qbw2lH2T"
        // "firstname" => "Creative"
        // "surname" => "khan"
        // "country" => "165"
        // "state" => "1604"
        // "city" => "29381"
        // "email" => "creativedev22@gmail.com"
        // "phone" => "0123456"
        // "join_handle" => "creative"
        // "join_password" => "12345678"
        // "privacy_policy" => "1"

        $rules = array(
            'firstname' => 'required',
            'surname' => 'required',
            'location_city' => 'required',
            'location_state' => 'required',
            'location_city' => 'required',
            'email' => 'bail|required|email|unique:users,email',
            'phone' => 'required|min:10|max:10',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',

        );
        $validator = Validator::make( $request->all() , $rules);
        
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            $user = new User();
            $user->name = $request->firstname;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->country = $request->location_country;
            $user->state = $request->location_state;
            $user->city = $request->location_city;
            $user->location = $request->location_name;
            $user->location_lat = $request->location_lat;
            $user->location_long = $request->location_long;
            $user->username = $request->username;
            $user->email_verified_at = null;
            // $user->email_verified_at = date("Y-m-d H:i:s");
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
            $user->type   = 'user';

            if( $user->save() ){
                $user->roles()->attach([config('app.user_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                // $success_message .= '<p>Redirecting to User info page.</p>';

                $mail_status =  Mail::to($user->email)->send(new EmailVerificationCode($user));

                return response()->json([
                    'status' => 1,
                    'message' => $success_message,
                    'redirect' => route('profile')
                    // 'redirect' => route('step2')
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'validator' =>  array('Error Creative User.')
                ]);
            }
        }
    }


    //====================================================================================================================================//
    // Employer registeration.
    // POST request submitted from registeration.
    //====================================================================================================================================//
    public function registerEmployer(Request $request){
        // dd( $request->toArray() );
        $rules = array(
            'firstname' => 'required|alpha_num|max:12',
            'surname' => 'required|alpha_num|max:12',
            'location_city' => 'required',
            'location_state' => 'required',
            'location_city' => 'required',
            'email' => 'bail|required|email|unique:users,email',
            'phone' => 'required|min:10|max:10',
            'companyname' => 'required|string|max:25',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        );
        $validator = Validator::make( $request->all() , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            $user = new User();
            $user->name = $request->firstname;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->country = $request->location_country;
            $user->state = $request->location_state;
            $user->city = $request->location_city;
            $user->location = $request->location_name;
            $user->location_lat = $request->location_lat;
            $user->location_long = $request->location_long;
            $username = $request->firstname."-".$request->surname;
            $username = remove_spaces($username);
            $user->username = $username;
            $user->company = $request->companyname;
            $user->email_verified_at = null;
            // $user->email_verified_at = date("Y-m-d H:i:s");
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
            $user->type   = 'employer';

            if( $user->save() ){
                $user->roles()->attach([config('app.employer_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                // $success_message .= '<p>Redirecting to User info page.</p>';
                
                $mail_status =  Mail::to($user->email)->send(new EmailVerificationCode($user));

                return response()->json([
                    'status' => 1,
                    'message' => $success_message,
                    'redirect' => route('homepage')
                    // 'redirect' => route('step2Employer')
                ]);
            }
        }
    }

    //============== Employer registeration. ==============//
    function employerNotVerified(){
        // dd(' employerNotVerified ');
        $data['title'] = '';
        $view_name = 'site.register.employer_notvarified';
        return view($view_name, $data);
    }

    //============== Employer registeration. ==============//
    function resendVerificationCode(Request $request){
        // dd( $request->toArray() );

        if(!empty($request->email)){
            $user = User::where('email',$request->email)->first();
            if (!$user){
                return response()->json([
                    'status' => 0,
                    'message' => '<p>This Email address does not exist.</p>'
                ]);
            }else{
                if (!$user->email_verified_at){
                    $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
                    $user->save();

                    // dd( route('accountVerification',['id' => $user->id, 'code' => $user->email_verification]) );
                    // dd( $user->email );

                   $mail_status =  Mail::to($user->email)->send(new EmailVerificationCode($user));
                   // dd( $mail_status );
                    return response()->json([
                    'status' => 1,
                    'message' => '<div style="color:white;"><p>Verification Email Send Succesfully.</p></div>'
                ]);
                }
                // dd( $user->toArray() );
            }
        }
    }

    //============== Employer AccountVerification. ==============//
    function accountVerification($id,$code){
        $user = User::where('id', $id)->where('email_verification', $code)->first();
        if(!empty($user)){
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->email_verification = null;
            $user->save();
            // return redirect(route('homepage'));
            echo 'Email Verified succesfully';
            exit;
        }else{
            return view('unauthorized');
        }
    }


    function step2Employer(){
        $data['title'] = 'Registeration';
        $view_name = 'site.register.employer_step2';
        return view($view_name, $data);
    }


    function step2(){
        $data['title'] = 'Registeration';

        $view_name = 'site.register.user_step2';
        return view($view_name, $data);
    }

    function imgshow($userid, $slug){
       // dd(' image show ',$userid, $slug);
       $path_var = 'images/user/'.$userid.'/gallery/'.$slug;
       $path = storage_path($path_var);
        if (!File::exists($path)) {
            return response()->json(['error' => $path_var.' can not be found.']);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
	}



	function fileshow($userid, $slug){
		$path_var = 'images/user/'.$userid.'/private/'.$slug;
		$path = storage_path($path_var);
			if (!File::exists($path)) {
							return response()->json(['error' => $path_var.' can not be found.']);
			}
			$file = File::get($path);
			$type = File::mimeType($path);
			$response = Response::make($file, 200);
			$response->header("Content-Type", $type);
			return $response;
	}


    function fileshow2($userid, $slug){
        // dd(' fileshow2 ');
        $path_var = 'media/public/'.$userid.'/'.$slug;
        $path = storage_path($path_var);
        if (!File::exists($path)) {
            return response()->json(['error' => $path_var.' can not be found.']);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    function privateFileshow($userid, $slug){
        $path_var = 'media/private/'.$userid.'/'.$slug;
        $path = storage_path($path_var);
            // dd( $path_var ); 
        if (!File::exists($path)) {
            return response()->json(['error' => $path_var.' can not be found.']);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }



    // Provide a streaming file with support for scrubbing
    // $contentType, $path
    function videoStream($userid, $slug) {

        $path_var = 'media/private/'.$userid.'/videos/'.$slug;
        $path = storage_path($path_var);

        $video_path = 'somedirectory/somefile.mp4';
        $stream = new \App\Helpers\VideoStream($path);
        $stream->start(); 

        // $path_var = 'media/private/'.$userid.'/videos/'.$slug;
        // $path = storage_path($path_var);
        // $fullsize = filesize($path);
        
        // $size = $fullsize;
        // $stream = fopen($path, "r");
        // $response_code = 200;
        // $headers = array("Content-type" => 'video/mp4');
        
        // // Check for request for part of the stream
        // $range = Request::header('Range');
        // if($range != null) {
        //     $eqPos = strpos($range, "=");
        //     $toPos = strpos($range, "-");
        //     $unit = substr($range, 0, $eqPos);
        //     $start = intval(substr($range, $eqPos+1, $toPos));
        //     $success = fseek($stream, $start);
        //     if($success == 0) {
        //         $size = $fullsize - $start;
        //         $response_code = 206;
        //         $headers["Accept-Ranges"] = $unit;
        //         $headers["Content-Range"] = $unit . " " . $start . "-" . ($fullsize-1) . "/" . $fullsize;
        //     }
        // }
        
        // $headers["Content-Length"] = $size;

        // return Response::stream(function () use ($stream) {
        //     fpassthru($stream);
        // }, $response_code, $headers);

    }





    function textLog(){

        $log = TestLog::get();
        dd( $log->toArray() );
    }


     public function phpini(){
        phpinfo();
     }

     public function test2(){
        dump('test2');


        $user_path = Storage::disk('privateMedia');
      

        $video_file = FFMpeg::fromFilesystem($user_path)->open('/27/videos/video-1590992473.mp4');

        dump($user_path);
        dd($video_file);

        // $ffmpeg = FFMpeg\FFMpeg::create(array(
        //     'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe',
        //     'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe'
        // ));
        //  dd( $ffmpeg );

        // $ffmpeg = FFMpeg\FFMpeg::create(array(
        //     'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
        //     'ffprobe.binaries' => '/usr/bin/ffprobe'
        // ));
        //  dd( $ffmpeg );


        // $path = '19/private/videos/video-1589261510.mp4';
        // $path = storage_path('images/test.mp4');
        // if (!File::exists($path)) { dd(' file not exist '); }



        // $video_file = Storage::disk('user')->get($path);
        $user_path = Storage::disk('user');
        $video_file = FFMpeg::fromFilesystem($user_path)->open('test.mp4');

        //dump('video_file = ', $video_file);

        $duration = $video_file->getDurationInSeconds(); 
        dump('duration',  $duration ); 


        $thumbnailIntervalTimeArr = $this->getThumbnailIntervalTimeArr($duration); 

        dump('thumbnailIntervalTimeArr',  $thumbnailIntervalTimeArr ); 


        $counter = 1;
        foreach ($thumbnailIntervalTimeArr as $interval){
            // $framePath = $this->contentBasePath."/frame_$counter.jpg";
            // $video_file->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($interval))->save($framePath);
            //  // use code listen below code is optional to generate the thumbnail image from frame
            // $counter++;


            $image = $video_file->getFrameFromSeconds($interval)->export()->save('FrameAt'.$interval.'sec.png');   
           
            // dump(' image ', $image); 


            $counter++;
        }



        // ->getFrameFromSeconds(10)
        // ->export()
        // ->toFilesystem('user')
        // ->save('19/private/videos/FrameAt10sec.png');

        // $media = FFMpeg::open('steve_howe.mp4');
        // $frame = $media->getFrameFromString('00:00:13.37');

        // // or

        // $timecode = new FMpeg\Coordinate\TimeCode(...);
        // $frame = $media->getFrameFromTimecode($timecode);

     }





     private function getThumbnailIntervalTimeArr($duration){ 
                $durationInSec = intval($duration); 
                $intervalArr = range(0,$duration, $duration/4); 
                return array_slice($intervalArr, 1, -1); 
        }


    public function test3(){
       // $qualifications =  getQualificationsList(); 
       // // dd( $qualifications ); 
       // foreach ($qualifications as $key => $qualification) {
       //     $qual = new Qualification(); 
       //     $qual->type = $qualification['type']; 
       //     $qual->title = $qualification['title']; 
       //     $qual->save();  
       // }

        $jobseekers = User::where('type','user')->get(); 
        // dd($jobseekers); 
        foreach ($jobseekers as $key => $js) {
            
            if(!empty($js->qualification)){

                $qualif =  json_decode($js->qualification); 
                // dump( $js->qualification ); 
                // dump( $qualif ); 
                // dump( getQualificationsData(array($qualif[0]))); 
                // dump( getQualificationsData($js->qualification) ); 
                


            }
        }
    }

}
