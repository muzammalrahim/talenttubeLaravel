<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use App\UserGallery;
use App\Attachment;
use App\BlockUser;
use App\UserActivity;
use App\Video;
use App\Jobs;
use App\LikeUser;
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


class JobSeekerController extends Controller {

    public function __construct(){ $this->middleware('auth'); }



    //====================================================================================================================================//
    // Get // layout for listing of employers.
    //====================================================================================================================================//
    public function employers(Request $request){
        $user = Auth::user();
        if (isEmployer($user)){ return redirect(route('jobSeekers')); }
        $data['user']           = $user;
        $data['title']          = 'Employers';
        $data['classes_body']   = 'employers';
        $employersObj          = new User();
        $jobSeekers             = $employersObj->getEmployers($request, $user);
        $likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();

        $data['likeUsers'] = $likeUsers;
        $data['employers'] = $jobSeekers;
        return view('site.user.employers', $data);
    }



    //====================================================================================================================================//
    // Ajax POST // Block Employer on JobSeeker Employers listing page.
    //====================================================================================================================================//
    public function blockEmployer($employerId){
        $user = Auth::user();
        if (isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to block Employer',
            ]);
        }

        // check if jobSeeker with id exist
        $employer = User::Employer()->where('id',$employerId);
        if (empty($employer)){
            return response()->json([
                'status' => 0,
                'error' => 'Employer with id '.$employerId.' do not exist',
            ]);
        }

        // block Employer.
        $blockUser = new BlockUser();
        $record = $blockUser->addEntry($user, $employerId);
        return response()->json([
            'status' => 1,
            'message' => 'Employer Succefuly Blocked',
            'data' =>  $record
        ]);

    }



    //====================================================================================================================================//
    // Ajax POST // Like Employer on JobSeeker Employer listing page.
    //====================================================================================================================================//
    public function likeEmployer($employerId){
        $user = Auth::user();
        if (isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to block Employer',
                // 'redirect' => route('')
            ]);
        }

        // check if jobSeeker with id exist
        $employer = User::Employer()->where('id',$employerId);
        if (empty($employer)){
            return response()->json([
                'status' => 0,
                'error' => 'Employer with id '.$employerId.' do not exist',
            ]);
        }

        // block jos seeker.
        $LikeUser = new LikeUser();
        $record = $LikeUser->addEntry($user, $employerId);
        return response()->json([
            'status' => 1,
            'message' => 'Employer Seeker Succefuly Liked',
            'data' =>  $record
        ]);

    }




    //====================================================================================================================================//
    // Get // layout for Employer Detail.
    //====================================================================================================================================//
    public function employerInfo($employerId){
        $user = Auth::user();
        if (isEmployer($user)){ return redirect(route('jobSeekers')); }
        $data['user'] = $user;
        $employer = User::Employer()->where('id',$employerId)->first();

        // check if employer with id exist.
        if(empty($employer) || !isEmployer($employer) ){ return redirect(route('employers')); }

        // check if this employer has not block you.
        hasBlockYou($user, $employer)

        $data['title']          = 'Employer Info';
        $data['classes_body']   = 'employerInfo';
        $data['employer']       = $employer;

        return view('site.user.employerInfo', $data);
    }



}

