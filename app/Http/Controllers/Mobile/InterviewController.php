<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\User;
use App\Interview;
use App\Slot;
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
use Jenssegers\Agent\Agent;
use URL;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotiEmailForQueuing;
use App\Mail\updateSlotToUserEmail;

class InterviewController extends Controller
{

    public $agent;
    public function __construct(){
		$this->middleware('auth');
		$this->agent = new Agent();
    }


    public function Mindex(){
        $user = Auth::user();
        // dd($user->id);
        $interview = Interview::where('emp_id',$user->id)->orderBy('created_at', 'DESC')->get();
        $data['interview'] = $interview;
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        // $interview = Interview::all()->toArray();

        return view('mobile.employer.interview.index', $data);
        // mobile/employer/interview/index
    }

    public function Mnew(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.new', $data);
        // mobile/employer/interview/new
    }
    public function MnewInterviewBooking(Request $request){

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
            'route' => route('Minterviewconcierge.created'),
            // 'redirect' => route('')
        ]);
        }

    }
    public function MupdateInterviewBooking(Request $request){

        $data = $request->all();
        // dd( $data );
        // $interURL = $data['interviewURL'];
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

            // dd($single_slot['jsEmail']);
            // dump($single_slot['start']);
            if( isset($single_slot['id'])){
                // echo " update  ".$single_slot['id']; 
                // $slot = new slot();
                $slot = Slot::where('id',$single_slot['id'])->first();
                // dd($slot['maximumnumberofinterviewees']);
                $slot->date = $single_slot['date'];
                $slot->maximumnumberofinterviewees = $single_slot['maxNumberofInterviewees'];
                $slot->starttime = $single_slot['start'];
                $slot->endtime = $single_slot['end'];
                $slot->interview_id = $data['interview_id'];
                $slot->numberofintervieweesbooked =0;
                $slot->is_housefull = false;
                
                $interviewID = $data['interview_id'];
                $positionNameInSlot = $data['positionnameInSlot'];
                $companyNameInSlot = $data['companyname'];

                $newStartTime = $single_slot['start'];
                $newEndTime = $single_slot['end'];
                $newdate = $single_slot['date'];
                
                $userEmail = isset($single_slot['jsEmail'])?($single_slot['jsEmail']):(null);

                // dd($single_slot['jsEmail']);
                if($userEmail){
                     Mail::to($single_slot['jsEmail'])->send(new updateSlotToUserEmail($interviewID,$positionNameInSlot,$companyNameInSlot,$newStartTime,$newEndTime,$newdate));
                }


                $slot->save();

            }else{
                
                // dd($single_slot['maxNumberofInterviewees1']);
                // echo " create new ";
                $slot = new Slot();
                $slot->date = $single_slot['date1'];
                $slot->starttime = $single_slot['start1'];
                $slot->endtime = $single_slot['end1'];
                $slot->interview_id = $data['interview_id'];
                $slot->maximumnumberofinterviewees = $single_slot['maxNumberofInterviewees1'];

                $slot->numberofintervieweesbooked =0;
                $slot->is_housefull = false;
                $slot->save();
            }
           
        }

        // foreach ($data['slot'] as $key => $newSlot) {
        //     dump($newSlot['start1']);
        // }


        // dd(' working ');

       // dd($interview);
        $interview->save();
        return response()->json([
            'status' => 1,
            'route' => route('Minterviewconcierge.created'),
            // 'redirect' => route('')
        ]);
        }

    }

    public function MeditInterviewLogin(Request $request){

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
                    'route' =>route('Minterviewconcierge.formedit'),
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
    public function Meditbookingform(){
        $user = Auth::user();

        $bookingid = session('bookingid');
        session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.formedit', $data);
        // mobile/employer/interview/formedit
    }

     public function MunidigitEdit(){
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
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.unidigitEdit', $data);
        // mobile/employer/interview/unidigitEdit
    }


    public function Medit(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.edit', $data);
        // mobile/employer/interview/edit
    }

        public function MeditOneBooking($id){
        $user = Auth::user();
        $interview = Interview::where('id',$id)->first();
        
        if ( $interview && $interview->emp_id ==  $user->id ){
            $data['user'] = $user;
            $data['interview'] = $interview;
            $data['title'] = 'My Jobs';
            $data['classes_body'] = 'myJob';
            return view('mobile.employer.interview.formedit', $data);
        }else{

            return Redirect::route('mHomepage');
            // return view('site.employer.interview.formedit', $data);
        }


    }

    public function Mbookingurl(){
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

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.url', $data);
        // mobile/employer/interview/url
    }


    public function Mmanualjobseekers(){
        // dd(URL::full());
        $user = Auth::user();
        // $interview = Interview::where('uniquedigits',"12340")->first();
        $bookingid = session('bookingid');
        session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('interviewconcierge');
        }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.manualaddjobseekers', $data);
        // mobile/employer/interview/manualaddjobseekers
    }

    public function Mcreated(){

        $user = Auth::user();
        $bookingid = session('bookingid');
        session()->forget('bookingid');

        if(!empty($bookingid)){

            $interview = Interview::where('id',$bookingid)->first();

        }
        else {

            return Redirect::route('Minterviewconcierge');
        }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.created', $data);
        // mobile/employer/interview/created
    }


    public function Mgetlikedjobseekers(){
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

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('mobile.employer.interview.likedlistjobseekers', $data);
        
        // mobile/employer/interview/likedlistjobseekers
    }

    public function Mgetlikedlistjobseekersdatatable(Request $request){
        $records = array();
        $user = Auth::user();
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
                  $rhtml = '<a class="button w30 textCenterButton turquoise" href="'.route('MjobSeekerInfo',['id'=>$records->like]).'" target="_blank" >Info</a>';
                  return $rhtml;
              }})

        ->removeColumn('verified')
        ->rawColumns(['profile'])->setRowId('like')
        ->toJson();
      }

      public function Msendnotification(Request $request){

        if(!empty($request->cbx)){
                    $users = User::whereIn('id',$request->cbx)->get();
                    if(!empty($users)){
                    foreach ($users as $user) {
                        // $details = ['email' => $user->email];
                        // SendBulkEmailJob::dispatch($details);
                        // $when = now()->addSeconds(2);
                        Mail::to($user->email)->cc('creativedev22@gmail.com')->send(new NotiEmailForQueuing($user->surname,$request->url,$request->employerName,$request->positionname));
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

    public function Mmanualsendnotification(Request $request){
        // dd($request->employerName);
        // $details = ['email' => $user->email];
        // SendBulkEmailJob::dispatch($details);
        // $when = now()->addSeconds(2);
        Mail::to($request->email)->cc('creativedev22@gmail.com')->send(new NotiEmailForQueuing($request->name,$request->url,$request->employerName,$request->positionname));
        return response()->json([
        'status' => 1,
        ]);

    }

    public function Muserurl(Request $request){
         // dd($request->url);
        $user = Auth::user();
        $bookingid = session('bookingid');

        $interview = Interview::where('uniquedigits',"12340")->first();
        // session()->forget('bookingid');

        // if(!empty($bookingid)){

        //     $interview = Interview::where('id',$bookingid)->first();

        // }
        // else {

        //     return Redirect::route('interviewconcierge');
        // }

        $data['user'] = $user;
        $data['interview'] = $interview;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        return view('site.user.interview.userurl', $data);
        // site/user/interview/userurl
    }


    public function userindex(){
        $user = Auth::user();
        $data['user'] = $user;

        $bookingid = session('bookingid');

        $interview = Interview::where('uniquedigits',"12340")->first();

        
        $data['title'] = 'My Jobs';
        $data['interview'] = $interview ;
        $data['classes_body'] = 'myJob';
        return view('site.employer.interview.indexuser', $data);
        // site/employer/interview/indexuser
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

        public function MunidigitEditUpdate(Request $request){
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
        }else{
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
}
