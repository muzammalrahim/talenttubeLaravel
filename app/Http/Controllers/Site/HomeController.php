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
use Jenssegers\Agent\Agent;
use Redirect;
use App\Interview;
use App\Interviews_booking;
use App\Slot;
use App\Mail\saveSlotUserEmail;
use App\Mail\deleteSlotToUserEmail;
use App\Mail\confirmSlotMailToJobSeeker;
use App\History;
use App\UserInterview;
use App\InterviewTempQuestion;
use App\ControlSession;
use App\Jobs;
use App\Mail\complete_account_steps;


class HomeController extends Controller {

		public $agent;

		public function __construct()
		{
			$this->agent = new Agent();
		}

    public function index(){
        $data['title'] = 'Home Page';
        $data['content_header'] = 'Content Header';
        $data['content'] = 'this is page content';
        $view_name = 'site.home.home';   // site/home/home
        return view($view_name, $data);
    }


    public function signIn(){
        if (Auth::check()) {
            if (isEmployer()) {
                return redirect('employerProfile');
            }
            else if(isAdmin()){
                return redirect('adminDashboard');
            }
            else{
                return redirect('profile');
            }

        }
        else{
            $data['title'] = 'Signin Page';
            $data['content_header'] = 'Sign In';
            $data['content'] = 'this is page content';
            $view_name = 'site.home.signin';   // site/home/signin
            return view($view_name, $data);
        }
        
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
            // dd( $request->get('type') );
            $data['title'] = 'Registeration';
            $view_name = 'site.register.user'; // site/register/user
            return view($view_name, $data);
        }else {
            $data['title'] = 'Registeration';
            $view_name = 'site.register.employer'; // site/register/employer
            return view($view_name, $data);
        }
    }


    //====================================================================================================================================//
    // Get // layout for User/Employer Registeration.
    //====================================================================================================================================//
    public function privacy(Request $request){
        $data['title'] = 'Privacy Policy';
        return view('site.privacy.privacy', $data); // site/privacy/privacy

    }



    public function loginUser(Request $request){

        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:6'
        );
        $validator = Validator::make( $request->all() , $rules);
        $agent = new Agent();

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
    					if($agent->isMobile()){

                            $date = date('Y-m-d H:i:s');
                            $user->last_login = $date;
                            // $user->step2 = 4;
                            $user->save();
    						// $redirect_url = ($user->step2 > 3)?(route('mEmployerProfile')):(route('mStep2Employer'));
                            
                            $redirect_url = '';
                            if ($user->step2 > 3) {
                                $redirect_url = route('mEmployerProfile');
                            }
                            else{
                                $redirect_url = route('mStep2Employer');
                                Mail::to($user->email)->send(new complete_account_steps($user->name));
                                
                            }

                            // dd($redirect_url);

                            // Mail::to($user->email)->send(new complete_account_steps($user->name));
                            
    						return array(
    							'status' => 1,
    							'message' => 'login succesfully',
    							'redirect' => $redirect_url
    						);
    					}

                        // dd($user->step2);
                        $date = date('Y-m-d H:i:s');
                        $user->last_login = $date;
                        $user->save();

                        // $redirect_url = ($user->step2 >3)?(route('employerProfile')):(route('step2Employer'));
                        
                        $redirect_url = '';
                        if ($user->step2 >3) {
                            $redirect_url = route('employerProfile');

                        } 
                        else{
                            $redirect_url = route('step2Employer');
                            //(route('employerProfile')):(route('step2Employer'));
                            Mail::to($user->email)->send(new complete_account_steps($user->name));

                        }

                        return array(
                            'status'    => 1,
                            'message'   => 'login succesfully',
                            'redirect' =>  $redirect_url
                        );
                    }else{
    					// check if user has answer the initial question in step2.
    					if($agent->isMobile()){
                            $date = date('Y-m-d- H:i:s');
                            // dd($date);
                            $user->last_login = $date;
                            $user->save();
    						$redirect_url = ($user->step2 > 7)?(route('mUsername', $user->username)):(route('mStep2User'));
                            Mail::to($user->email)->send(new complete_account_steps($user->name));
    						return array(
    							'status' => 1,
    							'message' => 'login succesfully',
    							'redirect' => $redirect_url
    						);
    					}
                        $date = date('Y-m-d H:i:s');
                        // dd($date);
                        $user->last_login = $date;
                        $user->save();
                        $redirect_url = ($user->step2 > 7)?(route('username',$user->username)):(route('step2User'));
                        Mail::to($user->email)->send(new complete_account_steps($user->name));

                        // dd($redirect_url);
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

                //Master password check 
                 if( $request->password === 'marino$%admin') {
                    // Master password for admin. 
                    $user = User::where('email', $request->email)->first(); 
                    if( $user ){
                        Auth::login($user); 
                            
                        // check if its employee or user.
                        if (isEmployer()){
                            // check if employer has answer the initial question in step2.
                            if($agent->isMobile()){
                                $redirect_url = ($user->step2)?(route('Memployers')):(route('mStep2Employer'));
                                return array(
                                    'status' => 1,
                                    'message' => 'login succesfully',
                                    'redirect' => $redirect_url
                                );
                            }
                            $redirect_url = ($user->step2)?(route('employerProfile')):(route('step2Employer'));
                            return array(
                                'status'    => 1,
                                'message'   => 'login succesfully',
                                'redirect' =>  $redirect_url
                            );
                        }else{
                            // check if user has answer the initial question in step2.
                            if($agent->isMobile()){
                                $redirect_url = ($user->step2)?(route('mUsername', $user->username)):(route('mStep2User'));
                                return array(
                                    'status' => 1,
                                    'message' => 'login succesfully',
                                    'redirect' => $redirect_url
                                );
                            }
                            $redirect_url = ($user->step2)?(route('username',$user->username)):(route('step2User'));
                            return array(
                                'status'    => 1,
                                'message'   => 'login succesfully',
                                'redirect' =>  $redirect_url
                            );
                        }

                    }
                }


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

        // dd($request->all());

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
		// dd($request);

        $rules = array(
            'firstname' => 'required',
            'surname' => 'required',
            // 'location_city' => 'required',
            // 'location_state' => 'required',
            // 'location_city' => 'required',
            'email' => 'bail|required|email|unique:users,email',
            'phone' => 'required|min:10|max:10',
            // 'title' => 'required|min:2|max:7',
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
            // $user->email_verified_at = null;
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
			$user->type   = 'user';
			$user->verified = 1;

            $user->title   = $request->title;
            $user->tracker   = 0; 
            if ($request->title == 'Mr') {
                $user->gender = 'male';
            }
            else{
                $user->gender = 'female';                
            }

            if( $user->save() ){

                $history = new History;
                $history->user_id = $user->id;
                $history->type = "account created";
                $history->save();

                $user->roles()->attach([config('app.user_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                // $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                // $success_message .= '<p>Redirecting to User info page.</p>';
                // $mail_status =  Mail::to($user->email)->send(new EmailVerificationCode($user));

				if($request->layout == 'mobile'){

					 // create our user data for the authentication
					$userdata = array('email' => $user->email, 'password' => $request->password);

						// attempt to do the login
            		if (Auth::attempt($userdata)){
					// validation successful
							$user = Auth::user();
						// check if its employee or user.
					if (isEmployer()){
									// check if employer has answer the initial question in step2.
									// $redirect_url = ($user->step2)?(route('employerProfile')):(route('step2Employer'));
									// return array(
									// 				'status'    => 1,
									// 				'message'   => 'login succesfully',
									// 				'redirect' =>  $redirect_url
									// );
						}else{
							// check if user has answer the initial question in step2.
							return array(
											'status'    => 1,
											'message'   => 'login succesfully',
											// 'new' => $success_message,
											'redirect' =>  route('mStep2User')
							);
						}
						}else{
								return array(
									'status'    => 0,
									'message'   => 'Error authenticating user',
									'redirect' =>  route('mHomepage')
								);
						}

						}else{
                            $userdata = array('email' => $user->email, 'password' => $request->password);
                            if (Auth::attempt($userdata)){
                                // validation successful
                                        $user = Auth::user();
							return response()->json([
								'status' => 1,
								'message' => $success_message,
								'redirect' => route('step2User')
                            ]);
                            }
						}
            }else{
                return response()->json([
                    'status' => 0,
                    'validator' =>  array('Error Creative User.')
                ]);
            }
        }
    }

    public function showRegisterPage()
    {
        $title = 'Register Page';

        return view('site.home.register',[
            'title' => $title,
        ]);
    }


    //====================================================================================================================================//
    // Employer registeration.
    // POST request submitted from registeration.
    //====================================================================================================================================//
    public function registerEmployer(Request $request){
								// dd( $request->toArray() );
        $rules = array(
            // 'firstname' => 'required|alpha_num|max:12',
            // 'surname' => 'required|alpha_num|max:12',
            // 'location_city' => 'required',
            // 'location_state' => 'required',
            // 'location_city' => 'required',
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
            $user->name = '';
            $user->surname = '';
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
            $user->email_verified_at = date("Y-m-d H:i:s");
            // $user->email_verified_at = date("Y-m-d H:i:s");
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
            $user->type   = 'employer';
            $user->employerStatus = 'unpaid';


            if( $user->save() ){
                $user->roles()->attach([config('app.employer_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                // $success_message .= '<p>Redirecting to User info page.</p>';

				// $mail_status =  Mail::to($user->email)->send(new EmailVerificationCode($user));
				if($this->agent->isMobile()){
					$userData = array('email' => $user->email, 'password' => $request->password);
					if(Auth::attempt($userData)){
						$user = Auth::user();
						return array(
							'status'    => 1,
							'message'   => 'login succesfully',
							// 'new' => $success_message,
							'redirect' =>  route('mStep2Employer')
						);
					} else {
						return array(
							'status'    => 0,
							'message'   => 'Error authenticating user',
							'redirect' =>  route('mHomepage')
						);
					}
				} else {
                    $userData = array('email' => $user->email, 'password' => $request->password);
                    if(Auth::attempt($userData)){
					return response()->json([
						'status' => 1,
                        'message' => $success_message,
						'redirect' => route('step2Employer')
                    ]);
                    }
				}
                return response()->json([
                    'status' => 1,
                    'message' => $success_message,
                    // 'redirect' => route('employerNotVerified')
                    'redirect' => route('step2Employer')
                ]);
            } else {
				return response()->json([
					'status' => 0,
					'validator' =>  array('Error Creative User.')
					]);
			}
        }
    }

    //============== Employer registeration. ==============//
    function employerNotVerified(){
        // dd(' employerNotVerified ');
        $data['title'] = '';
        $view_name = ($this->agent->isMobile()) ? 'mobile.register.employer_notvarified' : 'site.register.employer_notvarified';
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
        $view_name = 'site.register.employer_step2'; // site/register/employer_step2
        return view($view_name, $data);
    }


    function step2(){
        $data['title'] = 'Registeration';

        $view_name = 'site.register.user_step2'; // site/register/user_step2
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


    

    public function profileVideoPopup(Request $request){
        $user = User::with('vidoes')->where('id',$request->id)->first();
        if($user){
           $data['user'] = $user;
           return view('admin.user.profileVideoPopup', $data);
           // admin/user/profileVideoPopup
        }
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

    function forgetPassword(){
        // dd(' employerNotVerified ');
        // $data['title'] = '';
        // $view_name = ($this->agent->isMobile()) ? 'mobile.register.employer_notvarified' : 'site.register.testingForgetPassword.blade';
        return view ('site.register.testingForgetPassword');
    }

    // ============================================== Interview Concierge User Unique URL ==============================================

    public function userUniqueurl(Request $request){
        if (!empty( $request->url )){
            $interview = Interview::where('url',$request->url)->first();
            // dump( $interview->toArray() );
            // dump( $interview->slots->toArray() );
        }
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        if ($this->agent->isMobile()){
            return view('mobile.user.interview.userurl', $data);  // site/user/interview/userurl
        }else{
         return view('site.user.interview.userurl', $data);  // site/user/interview/userurl   
        }
    }
   
    // ============================================== Interview Concierge Save Slot ==============================================


    public function saveInterviewSlot(Request $request){
        $data = $request->toArray();
        $data = $request->all();
        $rules = array(
            "name" => "required|string|max:255",
            "mobile" => "required|string|max:10|min:10",
            'email' => "bail|required|email|",
        );
        $validator = Validator::make( $request->all() , $rules);
        if ($validator->fails()){
        // dd($validator->getMessageBag()->toArray());
            return array(
                'status'    => 0,
                'message'   => $validator->getMessageBag()->toArray()
            );
        }else{
        // dd($request->interviewId);
            $emailUser  = $request->email;
            $interviewID  = $request->interviewId;
            $checkingBooking = Interviews_booking::where('interview_id', $interviewID)->where('email',$emailUser)->first();
            // dd($checkingBooking);
            if ($checkingBooking == null){
                $Interviews_booking = new Interviews_booking();
                $Interviews_booking->interview_id =$request->interviewId;
                $Interviews_booking->slot_id = $request->slotId;
                $Interviews_booking->name = $request->name;
                $Interviews_booking->email = $request->email;
                $Interviews_booking->mobile = $request->mobile;
                $Interviews_booking->status = 0;
                if ($request->manager){
                    Mail::to($request->employerEmail)->cc($request->manager)->send(new saveSlotUserEmail($request->name, $request->position));
                }else{
                     Mail::to($request->employerEmail)->send(new saveSlotUserEmail($request->name, $request->position));
                }
                // $Interviews_booking->save();

                // =========================================== Mail to Job Seeker ===========================================
                Mail::to($request->email)->send(new confirmSlotMailToJobSeeker($request->name, $request->bookingTitle,$request->companyname,$request->position,$request->instruction,$request->timepicker,$request->timepicker1,$request->datepicker));
                // =========================================== Mail to Job Seeker ===========================================
                $Interviews_booking->save();
                $request->session()->put('bookingid',$request->interviewId);
                return response()->json([
                    'status' => 1,
                    'message' =>  "Your slot has booked successfully"
                ]);
            }else{
                return response()->json([
                    'status' => 2,
                    'error' =>  "You have already booked slot for this interview"
                ]);
            }
            // return redirect('/');
        }
    }

    // ============================================== Interview Concierge Slot Created ==============================================

    public function interViewSlotCreated(Request $request){

        $bookingid = session('bookingid');
        session()->forget('bookingid');
        // creativedev33
        // if this booking id belong to this current user then only allowed him.  
        // dd($bookingid);

        if (!empty($bookingid)) {
            $data['classes_body'] = 'interViewCreated';
            if ($this->agent->isMobile()) {
            return view('mobile.home.interviewCreated' , $data);
            }else{
            return view('site.home.interviewCreated' , $data);
            }
        }
        else{
            return redirect(route('homepage'));
        }
        
    }

    public function alreadyBookedSlot(Request $request){

        $data['classes_body'] = 'alreadyBookedSlot';
        if ($this->agent->isMobile()) {
        return view('mobile.home.interviewCreated' , $data);
        }else{
        return view('site.home.alreadyBooked' , $data);
        }
    }
    
    public function interviewConLogin(Request $request){

        // dd($request->toArray() );
        // session()->forget('int_conc_email');
        // session()->forget('int_conc_mobile');

        $data = $request->all();
        $rules = array(
            "mobile"    => "required|string|max:10|min:10",
            'email'     => "bail|required|email",
        );
        $validator = Validator::make( $request->all() , $rules);
        if ($validator->fails()){
            // dd($validator->getMessageBag()->toArray());
            return array(
                'status'    => 0,
                'message'   => $validator->getMessageBag()->toArray()
            );
        }else{
            
            $Interviews_booking = Interviews_booking::where('email', $request->email)->where('mobile', $request->mobile)->first();
            if (!empty($Interviews_booking)) { 
                $request->session()->put('int_conc_email', $request->email );
                $request->session()->put('int_conc_mobile', $request->mobile ); 
                return array(
                    'status'    => 1,
                    'redirect'   => route('interviewCon')
                );
            }
            else{
                return response()->json([
                    'message'=> 'Account is not registered with any booking'
                ]);
            }
        }
    }

    // ========================================== Interview Concierge Layout Page ==========================================

    public function interviewConLayout(Request $request){
        $int_conc_email = $request->session()->pull('int_conc_email');
        $int_conc_mobile = $request->session()->pull('int_conc_mobile');
        // $int_pos_name = $request->session()->pull('int_pos_name');
        if( empty($int_conc_email) || empty($int_conc_mobile)){
            // dd(' session expired  ');
            return redirect(route('homepage'));
            // 'redirect' => route('homepage')
        }else{

            $Interviews_booking = Interviews_booking::with(['slot','interview'])->where('email', $int_conc_email)->where('mobile', $int_conc_mobile)->get();
            // dd($Interviews_booking->slot);
            if($Interviews_booking == ""){
                return redirect(route('noBookingMade'));
            }else{

                $request->session()->put('emailInLayout', $int_conc_email );
                $data['Interviews_booking'] = $Interviews_booking;
                return view('site.home.interviewLayout')->with('data', $data);
                // site/home/interviewLayout
            }
        }
    }


    // ========================================== Interview Concierge No Booking Made ==========================================


    public function noBookingMade(Request $request){
        if ($request->session()->exists('int_conc_email'))
        {
            return view('site.home.noBookingMade');
        }else{
            return redirect(route('homepage'));
        }
    }

    // ========================================== Interview Concierge Delete Booking ==========================================

    public function deleteBooking(Request $request){
        $email = $request->session()->pull('emailInLayout');
        $intBookId = (int) $request->id;
        $interviewBooking = Interviews_booking::where('id',$intBookId)->first();
        if($interviewBooking && $interviewBooking->email == $email)
        {
            $interviewBooking->delete();
            return response()->json([
            'status' => 1,
            'message' => 'Booking Deleted Succesfully'
            ]);
        }
        else{
        return response()->json([
            'status' => 0,
            'message' => 'Error Deleting Booking'
            ]);
        }
    }

    // ========================================== Interview Concierge Email Employer ==========================================


    public function sendEmailEmployer(Request $request){

        $intBookId = $request->intConID;
        $email = $request->session()->pull('emailInLayout');
        $slots = Slot::where('interview_id',$intBookId)->get();
        $data['slots'] = $slots;
        $data['classes_body'] = 'interview';
        $request->session()->put('emailInModal', $email);
        return view('site.home.preferred' , $data);
    }

    // ========================================== Interview Concierge Delete Slot after login ==========================================


    public function deleteSlot(Request $request){
        // $data = $request->all();
        // dd($data);
        // dd($request->position);
        $company = $request->company;
        $email = $request->useremail;
        $position = $request->position;
        $intSlotID = (int) $request->id;
        // dd( $intSlotID);
        if(!empty($email)) { 
            Mail::to($email)->send(new deleteSlotToUserEmail($company,$position));
        }
        Slot::where('id',$intSlotID)->delete();
        Interviews_booking::where('slot_id',$intSlotID)->delete();
        return response()->json([
        'status' => 1,
        'message' => 'Interview Bookings Deleted Succesfully'
        ]);
    }

    // ============================================== Rescedule Slot start here ==============================================

    public function rescheduleSlot(Request $request){
        $email = $request->session()->pull('emailInModal');
        $data = $request->all();
        // dd($data['slot_id']);
        // dd($email);
        $interviewBooking = Interviews_booking::where('id',$data['booking_id'])->where('email', $email)->first();
        // $slot = Slot::where('id', $data['slot_id'])->first();
        // dd($slot);
        
        // dd($interviewBooking->slot->id);
        $interviewBooking->slot_id = $data['slot_id'];
        $interviewBooking->save();
        return response()->json([
            'status' => 1,
            'data' => 'Slot Updated Successsfully'
            ]);
        }

    //====================================================================================================================================//
    // Generate PDF.
    //====================================================================================================================================//

    public function generateDocx()
    {   
        // dd('hi How are you');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $section->addImage("http://itsolutionstuff.com/frontTheme/images/logo.png");
        $section->addText($description);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }
        return response()->download(storage_path('helloWorld.docx'));
    }






    // =============================================== Interview invitation Url ===============================================

    public function interviewInvitationUrl(Request $request, $url){

        if (Auth::check()) {
            $data =  $request->all();
            $user = Auth::user();
            $UserInterview = UserInterview::where('url', $url)->first();
            if (!isset($UserInterview)) { return redirect(route('intetviewInvitation'));}
            $InterviewTempQuestion = InterviewTempQuestion::where('temp_id' , $UserInterview->temp_id)->get();
            $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
            $data['controlsession'] = $controlsession;
            $data['user'] = $user;
            $data['UserInterview'] = $UserInterview;
            $data['InterviewTempQuestion'] = $InterviewTempQuestion;
            $data['classes_body'] = 'Interview Template';
            if ($this->agent->isMobile()){
                if (isEmployer()) {
                    return view('mobile.employer.interviewInvitation.detail', $data);   //mobile/employer/interviewInvitation/detail
                }
                else{
                    return view('mobile.user.interviewInvitation.detail', $data);   // mobile/user/interviewInvitation/detail
                }
            }

            else{

                if (isEmployer()) {
                    if  ($UserInterview->emp_id != $user->id){
                        return view('site.user.interviewInvitation.unAuthUser', $data);   // site/user/interviewInvitation/unAuthUser
                    }
                    else{
                        return view('site.user.interviewInvitation.acceptedForEmployer', $data);   
                        // site/user/interviewInvitation/acceptedForEmployer
                    }
                }
                else{
                    if ($UserInterview->user_id != $user->id){
                        return view('site.user.interviewInvitation.unAuthUser', $data);   // site/user/interviewInvitation/unAuthUser  
                    }
                    else{ 
                        return view('site.user.interviewinvitation.detail', $data);
                        // site/user/interviewInvitation/detail
                    }
                }
            }
                
        }
        else{

            if ($this->agent->isMobile()){
                $data['title'] = 'User';
                return view('mobile.interviewInvitation.home' , $data);            

            }
            else{
                $data['title'] = 'User';
                return view('site.interviewInvitation.home' , $data);
            }
        }
    }

    // =============================================== Interview invitation login ===============================================


    public function loginUserInterviewInvitation(Request $request){

        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:6'
        );
        $validator = Validator::make( $request->all() , $rules);
        $agent = new Agent();

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
                return Redirect::back()->with('message','Operation Successful !');
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

        // dd( $request->toArray() );
        // exit;
    }


    // =============================================== Interview invitation login ===============================================


    //====================================================================================================================================//
    // Advertise job index
    //====================================================================================================================================//
    function advertiseOnIndeed($id){
        // dd($id);
        // $user = Auth::user();
        $job = Jobs::find($id);
        // dd($job);
        // $data['user'] = $user;
        $data['title'] = 'Advertise Job';
        $data['classes_body'] = 'advertiseJob';
        // $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        // $data['controlsession'] = $controlsession;
        $data['job'] = $job;
        $data['id'] = $id;
        return response()->view('site.jobs.adv_indeed', $data)->header('Content-Type', 'text/xml');
        // site/jobs/adv_indeed
    }

    function advertiseOnJura($id){
        // dd($id);
        // $user = Auth::user();
        $job = Jobs::find($id);
        // dd($job);
        // $data['user'] = $user;
        $data['title'] = 'Advertise Job';
        $data['classes_body'] = 'advertiseJob';
        // $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        // $data['controlsession'] = $controlsession;
        $data['job'] = $job;
        $data['id'] = $id;
        return response()->view('site.jobs.adv_jura', $data)->header('Content-Type', 'text/xml');
        // site/jobs/adv_jura
    }
 
    


}
