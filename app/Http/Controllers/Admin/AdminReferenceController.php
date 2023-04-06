<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use App\User;
use App\crossreference;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotiEmailForQueuing;
use App\Mail\updateSlotToUserEmail;
use App\Mail\deleteSlotToUserEmail;

// use Illuminate\Support\Facades\Hash;
use PDF;

class AdminReferenceController extends Controller
{
    public function referenceList()
    {
    	
    	if (Auth::user() && Auth::user()->type == "admin") {
    		$user = Auth::user();
	        $data['user'] = $user;
	        $data['title'] = 'Cross Reference';
	        $data['content_header'] = 'Cross Reference';
	        $data['classes_body'] = 'Reference';
	        $data['interviews'] = crossreference::get();
	        return view('admin.crossReference.referenceList', $data);  // admin/crossReference/referenceList
    	}
    }

    public function completedReferenceList()
    {
        
        if (Auth::user() && Auth::user()->type == "admin") {
            $user = Auth::user();
            $data['user'] = $user;
            $data['title'] = 'Cross Reference';
            $data['content_header'] = 'Completed Reference';
            $data['classes_body'] = 'Reference';
            $data['interviews'] = crossreference::get();
            return view('admin.crossReference.completedReferenceList', $data);  // admin/crossReference/completedReferenceList
        }
    }


    public function getReferenceDatatable(){
         $records = crossreference::select([
         		'id',
                'refType',
                'refStatus',
         		'refEmail',
         		'userName',
         		'jsIP',
         		'jsBrowser',
         		'refURL',
         		'jsSysyem',
         		'created_at'])
        ->orderBy('created_at', 'desc'); 

        // dd( $records); 

      return datatables($records)

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
      })
      
      ->addColumn('action', function ($records) {
        // if (isAdmin()){
        //     $rhtml = '<a href="'.route('reference.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';

        //     // ============================================= For Deleting =============================================
        //     // $rhtml .= '<button type="button" class="btn btn-danger btn-sm deleteIntButton" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
        //     // ============================================= For Deleting =============================================

                    
        //     return $rhtml;
        // }

      })
      ->toJson();
    }

     public function getCompReferenceDatatable(){
         $records = crossreference::select([
                'id',
                'userName',
                'refType',
                'refStatus',
                'refEmail',
                'jsIP',
                'refereeIP',
                'jsBrowser',
                'refereeBrowser',
                // 'refURL',
                'jsSysyem',
                'refSystem',
                'created_at'])->where('refStatus', 'Reference Completed')
        ->orderBy('created_at', 'desc'); 

        // dd( $records); 

      return datatables($records)
      ->addColumn('action', function ($records) {
        $rhtml = ' <a  href = " '.route('view_reference',['id'=>$records->id]).'" value = "'.$records->id.'" class="btn btn-primary" target ="_blank"> 
        <i class = "fa fa-eye"></i> </a>';

              
        return $rhtml;
      })

      

      ->toJson();
    }

    // ==================================================== View Complete Reference as admin ====================================================
    
    public function view_reference(Request $request, $id){

        $reference =  crossreference::where('id' , $id)->where('refStatus', 'Reference Completed')->first();
        $data['reference'] = $reference;
        $data['title'] = 'Refenence Info';
        $data['content_header'] = 'Refenence Info';
        return view('admin.crossReference.reference_info', $data);  // admin/crossReference/reference_info
        // dd($crossreference);
    }


    public function interviewEdit(Request $request){
        // dd($request->id);
        $data['content_header'] = 'Edit Interview';
        $data['title']  = 'Interview';
        $data['record']  = Interview::where('id',$request->id)->first();
        $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();

        // dd($data['interview']);
        // $data['record'] = $records;

        return view('admin.interviewConcierge.editInterview', $data);

    }

    public function updateInterview(Request $request){
        
        $data = $request->all();
        // dd( $data['slot']);
        // $interURL = $data['interviewURL'];
        $this->validate($request,[
            "title" => "required|string|max:255",
            "instruction" => "required|string",
            "companyname"  => "required|string",
            "positionname" => "required|string",

        ]);

        // $validator = Validator::make( $data , $rules);
        // if ($validator->fails()){
        //     return response()->json([
        //         'status' => 0,
        //         'validator' =>  $validator->getMessageBag()->toArray()
        //     ]);
        // }else
        // {

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
        $request->session()->put('bookingid',$interview->id);
        $interview->save();
        foreach ($data['slot'] as $key => $single_slot) {
            if( isset($single_slot['id'])){
                // echo " update  ".$single_slot['id']; 
                // dd($single_slot['jsEmail']);
                $slot = Slot::where('id',$single_slot['id'])->first();
                // dd($data['companyname']);
                $slot->date = $single_slot['date'];
                $slot->starttime = $single_slot['start'];
                $slot->endtime = $single_slot['end'];
                $slot->interview_id = $data['interview_id'];
                $slot->maximumnumberofinterviewees = $single_slot['maxNumberofInterviewees'];
                $slot->numberofintervieweesbooked =0;
                $slot->is_housefull = false;
                $interviewID = $data['interview_id'];
                $positionNameInSlot = $data['positionnameInSlot'];
                $companyNameInSlot = $data['companyname'];
                // dd($companyNameInSlot);
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
        // $interview->save();

        if( $interview->save() ){
            return redirect(route('interviewConcierge.list'))->withSuccess( __('admin.record_updated_successfully'));
        }
          // return response()->json([
          //     'status' => 1,
          //     'route' => route('interviewconcierge.created'),
          // ]);
        // }

    }

    public function adminDeleteSlot(Request $request){ 
            // $data = $request->all();
            // dd($data);
            // dd($request->position);
            $company = $request->company;
            $email = $request->useremail;
            $position = $request->position;
            $intSlotID = (int) $request->id;
            // dd( $intSlotID);
            if(!empty($email))
            {
                Mail::to($email)->send(new deleteSlotToUserEmail($company,$position));

            }
            Interviews_booking::where('slot_id',$intSlotID)->delete();
            Slot::where('id',$intSlotID)->delete();
            return response()->json([
            'status' => 1,
            'message' => 'Interview Bookings Deleted Succesfully'
        ]);             
    }

    public function storeNewInterview(Request $request){
        // // dd($request->id);
        // $data['content_header'] = 'Edit Interview';
        // $data['title']  = 'Interview';
        // $data['record']  = Interview::where('id',$request->id)->first();
        // $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();
        // return view('admin.interviewConcierge.editInterview', $data);

    }

    public function createInterview(Request $request){
        // // dd($request->id);
        $data['content_header'] = 'Addd Interview';
        $data['title']  = 'Interview';
        $data['record']  = null;
        // $data['record']  = Interview::where('id',$request->id)->first();
        // $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();
        // return view('admin.interviewConcierge.editInterview', $data);
        return view('admin.interviewConcierge.createInterview', $data);


    }


    public function interviewDelete($id){
      $interview = Interview::find($id);
      dd($interview);
      if(!empty($interview)){
        $interview->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Interview Succesfully Deleted',
          ]);
      }
    }

}
