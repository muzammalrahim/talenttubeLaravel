<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use App\Interview;
use App\Slot;
use App\User;
use App\Interviews_booking;
use App\InterviewTemplate;
use App\InterviewTempQuestion;
use App\JobsApplication;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotiEmailForQueuing;
use App\Mail\updateSlotToUserEmail;
use App\Mail\deleteSlotToUserEmail;

// use Illuminate\Support\Facades\Hash;
use PDF;

class AdminInterviewController extends Controller
{
    public function interviewsList()
    {
    	
    	if (Auth::user() && Auth::user()->type == "admin") {
    		$user = Auth::user();
	        $data['user'] = $user;
	        $data['title'] = 'Interview Concierge';
	        $data['content_header'] = 'Interview Concierge';
	        $data['classes_body'] = 'interviews';
	        $data['interviews'] = Interview::with('slots')->get();
	        return view('admin.interviewConcierge.interviews_list', $data);  // admin/interviewConcierge/interviews_list
    	}
    }


    public function getInterviewsListDatatable(){
         $records = Interview::select([
         		'id',
         		'title',
         		'companyname',
         		'positionname',
         		'uniquedigits',
         		'url',
         		'instruction',
         		'additionalmanagers',
         		'created_at'])
        ->withCount('slots')
        ->orderBy('created_at', 'desc'); 

        // dd( $records->toArray() ); 

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('interview.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';

            // $rhtml .= '<button type="button" class="btn btn-danger btn-sm deleteIntButton" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
                    
            return $rhtml;
        }

      })
      ->toJson();
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


    // ============================================================ interviewTemplates ============================================================

    public function interviewTemplates() {
        $data['title'] = 'Interviw';
        $data['content_header'] = 'Interview Template';
        $data['filter_status'] = null;
        return view('admin.interviewTemplate.template', $data);
        // admin/interviewTemplate/template
    }


    // ========================================= Admin Notes Data Table Start =========================================

    public function interviewTemplateDataTable(Request $request){
      $records = array();
      $records = InterviewTemplate::select(['id', 'template_name', 'type', 'created_at'])
        // ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      ->editColumn('created_at', function ($request) {
        return $request->created_at->format('Y-m-d'); // human readable format
      })

      ->addColumn('action', function ($records) {
        if (isAdmin()){

            $rhtml = ' <i value = "'.$records->id.'" class="fas fa-trash text-danger pointer noteId mx-2" data-toggle="modal" data-target="#deleteNoteModal" > </i>';

             $rhtml .= '<a href =" ' .route('adminEditTemplateQuestion' , ['id' => $records->id]).'">
            <i value = "'.$records->id.'" class="fas fa-edit text-danger mx-2"> </i></a>';

            // $rhtml = '<a href =" ' .route('AdminDeleteNote' , ['id' => $records->id]).'">
            // <i value = "'.$records->id.'" class="fas fa-trash text-danger"> </i></a>';

            return $rhtml;
        }
      })
      
      // ->rawColumns(['profile','action'])
      ->toJson();

    }


    // ============================================================ interviewTemplates create ============================================================

     public function templateCreate(){
        $data['record']   = FALSE;
        $data['title']  = 'Interview Template';
        $data['content_header'] = 'Add new Template';
        $data['type'] = getInterviewTemplateType();
        return view('admin.interviewTemplate.create', $data);  
        // admin/interviewTemplate/create
    }


    // ============================================================ interviewTemplates create ============================================================

     public function templateEdit($id){
        // dd($id);
        $interviewTemplate = InterviewTemplate::where('id' , $id)->first();
        $data['record']   = $interviewTemplate;
        $data['title']  = 'Edit Template';
        $data['content_header'] = 'Edit Template';
        $data['type'] = getInterviewTemplateType();
        return view('admin.interviewTemplate.edit', $data);  
        // admin/interviewTemplate/edit
    }

    // ============================================================ interviewTemplates create ============================================================

     public function templateUpdate(Request $request,$id){
        // dd($id);
        $data = $request->all();
        // dd($data);

        foreach($data['question'] as $key =>$value){

                if(in_array(null, $value, true))
                {
                    return response()->json([
                        'status' => 0,
                        'error' =>  "please complete question"
                    ]);
                }
        }

        $interviewTemplate = InterviewTemplate::where('id' , $id)->first();
        // dd($interviewTemplate);
        $interviewTemplate->template_name = $data['template_name'];
        $interviewTemplate->type = $data['type'];
        $interviewTemplate->save();
        // return response()->json([
        //     'message' => 'Template updated Successfully'
        // ]);

        foreach ($data['question'] as $question) {

            if (isset($question['id'])) {
                $tempQuestion = InterviewTempQuestion::where('id' , $question['id'])->get();
                foreach ($tempQuestion as $tempQ) {
                    $tempQ->question = $question['text'];
                    $tempQ->save();
                }
            }

            else{
                
                $tempQuestion = new InterviewTempQuestion;
                $tempQuestion->temp_id = $id;
                $tempQuestion->question = $data['new'];
                $tempQuestion->save();
            }
        }

        if (isset($data['newquestion'])) {
            foreach ($data['newquestion'] as $newQuest) {
            $tempQuestion = new InterviewTempQuestion;
            $tempQuestion->temp_id = $id;
            $tempQuestion->question = $newQuest['new'];
            $tempQuestion->save();
            }

        }

        return redirect(route('interviewTemplates'))->withSuccess( __('admin.record_aupdated_successfully'));
 
    }


    // ============================================================ interviewTemplates Store ============================================================


    public function storeTemplate(Request $request){
        // dd( $request->toArray() );

        Auth::user();
        // dd($user->id);
        // $data['user'] = $user;
        $data = $request->all();
        // dd($data);
         $this->validate($request, [
            'template_name' => 'required|max:255',
            'question' => 'required|max:255',
        ]);
        // dd($data['question']);
        if(in_array(null, $data['question'], true))
            {
                return response()->json([
                    'status' => 0,
                    'error' =>  "please add all questions"
                ]);
            }
        else{

            $temp = new InterviewTemplate();
            $temp->template_name = $data['template_name'];
            $temp->type = $data['type'];
            $temp->save();
            foreach ($data['question'] as $question) {
                $tempQuestion = new InterviewTempQuestion;
                $tempQuestion->question =  $question; 
                $tempQuestion->temp_id =  $temp->id;
                $temp->tempQuestions()->save($tempQuestion);

            }
            // $temp->questions = json_encode($request->questions);
            if( $temp->save() ){
                return redirect(route('interviewTemplates'))->withSuccess( __('admin.record_added_successfully'));
            }
        }
    }

    // ============================================================ interviewTemplates Delete ============================================================

     public function AdminDeleteTemplate(Request $request){
        $id = $request->id;
        $interviewTemplate = InterviewTemplate::find($id);
        $interQuestion = InterviewTempQuestion::where('temp_id', $id)->get();
        if (!empty($interQuestion)) {
          foreach ($interQuestion as $Question) {
            if (isAdmin()) {
                $Question->delete();
            }
            }
        }
        // dd('hi how are you');
        if(!empty($interviewTemplate)){
            if (isAdmin()) {
                $interviewTemplate->delete();
                return response()->json([
                'status' => 1,
                'message' => 'Template Succesfully Deleted',
                ]);
            }
            
        }
    }


    // ============================================================ interviewTemplates create ============================================================

     public function templateQuestionDelete(Request $request){
        // dd($request->id);
        $question = InterviewTempQuestion::where('id' , $request->id)->where('temp_id' , $request->temp_id)->first();
        // dd($question);
        $question->delete();
        return response()->json([
            'status' => 1,
            'message'=> 'Question Deleted Successfully'
        ]); 
        // admin/interviewTemplate/edit
    }



    // ============================================================ Bulk Interview Template ============================================================

        public function bulkInterviewTemplate(Request $request){
        // dd($request->templateSelect);
        $user = Auth::user();
        if (!isEmployer($user) && (!isAdmin())){ return redirect(route('profile')); }
        if ($request->templateSelect != 0) {
            $interviewTemplate = InterviewTemplate::where('id',$request->templateSelect)->get();
            // dd($interviewTemplate->id);
            $InterviewTempQuestion = InterviewTempQuestion::where('temp_id',$request->templateSelect)->get();
            if (!empty($interviewTemplate)) {
            // dd($interviewTemplate->id);
            $data['interviewTemplate'] = $interviewTemplate;
            $data['InterviewTempQuestion'] = $InterviewTempQuestion;
                if (isAdmin()) {
                    return view('admin.job_applications.interviewTemplate.bulkTemplate' , $data); 
                    // admin/job_applications/interviewTemplate/bulkTemplate
                    

                }
                else{

                    return view('site.employer.interviewTemplate.template' , $data);
                    // site/employer/interviewTemplate/template

                }
            }
        }
        else{
            return false;
        }
        

    }


    // ============================================================ Bulk interview ============================================================


    public function bulkInterview(Request $request){

      // dd($request->cbx);
      if(!empty($request->cbx)){


        $userIDs = array();
        // dd($userIDs);

        foreach($request->cbx as $userID){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $userIDs[] = $jobApp->user_id;
        }

        // dd($userIDs);

        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Interview';
        $data['content_header'] = 'Bulk Interview';
        $data['classes_body'] = 'bulkEmail';
        $data['record'] = null;
        // $cbx[] = $request->cbx;
        $data['user_ids'] = $userIDs;
        // $data['interviewTemplate'] = InterviewTemplate::get();
        $interviewTemplate = InterviewTemplate::get();
        $data['interviewTemplate'] = $interviewTemplate;
        $data['jobSeekers'] = User::whereIn('id',$userIDs)->get();
        return view('admin.job_applications.interviewTemplate.bulkInterview', $data);

        }



    }




    public function bulkInterviewSend(Request $request){

        $data = $request->toArray();
        // dd($data);
    }


}
