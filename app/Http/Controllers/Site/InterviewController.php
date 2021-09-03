<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\User;
use App\Interview;
use App\Interviews_booking;
use App\Slot;
use App\UserGallery;
use App\Attachment;
use App\BlockUser;
use App\UserActivity;
use App\Video;
use App\Jobs;
use App\fbremacc;
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
use Jenssegers\Agent\Agent;
use URL;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotiEmailForQueuing;
use App\Mail\updateSlotToUserEmail;

use App\ControlSession;
use App\UserInterview;
use App\UserInterviewAnswers;
use App\History;


class InterviewController extends Controller
{

    public $agent;
    public function __construct(){      
		$this->middleware('auth');
		$this->agent = new Agent();
    }


    public function index(){
        $user = Auth::user();
        if (isEmployer()) {
             // dd($user->id);
        $interview = Interview::where('emp_id',$user->id)->orderBy('created_at', 'DESC')->get();
        $data['interview'] = $interview;
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';

        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        // $interview = Interview::all()->toArray();

        return view('site.employer.interview.index', $data);
        // site/employer/interview/index
        }
       else{
                return redirect('profile');       // site/user/profile/profile

       }
    }

    public function new(){
        $user = Auth::user();
        $data['user'] = $user;
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.new', $data);
        // site/employer/interview/new
    }
    public function newInterviewBooking(Request $request){

        $user = Auth::user();
        $data['user'] = $user;
        $data = $request->all();
        
        // dd($data);

        $rules = array(
            "title" => "required|string|max:255",
            "instruction" => "required|string",
            "companyname"  => "required|string",
            "positionname" => "required|string",
            // "employeremail"  => 'required|email',
            // "employerpassword" => "required|string",
        );
        $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{

            //second validation | schedule slots
            if(in_array(null, $data['date'], true))
            {
                return response()->json([
                    'status' => 0,
                    'error' =>  "please, complete the schedule slot(s)"
                ]);
            }

            foreach($data['slot'] as $key =>$value){

                if(in_array(null, $value, true))
                {
                    return response()->json([
                        'status' => 0,
                        'error' =>  "please, complete the schedule slot(s)"
                    ]);
                }
            }

        // dd($data['slot']);
        // dd(' all valiation correct ');
        $slots = array();
        //array_push($slots, $data['slot']);
        $interview = new Interview;
        $interview->emp_id = $user->id;
        $interview->title = $data['title'];
        $interview->companyname = $data['companyname'];
        $interview->positionname = $data['positionname'];
        // $interview->employeremail = $data['employeremail'];
        // $interview->employerpassword = $data['employerpassword'];
        $interview->instruction = $data['instruction'];
        $interview->additionalmanagers = $data['additionalmanagers'];
        // $interview->numberofslots = $data['numberofslots'];
        $interview->uniquedigits = rand(10000,99999);
        $interview->url = generateRandomString();
        $interview->save();
       // dd($data['slot']);
        foreach ($data['slot'] as $key => $value) {
            $slot = new Slot;
            // dd($slot);
            $slot->date = $data['date'][$key];
            $slot->maximumnumberofinterviewees = $data['maximumnumber'][$key];
            $slot->starttime =$value['start'];
            $slot->endtime = $value['end'];
            $slot->numberofintervieweesbooked =0;
            $slot->is_housefull = false;
            $interview->slots()->save($slot);
        }

       // dd($interview);
        $interview->save();
        $request->session()->put('bookingid',$interview->id);
        return response()->json([
            'status' => 1,
            'route' => route('interviewconcierge.created'),
            // 'redirect' => route('')
        ]);
        }

    }
    public function updateInterviewBooking(Request $request){
        
        $data = $request->all();
        // dd( $data);
        $interURL = $data['interviewURL'];
        $rules = array(
            "title" => "required|string|max:255","instruction" => "required|string","companyname"  => "required|string","positionname" => "required|string",
        );

        $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{

            // if(in_array(null, $data['date'], true))
            // {
            //     return response()->json([
            //         'status' => 0,
            //         'error' =>  "please, complete the schedule slot(s)"
            //     ]);
            // }

            foreach($data['slot'] as $key =>$value){

                if(in_array(null, $value, true))
                {
                    return response()->json([
                        'status' => 0,
                        'error' =>  "please, complete the schedule slot(s)"
                    ]);
                }
            }

        $interview = Interview::where('id',$data['interview_id'])->first();
        $interview->title = $data['title'];
        $interview->companyname = $data['companyname'];
        $interview->positionname = $data['positionname'];
        $interview->instruction = $data['instruction'];
        $interview->additionalmanagers = $data['additionalmanagers'];
        // $interview->numberofslots = $data['numberofslots'];
        // $interview->uniquedigits = rand(10000,99999);
        // $interview->url = generateRandomString();
        $request->session()->put('bookingid',$interview->id);

        $interview->save();
       // dd($data['slot']);

        // $interview->slots()->delete();
        foreach ($data['slot'] as $key => $single_slot) {

            // dd($single_slot);

            if( isset($single_slot['id'])){
                // echo " update  ".$single_slot['id']; 
                // dd($single_slot['jsEmail']);
                $slot = Slot::where('id',$single_slot['id'])->first();
                // for sending email to jobseeker who booked interview on this slot
                $interviewID = $data['interview_id'];
                $positionNameInSlot = $data['positionnameInSlot'];
                $companyNameInSlot = $data['companyname'];
                $newStartTime = $single_slot['start'];
                $newEndTime = $single_slot['end'];
                $newdate = $single_slot['date'];
                $userEmail = isset($single_slot['jsEmail'])?($single_slot['jsEmail']):(null);

                if ($slot->starttime != $single_slot['start'] || $slot->endtime != $single_slot['end'] || $slot->date != $single_slot['date']) {
                    // dd('Something Changed');
                    if($userEmail){
                        Mail::to($single_slot['jsEmail'])->send(new updateSlotToUserEmail($interviewID,$positionNameInSlot,$companyNameInSlot,$newStartTime,$newEndTime,$newdate));
                    }
                }


                // dd('Nothing Changed');

                // dd($data['companyname']);
                $slot->date = $single_slot['date'];
                $slot->starttime = $single_slot['start'];
                $slot->endtime = $single_slot['end'];
                $slot->interview_id = $data['interview_id'];
                

                // dd($slot->starttime , $single_slot['start']);
                $slot->maximumnumberofinterviewees = $single_slot['maxNumberofInterviewees'];
                $slot->numberofintervieweesbooked =0;
                $slot->is_housefull = false;


                // "hassaansaeed1@gmail.com"

               

                // dd($single_slot['jsEmail']);
                

                $slot->save();

            }else{
                
                // dd($single_slot['maxNumberofInterviewees1']);
                // echo " create new ";
                $slot = new Slot();
                $slot->starttime = $single_slot['start1'];
                $slot->endtime = $single_slot['end1'];
                $slot->date = $single_slot['date1'];
                $slot->interview_id = $data['interview_id'];
                $slot->maximumnumberofinterviewees = $single_slot['maxNumberofInterviewees1'];

                $slot->numberofintervieweesbooked =0;
                $slot->is_housefull = false;


                $slot->save();
            }
           
        }

// dd( 'done ' );
        // foreach ($data['slot'] as $key => $newSlot) {
        //     dump($newSlot['start1']);
        // }


        // dd(' working ');

       // dd($interview);
        $interview->save();
        return response()->json([
            'status' => 1,
            'route' => route('interviewconcierge.created'),
            // 'redirect' => route('')
        ]);
        }

    }



