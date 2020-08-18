<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\UserGallery;
use App\Attachment;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Video;


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
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = '';
        return view('admin.user.list', $data);
    }

    public function pendingUsers() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = 'pending';
        return view('admin.user.list', $data); // admin/user/list
    }

    public function verifiedUsers() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = 'verified';
        return view('admin.user.list', $data); // admin/user/list
    }

    public function employers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = null; 
        return view('admin.employer.list', $data);
        // admin/employer/list 
    }

    public function verifiedEmployers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = 'verified';
        return view('admin.employer.list', $data);
        // admin/employer/list 
    }
    public function pendingEmployers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = 'pending';
        return view('admin.employer.list', $data);
        // admin/employer/list 
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getDatatable(Request $request){
      $records = array();

       // dd($request->toArray());
      $records = User::select(['id', 'name', 'city','email','phone','verified','created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
     if(isset($request->status) && !empty($request->status)){

        if($request->status == 'verified')
            $records = $records->where('verified','1');

        if($request->status == 'pending')
            $records = $records->where('verified','0');
     
     }

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('users.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px;"><i class="far fa-edit"></i></button></a>';
            $rhtml .= '<button id="userdel" type="button" class="btn btn-danger btn-sm" data-type="User" user-id='. $records->id.' user-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
            if(!$records->verified){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnVerifyUser m-1" user-id='. $records->id.'">Verify</button>';
            }
            return $rhtml;
        }})
       ->addColumn('profile', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
        }})
        ->addColumn('videoInfo', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserVideoInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
        }})
 
        ->addColumn('resume', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserResumeInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
        }})
      ->removeColumn('verified')
      ->rawColumns(['profile','videoInfo','resume','action'])
      ->toJson();
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getEmployerDatatable(Request $request){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'created_at','verified'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');

     if(isset($request->status) && !empty($request->status)){
        if($request->status == 'verified')
            $records = $records->where('verified','1');
        if($request->status == 'pending')
            $records = $records->where('verified','0');
     }

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('employers.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px"><i class="far fa-edit"></i></button></a>';

            $rhtml .= '<button id="empdel" type="button" class="btn btn-danger btn-sm" data-type="Employer" emp-id='. $records->id.' emp-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';

            if(!$records->verified){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnVerifyUser m-1" user-id='. $records->id.'">Verify</button>';
            }
            return $rhtml;
        }
      })
      ->addColumn('profile', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
      }})
      ->rawColumns(['profile','action'])
      ->toJson();

    }

    /** ================   ================ */
    public function create(){

    

        $data['record']   = FALSE;
        $data['title']  = 'User';
        $data['content_header'] = 'Add new User';
        $data['countries'] = get_Geo_Country();
        $data['qualificationList'] = getQualificationsList();
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
        $data['userquestion'] = getUserRegisterQuestions();
        $data['industry_experience'] = getIndustries();
        $data['salaryRange'] = getSalariesRange();   
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
        $data['empquestion'] = getEmpRegisterQuestions();
        return view('admin.employer.edit', $data);
    }

    /** ================   ================ */
    public function edit($id){
            
        $user = User::with('profileImage')->where('id',$id)->first();

        $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();
        $videos = Video::where('user_id', $user->id)->get();
        $attachments = Attachment::where('user_id', $user->id)->get();


        if(empty($user)){ return redirect(route('users.create')); } 
        if($user->type == 'employer'){ 
            return redirect(route('employers.edit', ['id' => $user->id]));
        }else if($user->type == 'user'){
            $data['record']   = $user;
            $data['title']  = 'User';

            $data['content_header'] = 'Edit User';
            $data['countries'] = get_Geo_Country();
            $data['qualificationList'] = getQualificationsList();
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
            $data['userquestion'] = getUserRegisterQuestions();
            $data['industriesList'] = getIndustries();
            $data['salaryRange'] = getSalariesRange();
            $data['questionsList'] = getIndustries();

            $data['user_gallery'] = $user_gallery;
            $data['videos'] = $videos;
            $data['attachments'] = $attachments;



            return view('admin.user.edit', $data);
        }
        // admin/user/edit
    }

    /** ================  ================ */
    public function editEmployer(User $id){
        

        $user = $id; 

        $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();

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
        $data['states'] = ($user->country)?(get_Geo_State($user->country)->pluck('state_title','state_id')->toArray()):array();
        $data['cities'] = ($user->country && $user->state)?(get_Geo_City($user->country,$user->state)->pluck('city_title','city_id')->toArray()):array();
        $data['questionsList'] = getEmpRegisterQuestions();

            $data['user_gallery'] = $user_gallery;
        

        // edit end

        return view('admin.employer.edit', $data);
    }

    public function update(Request $request, $id){

        $user = User::find($id);
        if (!$user){
            return redirect(route('users'))->withErrors(['token' => 'User with id '.$id.' does not exist']);
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
            'statusText' => 'max:125',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            // 'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:500',
            'interested_in' => 'max:250',
            'userquestion' => 'max:250',
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

        // $user->education = $request->education;

        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;

         // dd(  $request->toArray() );

        $user->questions = json_encode($request->questions); 
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;
        $user->qualification = $request->qualification;
        $user->industry_experience = $request->industry_experience;
        $user->recentJob = $request->recentJob;
        $user->salaryRange = $request->salaryRange;
        if( $user->save() ){
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function updateEmployer(Request $request, $id){

        // dd($request->toArray());
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
        $user->questions = json_encode($request->questions);
        $user->company = $request->company;
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
            'statusText' => 'max:125',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            // 'educaion' => 'max:15',
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

        // $user->education = $request->education;

        $user->qualification = $request->qualifications;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;
       
        // $user->questions = implode(',',$request->questions);

        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;
        $user->industry_experience = $request->industry_experience;
        $user->recentJob = $request->recentJob;
        $user->salaryRange = $request->salaryRange;
        $user->type = "user";
        if( $user->save() ){
            $user->roles()->attach([config('app.user_role')]);
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function storeEmployer(Request $request){
        // dd( $request->toArray() );
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
        $user->company = $request->company;
        $user->credit = $request->credit;
        $user->type = "employer";
        
        if( $user->save() ){
            $user->roles()->attach([config('app.employer_role')]);
            return redirect(route('adminEmployers'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function show($id){}

    // Destroy User
    public function destroyUser($id){
      $user = User::find($id);
      if(!empty($user)){
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Job Succesfully Deleted',
          ]);
      }
    }
    // Destroy User end here

    
    // Destroy Employer
    public function destroyemployers($id){
      $user = User::find($id);
      if(!empty($user)){
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Job Succesfully Deleted',
          ]);
      }
    }

    public function profilePopup(Request $request){
     $user = User::with(['Gallery','profileImage'])->where('id',$request->id)->first(); 
     if($user){
        // $gallery =  UserGallery::where('user_id',$request->id)->get();
        $data['user'] = $user;
        
        return view('admin.user.profilePopup', $data);
        // admin/user/profilePopup
     }
    }

 
    //===============================================================================================================//
    // return user uploaded videos for user lising page popup .
    //===============================================================================================================//
    public function profileVideoPopup(Request $request){
     $user = User::with('vidoes')->where('id',$request->id)->first(); 
     if($user){
        $data['user'] = $user;
        return view('admin.user.profileVideoPopup', $data);
        // admin/user/profileVideoPopup
     }
    }


    //===============================================================================================================//
    // return JobSeeker uploaded Resume link.
    //===============================================================================================================//
    public function resumeData(Request $request){
     $resume = Attachment::where('user_id',$request->id)->first(); 
     if(!empty($resume))
        return assetResume($resume);
    }
    
    //===============================================================================================================//
    // make all selected checkbox user account verified/enabled.
    //===============================================================================================================//
    public function confirmAccount(Request $request){
      onlyAdmin();
      if(!empty($request->cbx) && is_array($request->cbx)){
        $result =  User::whereIn('id', $request->cbx)->update(array('verified' => 1, 'email_verified_at' => date("Y-m-d H:i:s")));
        if($result > 0){
            return response()->json([
                'status' => 1,
                'message' => '<h3 class="text-center">('.$result.') JobSeekers Succesfully Approved</h3>',
          ]);
        }
      }    
    }

    // end here
}