<?php

namespace App\Http\Controllers\Mobile;

use App\Home;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use App\TestLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Qualification;
use FFMpeg;

// use Intervention\Image\Facades\Image;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Facades\Mail;



class MobileController extends Controller {


    //====================================================================================================================================//
    //  Get home layout for mobile
    //====================================================================================================================================//
    
    public function index(){
        $data['title'] = 'Home Page';
        $data['content_header'] = 'Content Header';
        $data['content'] = 'this is page content';
        return view('site.home.home', $data);
        // return view('mobile.home.home', $data);

    }

 		

 		//====================================================================================================================================//
    // Get // layout for User/Employer Registeration.
    //====================================================================================================================================//
    public function join(Request $request){
        if ( $request->get('type') === 'user' ){
            $data['title'] = 'Registeration';
            $view_name = 'mobile.register.user'; // mobile/register/user
            return view($view_name, $data);
        }else {
            $data['title'] = 'Registeration';
            $view_name = 'mobile.register.employer'; // mobile/register/employer
            return view($view_name, $data);
        }
    }

    
    

}