    public function editInterviewLogin(Request $request){

        $data = $request->all();


        if(!empty($data['bookingid']) || !empty($data['password']) || !empty($data['email'])){
            if(!empty($data['bookingid'])){
                $rules = array(
                    "bookingid" => "required|string|max:5|min:5",
                    );

                $validator = Validator::make( $data , $rules);
                if ($validator->fails()){
                    return response()->json([
                        'status' => 0,
                        'validator' =>  $validator->getMessageBag()->toArray()
                    ]);
                }

               $interview = Interview::where('uniquedigits',$data['bookingid'])->first();
               if(!empty($interview)){
                $request->session()->put('bookingid',$interview->id);
                return response()->json([
                    'status' => 1,
                    'route' =>route('interviewconcierge.formedit'),
                ]);

               }
               else {
                return response()->json([
                    'status' => 0,
                    'error' =>  "Booking schedule not found"
                ]);
               }

            }

            else if(!empty($data['email']) || !empty($data['password']) ){

                $rules = array(
                    "password" => "required|string",
                    "email"  => 'required|email',
                    );

                $validator = Validator::make( $data , $rules);
                if ($validator->fails()){
                    return response()->json([
                        'status' => 0,
                        'validator' =>  $validator->getMessageBag()->toArray()
                    ]);
                }

                $interview = Interview::where([
                    'employeremail' => $data['email'],
                    'employerpassword' => $data['password']])->first();

                if(!empty($interview)){

                $request->session()->put('bookingid',$interview->id);
                return response()->json([
                    'status' => 1,
                    'route' =>route('interviewconcierge.formedit'),
                ]);
                }

                else {

                    return response()->json([
                        'status' => 0,
                        'error' =>  "Booking schedule not found"
                    ]);

                }
            }

        }

        else {


            $rules = array(
                "bookingid" => "required|string|max:5",
                "password" => "required|string",
                "email"  => 'required|email',
                );
            $validator = Validator::make( $data , $rules);
            if ($validator->fails()){
                return response()->json([
                    'status' => 0,
                    'validator' =>  $validator->getMessageBag()->toArray()
                ]);
            }

        }

    }
    public function editbookingform(){
        $user = Auth::user();

        $bookingid = session('bookingid');
        // session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.formedit', $data);
        // site/employer/interview/formedit
    }

