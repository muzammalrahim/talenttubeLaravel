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
use App\UserInterview;
use App\UserInterviewAnswers;

use App\ControlSession;
use App\History;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotiEmailForQueuing;
use App\Mail\updateSlotToUserEmail;
use App\Mail\deleteSlotToUserEmail;
use App\Mail\conductInterviewEmail;
use Illuminate\Support\Facades\Storage;


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

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
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

        foreach($data['questions'] as $key =>$value){

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
        $interviewTemplate->employers_instruction = $data['employers_instruction'];

        $interviewTemplate->save();
        // return response()->json([
        //     'message' => 'Template updated Successfully'
        // ]);

        foreach ($data['questions'] as $question) {

            if (isset($question['id'])) {
                $tempQuestion = InterviewTempQuestion::where('id' , $question['id'])->get();
                foreach ($tempQuestion as $tempQ) {
                    // dd($tempQ);
                    $tempQ->question = $question['question'];
                    if (isset($question['video_response'])) {
                    // dd($tempQ);
                        $tempQ->video_response = 1;
                    }
                    else{  
                        $tempQ->video_response = 0;
                    }
                    $tempQ->save();
                }
            }

            else{
                
                // $tempQuestion = new InterviewTempQuestion;
                // $tempQuestion->temp_id = $id;
                // $tempQuestion->question = $data['new'];
                // $tempQuestion->save();
                // dd('hi are you');
            }
        }

        if (isset($data['newquestions'])) {

            // dd()
            foreach ($data['newquestions'] as $new_quest) {
            $new_question = new InterviewTempQuestion;
            $new_question->temp_id = $id;
            $new_question->question = $new_quest['question'];

            if (isset($new_quest['video_response'])) {
                // dd('hi are you');
                
                $new_question->video_response = 1;
            }
            else{
                $new_question->video_response = 0;
            }

            $new_question->save();
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
            'questions.*.question' => 'required|max:255',
        ]);
        // dd($data['question']);
        if(in_array(null, $data['questions'], true))
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
            $temp->employers_instruction = $data['employers_instruction'];
            // dd($temp->id);
            

            // ===================================== if employers video intro exist ===================================== 

            if (isset($data['employer_video_intro'])) {
                $user = Auth::user();
                $video = $request->file('employer_video_intro');
                $fileOriginalName = $video->getClientOriginalName();
                $fileName = $fileOriginalName;
                $storeStatus = Storage::disk('publicMedia')->put('/template/employer_intro/'.$fileName, file_get_contents($video));
                $path = '/template/employer_intro/' .$fileName;
                $temp->employer_video_intro = $path;

            }

            // ===================================== if employers video intro exist end =====================================

            $temp->save();


            foreach ($data['questions'] as $key => $question) {
                $tempQuestion = new InterviewTempQuestion;
                $tempQuestion->question =  $question['question']; 
                $tempQuestion->temp_id =  $temp->id;
                if (isset($question['video_response'])) {
                    $tempQuestion->video_response = 1;
                }
                else{
                    $tempQuestion->video_response = 0;
                }
                $temp->tempQuestions()->save($tempQuestion);

            }
            if( $temp->save() ){
                return redirect(route('interviewTemplates'))->withSuccess( __('admin.record_added_successfully'));
            }
        }
    }

    // ============================================================ interviewTemplates Delete ============================================================

     public function AdminDeleteTemplate(Request $request){
        $id = $request->id;
        $interviewTemplate = InterviewTemplate::find($id);
        
        if (!empty($interviewTemplate)) {
            if ($interviewTemplate->employer_video_intro) {
                $imgPath =  $interviewTemplate->employer_video_intro;
                // dd($imgPath);
                Storage::disk('publicMedia')->delete($imgPath);
            }
        }
        
        $interQuestion = InterviewTempQuestion::where('temp_id', $id)->get();
        if (!empty($interQuestion)) {
          foreach ($interQuestion as $Question) {
            if (isAdmin()) {
                    $UserInterviewAnswers = UserInterviewAnswers::where('question_id' , $Question->id)->first();
                    if (!empty($UserInterviewAnswers)) {
                        
                        if ($Question->video_response == 1) {
                        $imgPath = '/interview_bookings/' .$UserInterviewAnswers->answer;
                        Storage::disk('publicMedia')->delete($imgPath);
                        $UserInterviewAnswers->delete();
                        }
                        else{
                            $UserInterviewAnswers->delete();
                        }


                    }
                    
                    $Question->delete();
                }
            }
        }

        // Deleting User's Interview 

        $UserInterview = UserInterview::where('temp_id',  $id)->get();
        if ($UserInterview->count() > 0) {
            foreach ($UserInterview as $interview) {
                $interview->delete();
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
        $jobApp_id = array();

        /*foreach($request->cbx as $userID){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $userIDs[] = $jobApp->user_id;
        $jobApp_id[] = $jobApp->id;

        }*/

        $jobApplications = JobsApplication::whereIn('id',$request->cbx)->get();
        // $jobApp_id[] = $jobApp->id;
        // dd($jobApp->id); 
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Interview';
        $data['content_header'] = 'Bulk Interview';
        $data['classes_body'] = 'bulkEmail';
        $data['record'] = null;
        // $cbx[] = $request->cbx;
        $data['user_ids'] = $userIDs;
        $data['jobApplications'] = $jobApplications;
        // $data['interviewTemplate'] = InterviewTemplate::get();
        $interviewTemplate = InterviewTemplate::get();
        $data['interviewTemplate'] = $interviewTemplate;
        $data['jobSeekers'] = User::whereIn('id',$userIDs)->get();
        return view('admin.job_applications.interviewTemplate.bulkInterview', $data);
        // admin/job_applications/interviewTemplate/bulkInterview

        }
    }

    // ============================================================ Bulk interview send ============================================================

    public function bulkInterviewSend(Request $request){

        $user = Auth::user();
        $data = $request->toArray();
        foreach ($data['jobApp_id'] as $key => $value) {
            $UserInterview = new UserInterview;
            $UserInterview->temp_id = $data['temp_id'];
            $UserInterview->jobApp_id = $value;
            $UserInterview->user_id = $key;
            $UserInterview->emp_id   = $user->id;
            $UserInterview->hide   = 'no';
            $UserInterview->url   = generateRandomString();
            $UserInterview->status   = 'pending'; 
            $UserInterview->interview_type   = 'Correspondance';
            $UserInterview->save();
            $history = new History;
            $history->user_id = $UserInterview->user_id; 
            $history->type = 'interview_sent'; 
            $history->userinterview_id = $UserInterview->id; 
            $history->save();
            $jsEmail = $UserInterview->js->email;
            $empName = $UserInterview->employer->name;
            Mail::to($jsEmail)->send(new conductInterviewEmail($empName, $UserInterview->url));       
        }

        return response()->json([
            'status' => 1,
            'message' => 'Correspondance Interview Sent Successfully'
        ]); 

    }




    // ======================================================= completedInterviews =======================================================

    public function corresInterviewJobApplciation($user_id,$jobApp_id){
        $user = Auth::user();
        if (isAdmin($user)) {
            $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
            $UserInterview = UserInterview::where('jobApp_id',$jobApp_id)->where('user_id', $user_id)->where('status', 'Interview Confirmed')->get();
            $data['controlsession'] = $controlsession;
            $data['title'] = 'User Interviews';
            $data['UserInterview'] = $UserInterview;
            $data['classes_body'] = 'Interviews';
            $data['user'] = $user;
            $data['jobApp_id'] = $jobApp_id;
            $data['user_id'] = $user_id;

            // dd($UserInterview);
            return view('site.employer.interviewInvitation.jobAppCorrespondanceInter', $data);
            // site/employer/interviewInvitation/jobAppCorrespondanceInter
        }
    }



    // ========================================= Interview Template =========================================

    public function adminInterviewTemplate(Request $request){
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
                    return view('admin.job_applications.interviewTemplate.template' , $data);  // admin/job_applications/interviewTemplate/template
                }
                else{
                    return view('site.employer.interviewTemplate.template' , $data); // site/employer/interviewTemplate/template

                }
            }
        }
        else{
            return false;
        }
    }



    // Employers video

    public function employer_video_intro(Request $request){

        // dd($request->all());
        $user = User::find($request->userID);
        $video = $request->file('video');
        // $rules = array('video.*' => 'required|file|max:20000');
        $rules = array('video' => 'required|file|max:50000');
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
            // $fileName = 'video-' . time() . '.' . $video->getClientOriginalExtension();
            $fileName = $fileOriginalName;
            $storeStatus = Storage::disk('interview_bookings')->put($user->id . '/employer/video_intro/' . $fileName, file_get_contents($video), 'public');
            // store video in private folder by default.
            // $storeStatus = Storage::disk('privateMedia')->put($user->id . '/videos/' . $fileName, file_get_contents($video));
            $video = new Video();
            $video->title = $fileName;
            $video->type = $mime;
            $video->user_id = $user->id;
            $video->status = 2;
            $video->file = $user->id.'/videos/'.$fileName;
            $video->save();
            // generate video thumbs.
            $video->generateThumbs();
            $html  =  '<div id="v_" class="showinline video_box mb-2">';
            $html .=  ' <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            $html .=   '<div class="modal-dialog modal-lg" role="document">';
            $html .=   '<div class="modal-content">';
            $html .= '<div class="modal-body mb-0 p-0">';
            $html .= '<div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">';
            $html .= '<video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">';
            $html .= '<source src="'.assetVideo_response($fileName).'" type="video/mp4" />';
            $html .= '</video>';
            $html .='</div>';
            $html .= ' </div>';
            $html .= ' <div class="modal-footer justify-content-center">';
            $html .= '<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>';
            $html .= ' </div>';
            $html .= ' </div>';
            $html .= ' </div>';
            $html .= ' </div>';
            $html .= ' <a> <div class="text-center">'.generateVideoThumbsm($video).' <div class="img-overlay">
            <button onclick="UProfile.deleteVideoConfirm('.$video->id.'); return false;" class="btn btn-sm btn-success">Delete</button>
          </div>
        </div></a>';
            $html .= ' </div>';




            return response()->json([
                'status' => '1',
                'data'   => $video,
                'html'  =>  $html
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->errors()->add('video', 'Video MimeType not allowed')
            ]);
        }
    }



    


}
