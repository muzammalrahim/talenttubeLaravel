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


class MobileHomeController extends Controller {

	public $agent;

	public function __construct()
	{
		$this->agent = new Agent();
	}

    public function create() { }
    public function store(Request $request){ }
    public function show(Home $home){ }
    public function edit(Home $home){ }
    public function update(Request $request, Home $home){ }



    public function MinterviewConLogin(Request $request){

        // dd($request->toArray() );
           
        // session()->forget('int_conc_email');
        // session()->forget('int_conc_mobile');

    $data = $request->all();
        $rules = array(
            "mobile"    => "required|string|max:10|min:10",
            'email'     => "bail|required|email",
        );

        $validator = Validator::make( $request->all() , $rules);
        // dd( $validator->fails() );

        if ($validator->fails()){
            // dd($validator->getMessageBag()->toArray());
            return array(
                'status'    => 0,
                'message'   => $validator->getMessageBag()->toArray()
            );
        }else{
            
            $Interviews_booking = Interviews_booking::where('email', $request->email)->where('mobile', $request->mobile)->first();
            // dd($Interviews_booking );

            if (!empty($Interviews_booking)) { 
                $request->session()->put('int_conc_email', $request->email );
                $request->session()->put('int_conc_mobile', $request->mobile ); 
                return array(
                    'status'    => 1,
                    'redirect'   => route('MinterviewCon')
                );
            }
        }
    }

    public function MinterviewConLayout(Request $request){
        $int_conc_email = $request->session()->pull('int_conc_email');
        $int_conc_mobile = $request->session()->pull('int_conc_mobile');
        if( empty($int_conc_email) || empty($int_conc_mobile)){
            return redirect(route('homepage'));
        }else
        {
           $Interviews_booking = Interviews_booking::with(['slot','interview'])->where('email', $int_conc_email)->where('mobile', $int_conc_mobile)->get();
                if($Interviews_booking == ""){
                return redirect(route('noBookingMade'));
            }else{
                    $data['Interviews_booking'] = $Interviews_booking;
                    return view('mobile.intConUsers.intConLayout')->with('data', $data);
                    // mobile/intConUsers/intConLayout 
   
            }
            
        }
           
    }   

    public function MnoBookingMade(Request $request){

        if ($request->session()->exists('int_conc_email'))
        {
            return view('mobile.intConUsers.MnoBooking');
        }else{
            return redirect(route('homepage'));


        }
    }

    public function MdeleteBooking(Request $request){

        $intBookId = (int) $request->id;
        // dd( $intBookId);
        Interviews_booking::where('id',$intBookId)->delete();
        return response()->json([
        'status' => 1,
        'message' => 'Booking Deleted Succesfully'
    ]);

             
    }

    public function MsendEmailEmployer(Request $request){

        $intBookId = $request->bookingID;
        $interviewID = $request->interviewID;
        // dd( $intBookId);
        
        // $slots = Slot::where('interview_id',$intBookId)->get();
        $Interviews_booking = Interviews_booking::where('id', $intBookId)->first(); 

        // dd( $request->session()  );
        

        // dump( $Interviews_booking->isMybooking($request->session()->pull('int_conc_email'), $request->session()->pull('int_conc_mobile')) ); 
        // dd( $Interviews_booking->toArray() ); 
        // validation 
        // if this booking is again this user then only allowed him 

        $slots = Slot::where('interview_id',$interviewID)->get();
        $data['slots'] = $slots;
        $data['classes_body'] = 'interview';
        return view('mobile.home.preferred' , $data); // mobile/home/preferred
    }


    public function MrescheduleSlot(Request $request){

        $data = $request->all();
        // dd($data);
        $interviewBooking = Interviews_booking::where('id',$data['booking_id'])->first();
        // dd($interviewBooking); 
        
        $interviewBooking->slot_id = $data['slot_id'];
        $interviewBooking->save();
        return response()->json([
            'status' => 1,
            'data' => 'Slot Updated Successsfully'
            ]);
        }

}