        public function unidigitEdit(){
        $user = Auth::user();

        $bookingid = session('bookingid');
        // session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.unidigitEdit', $data);
        // site/employer/interview/unidigitEdit
    }

    //  ============================================================================== 
    // Edit interview booking
    //  ============================================================================== 

    public function editOneBooking($id){
        
        $user = Auth::user();
        $interview = Interview::where('id',$id)->first();
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        
        if ( $interview && $interview->emp_id ==  $user->id ){
            $data['user'] = $user;
            $data['interview'] = $interview;
            $data['title'] = 'My Jobs';
            $data['classes_body'] = 'myJob';
            return view('site.employer.interview.formedit', $data); // site/employer/interview/formedit
        }else{

            return Redirect::route('homepage');
            // return view('site.employer.interview.formedit', $data);
        }

        // site/employer/interview/formedit
    }

    public function edit(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.edit', $data);
        // site/employer/interview/edit
    }

    public function bookingurl(){
        // dd(URL::full());
        $user = Auth::user();
        // $interview = Interview::where('uniquedigits',"12340")->first();
        $bookingid = session('bookingid');
        // session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.url', $data);
        // site/employer/interview/url
    }


    public function manualjobseekers(){
        // dd(URL::full());
        $user = Auth::user();
        // $interview = Interview::where('uniquedigits',"12340")->first();
        $bookingid = session('bookingid');
        // session()->forget('bookingid');
        if(!empty($bookingid)){
            $interview = Interview::where('id',$bookingid)->first();
        }
        else {
            return Redirect::route('interviewconcierge');
        }
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.manualaddjobseekers', $data);
        // site/employer/interview/manualaddjobseekers
    }

