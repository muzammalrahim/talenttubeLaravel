<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\UserGallery;
use App\Attachment;
use App\BlockUser;
use App\UserActivity;
use App\Video;
use App\Jobs;
use App\JobsApplication;
use App\TagCategory;
use App\Tags;
use App\JobsAnswers;
use App\JobsQuestions;
use App\LikeUser;

use App\InterviewTemplate;
use App\InterviewTempQuestion;
use App\UserInterview;
use App\UserInterviewAnswers;
use App\History;


use App\Mail\conductInterviewEmail;
use App\Mail\rejectInterviewInvitationEmail;
use App\Mail\acceptInterviewInvitationEmail;


class MobileEmployerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // ============================================ Ajax For updating Interested In of Employer ============================================

    public function MupdateInterested_inEmp(Request $request){

        // dd($request->interestedIn);

        $requestData = $request->all();
        // dd($requestData);
        // $rules = array(
        //             'interested_in'    => 'required|array',
        //             'interested_in.*'  => 'required|integer'
        //         );
        // $validator = Validator::make($requestData, $rules);
        // dd( $validator->errors() );
        // if (!$validator->fails()) {
            $user = Auth::user();
            // dd($user);

            $user->interested_in = $request->interestedIn;

            // dd($request->interestedIn);

            // $user->qualificationRelation()->sync($requestData['qualification']);

            $user->save();


            $data['user'] = User::find($user->id);
            // $QualificationView =  view('site.layout.parts.jobSeekerQualificationList', $data);
            // $QualificationHtml = $QualificationView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $data
            ]);
        // }
    }

    // ======================================= Ajax For updating Interested In of Employer end here ======================================


    // ==================================================== Ajax For updating About Me ====================================================


    public function Mabout_meEmp(Request $request){

        // dd($request->interestedIn);

        $requestData = $request->all();
        // dd($requestData);
        // $rules = array(
        //             'interested_in'    => 'required|array',
        //             'interested_in.*'  => 'required|integer'
        //         );
        // $validator = Validator::make($requestData, $rules);
        // dd( $validator->errors() );
        // if (!$validator->fails()) {
            $user = Auth::user();
            // dd($user);

            $user->about_me = $request->aboutMe;
            // dd($request->interestedIn);
            // $user->qualificationRelation()->sync($requestData['qualification']);
            $user->save();
            $data['user'] = User::find($user->id);
            // $QualificationView =  view('site.layout.parts.jobSeekerQualificationList', $data);
            // $QualificationHtml = $QualificationView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $data
            ]);
        // }
    }

    // ================================================== Ajax For updating About Me end here ==================================================

    // ====================================================  Ajax For updating Questions ====================================================


    public function MupdateQuestionsEmp(Request $request){

        // dump($request->questions);
        $user = Auth::user();

        // dd($user->questions);

        $rules = array('questions' => 'string|max:100');
        // $validator = Validator::make($request->all(), $rules);
        // if (!$validator->fails()) {

            // dd($user);
            // $user->questions = $request->questions;
            $user->questions = json_encode($request->questions);
            $user->save();


            // $user->questions = json_encode($request->questions);
            // $user->save();
            $data['user'] =  $user;
            $data['empquestion'] = getEmpRegisterQuestions();
            $questionsView = view('mobile.layout.parts.employerQuestions', $data);
            $QuestionsHTML = $questionsView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $QuestionsHTML
            ]);


            // return response()->json([
            //         'status' => 1,
            //         'data' => $user->questions
            // ]);
        // }
    }

    // ================================================== Ajax For updating Questions end here ==================================================

    // ======================================== Ajax POST // Like Job Seeker on Employer's listing page ========================================

    public function MlikeJS($js){
        $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to like Employer',
                // 'redirect' => route('')
            ]);
        }

        // check if jobSeeker with id exist
        $employer = User::Employer()->where('id',$js);
        if (empty($employer)){
            return response()->json([
                'status' => 0,
                'error' => 'Job Seeker with id '.$js.' do not exist',
            ]);
        }

        // block jos seeker.
        $LikeUser = new LikeUser();
        $record = $LikeUser->addEntry($user, $js);
        return response()->json([
            'status' => 1,
            'message' => 'Job Seeker Succefully Liked',
            'data' =>  $record
        ]);
    }



    // ================================= Ajax POST // Block Employer on JobSeeker Employers listing page ================================= //

    public function MblockJS($jsId){
        $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to block Job Seeker',
            ]);
        }

        // check if jobSeeker with id exist
        $employer = User::Employer()->where('id',$jsId);
        if (empty($employer)){
            return response()->json([
                'status' => 0,
                'error' => 'Employer with id '.$jsId.' do not exist',
            ]);
        }

        // block Employer.
        $blockUser = new BlockUser();
        $record = $blockUser->addEntry($user, $jsId);
        return response()->json([
            'status' => 1,
            'message' => 'Job Seeker Succefuly Blocked',
            'data' =>  $record
        ]);

    }

    // ========================================== Ajax Post // Remove user from user Like User List ==========================================

    public function MunLikeJS(Request $request){
        // dd( $request->toArray() );
        $user = Auth::user();
        $likeUserId = (int) $request->id;
        LikeUser::where('user_id',$user->id)->where('like',$likeUserId)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'User unLiked Succesfully'
        ]);
    }


    // ========================================= Interview Template =========================================


    public function MinterviewTemplate(Request $request){
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
            return view('mobile.employer.interviewInvitation.template' , $data); 
            // mobile/employer/interviewInvitation/template
            }
        }
        else{
            return false;
        }
        

    }


    // ========================================= Conduct Interview Template =========================================


    public function MconductInterview(Request $request){
        $data =  $request->all();
        // dd($data);
        $user = Auth::user();
        $empName = $user->company;
        if (!isEmployer($user) && !isAdmin()){ return redirect(route('profile')); }
            $UserInterviewCheck = UserInterview::where('temp_id' , $data['inttTempId'])->where('user_id' , $data['user_id'])->first();
            // if(!$UserInterviewCheck){

                $UserInterview = new UserInterview;
                $UserInterview->temp_id = $data['inttTempId'];
                $UserInterview->emp_id   = $user->id;
                $UserInterview->user_id   = $data['user_id'];
                $UserInterview->status   = 'pending';
                $UserInterview->hide   = 'no';
                $UserInterview->url   = generateRandomString();
                $UserInterview->save();

                
                $history = new History;
                $history->user_id = $UserInterview->user_id; 
                $history->type = 'interview_sent'; 
                $history->userinterview_id = $UserInterview->id; 
                $history->job_id = $UserInterview->jobApp_id;
                $history->save();


                $jsEmail = $UserInterview->js->email;

                Mail::to($jsEmail)->send(new conductInterviewEmail($empName, $UserInterview->url));
                return response()->json([
                    'status' => 1,
                    'message' => 'Interview conducted and Email sent to jobseeker successfully',
                ]);
            // }
            // else{

            //         return response()->json([
            //         'status' => 0,
            //         'message' => 'You have already selected this template, please try another template'
            //     ]);
            // }
    }



    // ======================================================== Live Interview ========================================================

    public function MliveInterview(Request $request){
        $user = Auth::user();
        if (!isEmployer($user) && !isAdmin()){ return redirect(route('profile')); }
        $data = $request->all();
        // dd($data);
        // ================================================== Validation for answering the questions ==================================================
        if(in_array(null, $data['answer'], true))
        {
            return response()->json([
                'status' => 0,
                'message' =>  "Please answer all questions"
            ]);
        }
        else
        {
            $UserInterviewCheck = UserInterview::where('temp_id' , $data['temp_id'])->where('user_id' , $data['user_id'])->where('emp_id' , $user->id)->first();
            if (!$UserInterviewCheck) {
                $UserInterview = new UserInterview;
                $UserInterview->temp_id = $data['temp_id'];
                $UserInterview->emp_id   = $user->id;
                $UserInterview->user_id   = $data['user_id'];
                $UserInterview->status   = 'Interview Confirmed';
                $UserInterview->hide   = 'no';
                $UserInterview->url   = generateRandomString();
                $UserInterview->save();

                foreach ($data['answer'] as $key => $value) {

                    $answers = new UserInterviewAnswers;
                    $answers->emp_id = $user->id;
                    $answers->userInterview_id  = $UserInterview->id;
                    $answers->user_id  = $data['user_id'];
                    $answers->question_id = $key;
                    $answers->answer = $value;
                    $answers->save();
                }

                return response()->json([
                    'status' => 1,
                    'message' => 'Reponse added successfully'
                ]);                
            }

            else{

                    return response()->json([
                    'status' => 0,
                    'message' => 'You have already selected this template, please try another template'
                ]);
            }

        }

    }

    // ============================================= Interview Initation =============================================

    public function MintetviewInvitationEmp(){
        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->id);
        if (!isEmployer($user)) { return redirect(route('intetviewInvitation')); }
        $UserInterview = UserInterview::where('emp_id',  $user->id)->orderBy('created_at' , 'desc')->get();
        // $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        // $data['controlsession'] = $controlsession;
        $data['title'] = 'Interview Invitation';
        $data['UserInterview'] = $UserInterview ;
        $data['classes_body'] = 'Interviews';
        return view('mobile.employer.interviewInvitation.index', $data);
        // mobile/employer/interviewInvitation/index
    }


    // ============================================= Interview Link to jobseeker =============================================


     public function MinterviewInvitationUrl(Request $request){
        $data =  $request->all();
        // dd($data['url']);
        $user = Auth::user();

        $UserInterview = UserInterview::where('url', $data['url'])->first();
        if (!isset($UserInterview)) { return redirect(route('intetviewInvitation'));}
        $InterviewTempQuestion = InterviewTempQuestion::where('temp_id' , $UserInterview->temp_id)->get();
        ($UserInterview->user_id);

        $data['user'] = $user;
        $data['UserInterview'] = $UserInterview;
        $data['InterviewTempQuestion'] = $InterviewTempQuestion;
        $data['classes_body'] = 'jobEdit';

        // dd($empName);
        if (isEmployer()) {

            if ($UserInterview->emp_id == $user->id) {

                return view('mobile.employer.interviewInvitation.detail', $data);   //mobile/employer/interviewInvitation/detail
                // dd('interview does not belong to you check');
            }

            else{
                dd('interview does not belong to you');
            }

        }
        else{
            if ($UserInterview->user_id == $user->id) {
                return view('mobile.user.interviewInvitation.detail', $data);   // mobile/user/interviewInvitation/detail

            }
            else{

                dd('Interview does not belong to you');

            }
        }

    }


    // ============================================= Interview Initation Employer =============================================

    public function MintetviewInvitation(){
        $user = Auth::user();
        $data['user'] = $user;
        if (isEmployer($user)) {return redirect(route('MintetviewInvitationEmp'));}
        $Interviews_booking = UserInterview::where('user_id',  $user->id)->orderBy('created_at' , 'desc')->get();
        $data['title'] = 'Interview Invitation';
        $data['Interviews_booking'] = $Interviews_booking ;
        $data['classes_body'] = 'Interviews';
        return view('mobile.user.interviewInvitation.index', $data);
        // mobile/user/interviewInvitation/index
    }



    // ============================================= Accept Interview =============================================

     public function MacceptInterviewInvitation(Request $request){
        $user = Auth::user();
        $data =  $request->all();
        $UserInterview = UserInterview::where('url', $data['url'])->where('user_id',$user->id)->first();
        if ($UserInterview) {
           if ($UserInterview->user_id != $user->id) {
            return redirect()->route('mProfile');
        }
        else{
            $UserInterview->status = 'Accepted';
            $empEmail = $UserInterview->employer->email;
            $UserInterview->save();
            Mail::to($empEmail)->send(new acceptInterviewInvitationEmail($user->name, $UserInterview->employer->company,$UserInterview->url));
            return response()->json([
                'status' => 1,
                'message' => 'Interview Rejected Successfully'
            ]);
        } 
        }
        else{
            return false;
        }
        

    }



    // ============================================= Reject Interview =============================================

    public function MrejectInterviewInvitation(Request $request){
        $user = Auth::user();
        $data =  $request->all();
        $UserInterview = UserInterview::where('url', $data['url'])->where('user_id' , $user->id)->first();
        if ($UserInterview->user_id != $user->id) {
            return redirect()->route('profile');
        }
        else{
            $UserInterview->status = 'Rejected';
            $empEmail = $UserInterview->employer->email;
            $UserInterview->save();
            Mail::to('hassaansaeed1@gmail.com')->send(new rejectInterviewInvitationEmail($user->name, $UserInterview->employer->company));
            return response()->json([
                'status' => 1,
                'message' => 'Interview Rejected Successfully'
            ]);
        }   
    }

    // ============================================= Save Interview's Response as empoloyer =============================================


    public function MconfirmInterInvitation(Request $request){

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




    // ============================================= Hide User-Interviews Ajax =============================================

    public function MhideUserInterviewJs(Request $request){
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






}
