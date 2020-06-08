<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Users';
        $data['content_header'] = 'Users List';
        return view('admin.user.list', $data);
    }

    public function employers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        return view('admin.employer.list', $data);
    }


    /** ================ This method returns the datatables data to view ================ */
    public function getDatatable(){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('users.edit',['id' =>$records->id]).'">'.__('common.edit').'</a>';
            return $rhtml;
        }
      })
      ->toJson();
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getEmployerDatatable(){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('employers.edit',['id' =>$records->id]).'">'.__('common.edit').'</a>';
            return $rhtml;
        }
      })
      ->toJson();
    }


    /** ================   ================ */
    public function create(){
        $data['record']   = FALSE;
        $data['title']  = 'User';
        $data['content_header'] = 'Add new User';

        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();

        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();



        return view('admin.user.edit', $data);
    }


     public function createEmployer(){
        $data['record']   = FALSE;
        $data['title']  = 'Employer';
        $data['content_header'] = 'Add new Employer';

        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();

        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();



        return view('admin.employer.edit', $data);
    }


    // 

    /** ================   ================ */
    public function edit(User $id){
        $user = $id; 
        $data['record']   = $id;
        $data['title']  = 'User';
        $data['content_header'] = 'Edit User';
        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();


        $data['states'] = get_Geo_State($user->country)->pluck('state_title','state_id')->toArray();
        $data['cities'] = get_Geo_City($user->country,$user->state)->pluck('city_title','city_id')->toArray();

       // dd(  $data['educationDropdown'] ); 

        return view('admin.user.edit', $data);
    }

   // public function getEducationDropdown(){$education = "test"};


    /** ================  ================ */
    public function editEmployer(User $id){
        
        $user = $id; 
        $data['record']   = $id;
        $data['title']  = 'Employer';
        $data['content_header'] = 'Edit Employer';
        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();


        $data['states'] = get_Geo_State($user->country)->pluck('state_title','state_id')->toArray();
        $data['cities'] = get_Geo_City($user->country,$user->state)->pluck('city_title','city_id')->toArray();

        // edit end

        return view('admin.employer.edit', $data);
    }



    

    public function update(Request $request, $id){
        $user = User::find($id);
        if (!$user){
            return redirect(route('users'))->withErrors(['token' => 'User with id '.$id.' does not exist']);
        }
        // dd($request);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'phone' => 'max:15',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'age' => 'max:15',
            'bday' => 'max:2',
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:25',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:500',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;
        $user->education = $request->education;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;
        $user->questions = $request->questions;
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;

        if( $user->save() ){
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }



    public function updateEmployer(Request $request, $id){
        //dd($request->toArray());
        $user = User::find($id);
        if (!$user){
            return redirect(route('adminEmployers'))->withErrors(['token' => 'Employers with id '.$id.' does not exist']);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'phone' => 'max:15',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'age' => 'max:15',
            'bday' => 'max:2',    
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:25',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',


        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;
        $user->education = $request->education;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;

// dd($request->toArray());

        $user->questions = json_encode($request->questions);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;

        if( $user->save() ){
            return redirect(route('adminEmployers'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }


    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'password' => 'required',
            'phone' => 'max:15',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'age' => 'max:15',
            'bday' => 'max:2',    
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:25',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;
        $user->education = $request->education;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;

        $user->questions = json_encode($request->questions);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;


        if( $user->save() ){
            $user->roles()->attach([config('app.user_role')]);
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function storeEmployer(Request $request){
        dd( $request->toArray() );
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'password' => 'required',
            'phone' => 'max:15',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'age' => 'max:15',
            'bday' => 'max:2',    
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:25',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;
        $user->education = $request->education;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;

        $user->questions = json_encode($request->questions);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;
        if( $user->save() ){
            $user->roles()->attach([config('app.user_role')]);
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }




    public function show($id){

    }











    public function destroy($id)
    {

    }
}