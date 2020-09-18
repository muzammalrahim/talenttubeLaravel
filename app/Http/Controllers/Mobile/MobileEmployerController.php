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
            $data['user'] = User::find($user->id);
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


}