    public function created(){

        $user = Auth::user();
        $bookingid = session('bookingid');
        // session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.created', $data);
        // site/employer/interview/created
    }


    public function getlikedjobseekers(){
        // dd(URL::full());
        $user = Auth::user();
        // $interview = Interview::where('uniquedigits',"12340")->first();

        $bookingid = session('bookingid');
        $interview = Interview::where('id',$bookingid)->first();



        // $bookingid = session('bookingid');
        // session()->forget('bookingid');

        // if(!empty($bookingid)){

        //     $interview = Interview::where('id',$bookingid)->first();

        // }
        // else {

        //     return Redirect::route('interviewconcierge');
        // }
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'Interview Concierge';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.likedlistjobseekers', $data);
        
        // site/employer/interview/likedlistjobseekers
    }

    public function getlikedlistjobseekersdatatable(Request $request){
        $records = array();
        $user = Auth::user();
        // dd($user->id);

         // dd($request->toArray());
        // $records = User::select(['id', 'surname', 'city','email','phone','verified','created_at'])
        $records = DB::table('users')
        ->join('like_users', 'users.id', '=', 'like_users.like')
        ->where('like_users.user_id', $user->id);


        return datatables($records)
        ->addColumn('action', function ($records) {
          if (isEmployer()){
              $rhtml = '<a href="'.route('users.edit',['id' => $records->like]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px;"><i class="far fa-edit"></i></button></a>';
              $rhtml .= '<button id="userdel" type="button" class="btn btn-danger btn-sm" data-type="User" user-id='. $records->id.' user-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
              return $rhtml;
          }})
          ->addColumn('profile', function ($records) {
              if (isEmployer()){
                  $rhtml = '<a class="button w30 textCenterButton turquoise" href="'.route('jobSeekerInfo',['id'=>$records->like]).'" target="_blank" >Info</a>';
                  return $rhtml;
              }})

        ->removeColumn('verified')
        ->rawColumns(['profile'])->setRowId('like')
        ->toJson();
      }

      public function sendnotification(Request $request){
            // dd($request->toArray());
        if(!empty($request->cbx)){
                    $users = User::whereIn('id',$request->cbx)->get();
                    if(!empty($users)){
                    foreach ($users as $user) {
                        // dd($request->employerName);
                        // $details = ['email' => $user->email];
                        // SendBulkEmailJob::dispatch($details);
                        // $when = now()->addSeconds(2);
                        Mail::to($user->email)->cc('creativedev22@gmail.com')->send(new NotiEmailForQueuing($user->surname,$request->url,$request->positionname,$request->employerName));
                    }
                    }


               return response()->json([
                'status' => 1,

            ]);

        }
        else {
            return response()->json([
                'status' => 0,

            ]);
        }
    }

    public function manualsendnotification(Request $request){
        $data = $request->toArray();
        // $details = ['email' => $user->email];
        // SendBulkEmailJob::dispatch($details);
        // $when = now()->addSeconds(2);
        Mail::to($request->email)->cc('creativedev22@gmail.com')->send(new NotiEmailForQueuing($request->name,$request->url,$request->employerName,$request->positionname));

        return response()->json([
        'status' => 1,
        'message' => 'Email Sent Successfully',
        ]);

    }


    public function userurl(Request $request){
         // dd($request->url);
        // $user = Auth::user();
        $bookingid = session('bookingid');

        $interview = Interview::where('uniquedigits',"12340")->first();
        // session()->forget('bookingid');

        // if(!empty($bookingid)){

        //     $interview = Interview::where('id',$bookingid)->first();

        // }
        // else {

        //     return Redirect::route('interviewconcierge');
        // }

        // $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.user.interview.userurl', $data);
        // site/user/interview/userurl
    }


    public function userindex(){
        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->email);
        // $bookingid = session('bookingid');
        // $interview = Interview::where('uniquedigits',$bookingid)->first();

        // $Interviews_booking = Interviews_booking::(['slot','interview'])->where('email', $user->email)->get();
        $Interviews_booking = Interviews_booking::with(['slot','interview'])->where('email',  $user->email)->get();

        // 0312456789    jobseeker1@gmail.com
        // dd($interview);            
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;

        $data['title'] = 'My Jobs';
        // $data['interview'] = $interview ;
        $data['Interviews_booking'] = $Interviews_booking ;
        $data['classes_body'] = 'Interviews';
        return view('site.user.interview.indexuser', $data);
        // site/user/interview/indexuser
    }


    



