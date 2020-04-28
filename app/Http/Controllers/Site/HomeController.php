<?php

namespace App\Http\Controllers\Site;

use App\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        // dd( $request->all() );
        // dd($validator);

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
                return array(
                    'status'    => 1,
                    'message'   => 'login succesfully'
                );
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

}
