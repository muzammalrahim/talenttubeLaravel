<?php

namespace App\Http\Controllers\Site;

use App\Home;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;


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

    public function join(Request $request){
        // dd( $request->toArray() );
        $data['geo_country'] = get_Geo_Country();
        // dd( $data['geo_country'] );
        if ( $request->get('type') === 'user' ){
            $data['title'] = 'Registeration';
            $view_name = 'site.register.user';
            return view($view_name, $data);
        }else {
            $data['title'] = 'Registeration';
            $view_name = 'site.register.employer';
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
            // attempt to do the login
            if (Auth::attempt($userdata)){
                // validation successful
                // do whatever you want on success
                if( $request->login_type == 'site_ajax' ){

                    // check if its employee or user.
                    if (isEmployer()){
                        $user = Auth::user();
                        // check if user has answer the initial question in step2.
                        $redirect_url = ($user->step2)?(route('employerProfile')):(route('step2Employer'));

                        return array(
                            'status'    => 1,
                            'message'   => 'login succesfully',
                            'redirect' =>  $redirect_url
                        );
                    }else{
                        return array(
                            'status'    => 1,
                            'message'   => 'login succesfully',
                            'redirect' => ''
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
        // dd( $request->toArray() );

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
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
            'email' => 'bail|required|email|unique:users,email',
            'phone' => '',
            'username' => 'required|unique:users,username',
            'password' => 'required|',
        );
        $validator = Validator::make( $request->all() , $rules);
        // dd( $request->all() );

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
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->username = $request->username;
            $user->email_verified_at = null;
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');

            if( $user->save() ){
                $user->roles()->attach([config('app.user_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                $success_message .= '<p>Redirecting to User info page.</p>';

                return response()->json([
                    'status' => 1,
                    'message' => $success_message,
                    'redirect' => route('profile')
                    // 'redirect' => route('step2')
                ]);
            }else{


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
            'firstname' => 'required',
            'surname' => 'required',
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
            'email' => 'bail|required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
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
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->username = $request->username;
            $user->email_verified_at = null;
            $user->email_verification   = hash_hmac('sha256', str_random(40), 'creativeTalent');
            $user->type   = 'employer';

            if( $user->save() ){
                $user->roles()->attach([config('app.employer_role')]);
                $success_message = '<div class="slogan">'.__('site.Register_Success').'</div>';
                $success_message .= '<div class="slogan">'.__('site.Verify_Email').'</div>';
                // $success_message .= '<p>Redirecting to User info page.</p>';
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
                   dd( $mail_status );
                }
                // dd( $user->toArray() );
            }
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



}