    public function userbookinglogin(Request $request){

       // return 1;


        $user = Auth::user();

        // dd($request);

        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.indexuser', $data);
    }

    // public function saveSlot(Request $request){


    //     dd($request);

    //     // $data['user'] = $user;
    //     $data['title'] = 'My Jobs';
    //     $data['classes_body'] = 'myJob';
    //     return view('site.employer.interview.indexuser', $data);
    // }


    public function unidigitEditUpdate(Request $request){
        $data = $request->all();
        // dd($data);
        // dd($interURL);
        $rules = array(
            "uniquedigits" => "required|string|unique:interviews",
        );

        $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else
        {
            $interview = Interview::where('id',$data['intervieww_id'])->first();
            
              // dd($data['uniquedigits']);
// 
            $interview->uniquedigits = $data['uniquedigits'];
            $interview->save();
            return response()->json([
                'status' => 1,
                'message' => 'Booking ID has been updated succesfully',
            ]);
        }
    }


    // ============================================= Interview Initation =============================================

    public function intetviewInvitationEmp(){
        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->id);
        if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        $UserInterview = UserInterview::where('emp_id',  $user->id)->where('hide', 'no')->orderBy('created_at' , 'desc')->get();
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['UserInterview'] = $UserInterview ;
        $data['classes_body'] = 'Interviews';
        return view('site.employer.interviewInvitation.index', $data);
        // site/employer/interviewInvitation/index
    }


    // ============================================= Interview Initation Employer =============================================

    public function interviewInvitataion(){
        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->id);
        if (isEmployer($user)) {return redirect(route('intetviewInvitationEmp'));}
        $Interviews_booking = UserInterview::where('user_id',  $user->id)->where('hide' , 'no')->orderBy('created_at' , 'desc')->get();
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['Interviews_booking'] = $Interviews_booking ;
        $data['classes_body'] = 'Interviews';
        return view('site.user.interview.interviewInvitaion', $data);
        // site/user/interview/interviewInvitaion
    }

    // ================================================== Save Response As Employer ==================================================

    public function confirmInterInvitation(Request $request){

        $user = Auth::user();
        $data = $request->all();
        // dd($data);
        // ================================================== Validation for answering the questions ==================================================
        if(in_array(null, $data['answer'], true))
        {
            return response()->json([
                'status' => 0,
                'error' =>  "Please answer all questions"
            ]);
        }
        else
        {
            $UserInterview = UserInterview::where('id' ,$data['userInterviewId'])->where('emp_id' , $user->id)->where('temp_id' ,$data['temp_id'])->first();
            if ($UserInterview) {
                if ($UserInterview->status == 'Accepted') {
                    $UserInterview->status =  'Interview Confirmed';
                    $UserInterview->save();

                    foreach ($data['answer'] as $key => $value) {
                        $answers = new UserInterviewAnswers;
                        $answers->emp_id = $user->id;
                        $answers->userInterview_id  = $data['userInterviewId'];
                        $answers->user_id  = $data['user_id'];
                        $answers->question_id = $key;
                        $answers->answer = $value;
                        $answers->save();
                    }
                    return response()->json([
                        'status' => 1,
                        'error' => 'Reponse added successfully'
                    ]);
                }

                else{
                    return response()->json([
                        'status' => 0,
                        'error' => 'You have already added response'
                    ]);
                }

            }
            else{
                dd("nothing here for u");
            }
        }    
    }


        // ================================================== Save Response As Jobseeker ==================================================

    public function confirmInterInvitationJs(Request $request){

        $user = Auth::user();
        $data = $request->all();
        // dd($data);
        // ================================================== Validation for answering the questions ==================================================
        if(in_array(null, $data['answer'], true))
        {
            return response()->json([
                'status' => 0,
                'error' =>  "Please answer all questions"
            ]);
        }
        else
        {
            $UserInterview = UserInterview::where('id' ,$data['userInterviewId'])->where('user_id' , $user->id)->first();
            if ($UserInterview) {
                // dd($UserInterview);
                if ($UserInterview->status == 'pending') {
                    $UserInterview->status =  'Interview Confirmed';
                    $UserInterview->save();

                    $history = new History;
                    $history->user_id = $UserInterview->user_id; 
                    $history->type = 'Interview Confirmed'; 
                    $history->userinterview_id = $UserInterview->id; 
                    // $history->job_id = $UserInterview->jobApp_id;
                    $history->save();

                    foreach ($data['answer'] as $key => $value) {
                        $answers = new UserInterviewAnswers;
                        $answers->emp_id = $UserInterview->emp_id;
                        $answers->userInterview_id  = $data['userInterviewId'];
                        $answers->user_id  = $user->id;
                        $answers->question_id = $key;
                        $answers->answer = $value;
                        $answers->save();
                    }
                    return response()->json([
                        'status' => 1,
                        'error' => 'Reponse added successfully'
                    ]);
                }

                else{
                    return response()->json([
                        'status' => 0,
                        'error' => 'You have already added response'
                    ]);
                }

            }
            else{
                dd("nothing here for u");
            }
        }    
    }


    // ================================================== Save Response As Jobseeker interview_video_reponse ==================================================

    public function interview_video_reponse(Request $request){
        // dd($request->toArray());
        $user = Auth::user();
        $video = $request->file('file');
        // dd($video);
        // $rules = array('video.*' => 'required|file|max:20000');
        $rules = array('file' => 'required|file|max:50000');
        // $rules = array('video.*' => 'required|file|max:2');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }
        $mime = $video->getMimeType();
        if (
            $mime == "video/x-flv"             || $mime == "video/mp4"             || $mime == "application/x-mpegURL" ||
            $mime == "video/MP2T"             || $mime == "video/3gpp"             || $mime == "video/quicktime" ||
            $mime == "video/x-msvideo"     || $mime == "video/x-ms-wmv"
        ) {



            $fileOriginalName = $video->getClientOriginalName();
            $fileName = $fileOriginalName;
            $storeStatus = Storage::disk('publicMedia')->put( 'interview_bookings/' .$user->id . '/User_interview_id('.$request->userInterviewId.')' . '/question_id('.$request->question_id.')' . '/video_response/' .  $fileName, file_get_contents($video));
            $video_response_path = $user->id . '/User_interview_id('.$request->userInterviewId.')' . '/question_id('.$request->question_id.')' . '/video_response/' .  $fileName;
            return response()->json([
                'status' => '1',
                'message'   => 'Video Uploaded Successfully',
                'path'  =>  $video_response_path
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->errors()->add('video', 'Video MimeType not allowed')
            ]);
        }
    }


    // POST Ajax request submitted from profile video area.
    //====================================================================================================================================//
    public function interview_delete_video(Request $request, $id){
        $data = $request->all();
        // dd($data);
        $user = Auth::user();
        $question_id = $request->question_id;
        
        $video_url = $user->id . '/User_interview_id('.$data['userInterviewId'].')' .'/question_id('.$data['question_id'].')';
        // dd($video_url);
        if (!empty($video_url)) {

            $exists = Storage::disk('interview_bookings')->exists( $video_url );
            // dd($exists);
            if ($exists) { Storage::disk('interview_bookings')->deleteDirectory($video_url); }
            $output = array(
                'status' => '1',
                'message' => 'video Removed.'
            );
            return response()->json($output);
        }
    }



    // ============================================= Unhide Interviews =============================================

    public function unhideInterviews(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        // if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        if (isEmployer()) {
            $UserInterview = UserInterview::where('emp_id',  $user->id)->where('hide' , 'yes')->orderBy('created_at' , 'desc')->get();
        }
        else{
            $UserInterview = UserInterview::where('user_id',  $user->id)->where('hide' , 'yes')->orderBy('created_at' , 'desc')->get();
        }
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
        $data['title'] = 'My Jobs';
        $data['UserInterview'] = $UserInterview ;
        $data['classes_body'] = 'Interviews';
        return view('site.employer.interviewInvitation.unhideInterview', $data);
            
        
        // site/employer/interviewInvitation/unhideInterview
    }

    // ============================================= Hide User-Interviews Ajax =============================================

    public function hideUserInterview(Request $request){
        $user = Auth::user();
        $data = $request->toArray();
        $data['user'] = $user;
        // if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        $UserInterview = UserInterview::where('id',  $data['interview_id'])->first();
        if ($UserInterview->emp_id == $user->id) {
            if ($data['hide'] != '0') {
                if ($data['hide'] == 'yes') {    
                    $UserInterview->hide = 'yes';
                    $UserInterview->save();
                    return response()->json([
                        'status' => 1,
                        'message' => 'Interview Status updated Successfully'
                    ]);
                }
                else{
                    $UserInterview->delete();
                    return response()->json([
                        'status' => 1,
                        'message' => 'User Interview deleted successfully'
                    ]);

                }
                
            }
            
        }
        else{
            return false;
        }

    }




    // ============================================= Hide User-Interviews Ajax =============================================

    public function hideUserInterviewJs(Request $request){
        $user = Auth::user();
        $data = $request->toArray();
        // dd($data);
        $data['user'] = $user;
        // if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        $UserInterview = UserInterview::where('id',  $data['interview_id'])->first();
        if ($UserInterview->user_id == $user->id) {
            if ($data['hide'] != '0') {
                if ($data['hide'] == 'yes') {    
                    $UserInterview->hide = 'yes';
                    $UserInterview->save();
                    return response()->json([
                        'status' => 1,
                        'message' => 'Interview Status updated Successfully'
                    ]);
                }
                else{
                    if ($UserInterview->status == 'pending') {
                        $UserInterview->delete();
                        return response()->json([
                            'status' => 1,
                            'message' => 'User Interview deleted successfully'
                        ]);

                    }
                    else{
                        return response()->json([
                            'status' => 0,
                            'message' => 'Error Occured'
                        ]);
                    }


                }
                
            }
            
        }
        else{
            return false;
        }

    }


    // ============================================= Un-Hide User-Interviews Ajax =============================================

    public function unhideUserInterview(Request $request){
        $user = Auth::user();
        $data = $request->toArray();
        // dd($data);
        $data['user'] = $user;
        // if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        $UserInterview = UserInterview::where('id',  $data['interview_id'])->first();
        // if ($UserInterview->emp_id == $user->id) {
            if ($data['unhide'] != '0') {

                // dd($UserInterview->id);
                if ($data['unhide'] == 'yes') {    
                    $UserInterview->hide = 'no';
                    $UserInterview->save();
                    return response()->json([
                        'status' => 1,
                        'message' => 'Interview Status updated Successfully'
                    ]);
                }
                else{
                    $UserInterview->delete();
                    return response()->json([
                        'status' => 1,
                        'message' => 'User Interview deleted successfully'
                    ]);

                }
                
            }
            
        // }
        // else{
        //     return false;
        // }

    }





    // ======================================================= completedInterviews =======================================================

    public function completedInterviews($id){

        // $data = $id;
        // dd($id);
        $user = Auth::user();
        if (isAdmin($user)) {
            $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
            $UserInterview = UserInterview::where('user_id',$id)->where('status' , 'Interview Confirmed')->get();
            $data['controlsession'] = $controlsession;
            $data['title'] = 'User Interviews';
            $data['UserInterview'] = $UserInterview;
            $data['classes_body'] = 'Interviews';
            $data['user'] = $user;
            $data['id'] = $id;

            return view('site.employer.interviewInvitation.completed_interviews', $data);
            // site/employer/interviewInvitation/completed_interviews
        }


    }


        // ================================================== Save Response As Jobseeker ==================================================

    public function save_jobSeeker_response_interview(Request $request){

        $user = Auth::user();
        $data = $request->all();
        // dd($data);
        // ================================================== Validation for answering the questions ==================================================
     
        if(in_array(null, $data['answer'], true))
        {
            return response()->json([
                'status' => 0,
                'error' =>  "Please answer all questions"
            ]);
        }
        else{

            // dd(' =========== hi =============== ');

            $rules = array(
            'answer*' => 'required|max:255',
            'answer.*.img' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi', );
            $validator = Validator::make( $data , $rules);
            if ($validator->fails()){
                return response()->json([
                    'message' => 'Please upload a valid video format i.e video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
                    // 'status' => 0,
                    // 'validator' =>  $validator->getMessageBag()->toArray()
                ]);
            }

            else{

                // dd(' sab thek  ');

                $UserInterview = UserInterview::where('id' ,$data['userInterviewId'])->where('user_id' , $user->id)->first();
            if ($UserInterview) {

                if ($UserInterview->status == 'pending') {
                    $UserInterview->status =  'Interview Confirmed';
                    $UserInterview->save();

                    $history = new History;
                    $history->user_id = $UserInterview->user_id; 
                    $history->type = 'Interview Confirmed'; 
                    $history->userinterview_id = $UserInterview->id; 

                    $history->save();

                    foreach ($data['answer'] as $key => $value) {

                        // dump($key);

                        if (isset($value['img'])) {

                            // dd(' img hai ');

                            $answers = new UserInterviewAnswers;
                            $video = $value['img'];
                            $fileOriginalName = $video->getClientOriginalName();
                            $fileName = $fileOriginalName;
                            $storeStatus = Storage::disk('publicMedia')->put( 'interview_bookings/' .$user->id . '/User_interview_id('.$request->userInterviewId.')' . '/question_id('.$key.')' . '/video_response/' .  $fileName, 
                                file_get_contents($video));

                            $video_response_path = $user->id . '/User_interview_id('.$data['userInterviewId'].')' .
                             '/question_id('.$key.')' . '/video_response/' .  $fileName;
   
                            // $answers->video_url = $video_response_path;
                            $answers->answer = $video_response_path;
                            $answers->emp_id = $UserInterview->emp_id;
                            $answers->userInterview_id  = $data['userInterviewId'];
                            $answers->user_id  = $user->id;
                            $answers->question_id = $key;
                            // $answers->answer = $value;
                            $answers->save();
  
                        }

                        else{

                            $answers = new UserInterviewAnswers;
                            // dump(' img tu ni hai ');
                            $answers->userInterview_id  = $data['userInterviewId'];
                            $answers->emp_id = $UserInterview->emp_id;
                            $answers->user_id  = $user->id;
                            $answers->question_id = $key;
                            $answers->answer = $value;
                            $answers->save();

                        }


                        
                    }

                    return redirect()->route('intetviewInvitation');
                    
                }

                else{
                    return response()->json([
                        'status' => 0,
                        'error' => 'You have already added response'
                    ]);
                }

            }

            }

            
        }
        // $validator = $this->validate($request, [
        //     'answer*' => 'required|max:255',
        //     'answer.*.img' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
        // ]);

        // dd($validator);

        // }    
    }








    
}
