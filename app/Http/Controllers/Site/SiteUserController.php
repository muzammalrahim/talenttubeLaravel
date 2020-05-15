<?php

namespace App\Http\Controllers\Site;

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
use App\UserActivity;
use App\Video;
use App\Jobs;
use App\JobsApplication;

class SiteUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user = Auth::user();


        if ($request->username ===  $user->username) {


            $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();
            $profile_image   = UserGallery::where('user_id', $user->id)->where('status', 1)->where('profile', 1)->first();
            if (!$profile_image) {
                if ($user_gallery->count() > 0) {
                    $profile_image   = asset('images/user/' . $user->id . '/' . $user_gallery->first()->image);
                } else {
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                }
            } else {
                $profile_image   = asset('images/user/' . $user->id . '/gallery/' . $profile_image->image);
            }


            $attachments = Attachment::where('user_id', $user->id)->get();
            $activities = UserActivity::where('user_id', $user->id)->get();
            $videos = Video::where('user_id', $user->id)->get();


            $data['user'] =  $user;
            $data['user_gallery'] = $user_gallery;
            $data['geo_country'] = get_Geo_Country();
            $data['profile_image']    = $profile_image;
            $data['title'] = 'profile';
            $data['classes_body'] = 'profile';
            $data['content'] = 'this is page content';
            $data['attachments'] = $attachments;
            $data['activities'] = $activities;
            $data['videos'] = $videos;


            $view_name = 'site.user.profile.profile';
            return view($view_name, $data);
        } else {
            return view('site.404');
        }
    }


    //====================================================================================================================================//
    // save post user profile data. posted from profile setting page
    //====================================================================================================================================//
    public function updateUserProfile(Request $request)
    {
        // dump( $request->toArray() );

        $rules = array(
            'nickname' => 'required',
            'biirth_day' => 'day|integer',
            'birth_month' => 'month|integer',
            'birth_year' => 'year|integer',
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {
            // check country state city correction.
            $geo_country = \App\GeoCountry::where('country_id', $request->country)->first();
            if (!$geo_country) {
                return response()->json([
                    'status' => 0,
                    'validator' =>  $validator->errors()->add('country', 'Wrong Country id')
                ]);
            }
            $geo_validate_state = $geo_country->validateState($request->state);
            if (!$geo_validate_state) {
                $validator->errors()->add('state', 'Wrong State selected');
                return response()->json([
                    'status' => 0,
                    'validator' => $validator->getMessageBag()->toArray()
                ]);
            }
            $geo_validate_city  = $geo_country->validateCity($request->state, $request->city);
            if (!$geo_validate_city) {
                $validator->errors()->add('city', 'Wrong City selected');
                return response()->json([
                    'status' => 0,
                    'validator' => $validator->getMessageBag()->toArray()
                ]);
            }

            $user = Auth::user();
            $user->name = $request->nickname;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city =  $request->city;
            $user->bday = $request->day;
            $user->bmonth = $request->month;
            $user->byear = $request->year;

            try {
                $user->save();
                return response()->json([
                    'status' => 1,
                    'validator' => 'record Succesfully saved'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 0,
                    'error' => $e->errorInfo[2]
                ]);
            }
        }
    }


    //====================================================================================================================================//
    // chagne the text of user status,.
    // triggered from User profile page.
    //====================================================================================================================================//
    public function changeUserStatusText(Request $request)
    {
        $rules = array('status' => 'string');
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->statusText = $request->status;
            $user->save();
        }
    }


    //====================================================================================================================================//
    // chagne the about me text on user profile.
    // triggered from User profile page.
    //====================================================================================================================================//
    public function updateAboutField(Request $request)
    {

        if ($request->name == 'about_me') {
            $rules = array('about_me' => 'string');
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $user = Auth::user();
                $user->about_me = Str::limit(preg_replace("/[^A-Za-z0-9 ]/", '', $request->about_me), 500);
                $user->save();
                return response()->json([
                    'status' => 1,
                    'data' => $user->about_me
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->getMessageBag()->toArray()
                ]);
            }
        } else if ($request->name == 'interested_in') {
            $rules = array('interested_in' => 'string');
            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $user = Auth::user();
                $user->interested_in =  Str::limit(preg_replace("/[^A-Za-z0-9 ]/", '',  $request->interested_in), 500);
                $user->save();
                return response()->json([
                    'status' => 1,
                    'data' => $user->interested_in
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->getMessageBag()->toArray()
                ]);
            }
        }
    }

    //====================================================================================================================================//
    // Return User Personal Setting html.
    // Ajax request from profile page.
    //====================================================================================================================================//
    public function getUserPersonalInfo()
    {
        // $user = Auth::user();
        $data = array();
        $data['user'] = Auth::user();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['educationDropdown'] = getEducationDropdown();
        $view = view('site.user.profile.profilePersonalInfoForm', $data);
        $view = $view->render();
        return $view;
    }

    //====================================================================================================================================//
    // Save User Personal Setting.
    // Ajax submit request from profile page.
    //====================================================================================================================================//
    public function saveUserPersonalSetting(Request $request)
    {
        $rules = array(
            'gender' => 'required|in:male,female',
            'eye' => 'alpha_dash|max:100',
            'family' => 'integer|gt:0',
            'education' => 'alpha_dash|max:255',
            'language'    => 'required|array',
            'language.*'  => 'required|integer|distinct',
            'hobbies'    => 'required|array',
            'hobbies.*'  => 'required|integer|distinct',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {

            $user = Auth::user();
            $user->gender = $request->gender;
            $user->eye = $request->eye;
            $user->family = $request->family;
            $user->education =  $request->education;
            $user->language = $request->language;
            $user->hobbies = $request->hobbies;

            try {
                $user->save();
                return response()->json([
                    'status' => 1,
                    'validator' => 'record Succesfully saved',
                    'data' =>  $user
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 0,
                    'error' => $e->errorInfo[2]
                ]);
            }
        }
    }


    //====================================================================================================================================//
    // Upload User Gallery photo.
    // Ajax submit request from profile Album page.
    //====================================================================================================================================//
    public function uploadUserGallery(Request $request)
    {

        // dd( $request->toArray() );
        $user = Auth::user();
        $image = $request->file('file');

        $fileName   = time() . '.' . $image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        Storage::disk('user')->put($user->id . '/gallery/small/' . $fileName, $img, 'public');

        $img = Image::make($image->getRealPath());
        $img->stream();
        Storage::disk('user')->put($user->id . '/gallery/' . $fileName, $img, 'public');

        $userGallery = new UserGallery();
        $userGallery->user_id = $user->id;
        $userGallery->image = $fileName;
        $userGallery->status = 1;
        $userGallery->save();

        $output = array(
            'status' => '1',
            'success' => 'Image uploaded successfully',
            'image'  =>  asset('images/user/' . $user->id . '/gallery/small/' . $fileName) // Storage::disk('user')->url( $user->id. '/gallery/smalls/'.$fileName)
        );
        return response()->json($output);
    }

    //====================================================================================================================================//
    // Delete User Gallery photo.
    // Ajax submit request from profile Album page.
    //====================================================================================================================================//
    public function deleteGallery($gallery_id)
    {

        if (empty($gallery_id)) {
            return false;
        }
        $user = Auth::user();
        $gallery_image = UserGallery::find($gallery_id);
        // dd( $gallery_image );
        if ($gallery_image) {
            if ($gallery_image->user_id !== $user->id) {
                $output = array(
                    'status' => '0',
                    'message' => 'Your are not allwoed to this image'
                );
                return response()->json($output);
            } else {
                Storage::disk('user')->delete($user->id . '/gallery/' . $gallery_image->image);
                Storage::disk('user')->delete($user->id . '/gallery/small/' . $gallery_image->image);
                $gallery_image->delete();
                $output = array(
                    'status' => '1',
                    'message' => 'Image succesfully removed'
                );
                return response()->json($output);
            }
        }
    }


    //====================================================================================================================================//
    // Set the access of gallery image to private.
    // Ajax submit request from profile Album page.
    //====================================================================================================================================//
    public function setGalleryPrivateAccess($gallery_id)
    {
        if (empty($gallery_id)) {
            return false;
        }
        $user = Auth::user();
        $gallery_image = UserGallery::find($gallery_id);
        if ($gallery_image) {
            if ($gallery_image->user_id !== $user->id) {
                $output = array(
                    'status' => '0',
                    'message' => 'Your are not allwoed to this image'
                );
                return response()->json($output);
            } else {
                $gallery_image->access = 2;
                $gallery_image->save();
                $output = array(
                    'status' => '1',
                    'message' => 'Image succesfully updated'
                );
                return response()->json($output);
            }
        }
    }




    //====================================================================================================================================//
    // Set iamge as profile image.
    // POST Ajax request submitted from profile gallery area.
    //====================================================================================================================================//
    public function setImageAsProfile($gallery_id)
    {
        //  dd($request->toArray());
        $user = Auth::user();
        $gallery_image = UserGallery::find($gallery_id);
        if ($gallery_image) {
            if ($gallery_image->user_id !== $user->id) {
                $output = array(
                    'status' => '0',
                    'message' => 'Your are not allwoed to this image'
                );
                return response()->json($output);
            } else {
                UserGallery::where('user_id', $user->id)->update(['profile' => 0]);
                $gallery_image->profile = 1;
                $gallery_image->save();
                $output = array(
                    'status' => '1',
                    'message' => 'Image succesfully updated',
                    'data'  =>  array(
                        'small' => asset('images/user/' . $user->id . '/gallery/small/' . $gallery_image->image),
                        'large' => asset('images/user/' . $user->id . '/gallery/' . $gallery_image->image)
                    )
                );
                return response()->json($output);
            }
        }
    }




    //====================================================================================================================================//
    // Upload user selected resume.
    // POST Ajax request submitted from profile private area.
    //====================================================================================================================================//
    public function userUploadResume(Request $request)
    {

        $rules = array('resume.*' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:204800');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {
            $user = Auth::user();
            $resume = $request->file('resume');
            $fileName = 'resume-' . time() . '.' . $resume->getClientOriginalExtension();
            $storeStatus = Storage::disk('user')->put($user->id . '/private/' . $fileName, file_get_contents($resume), 'public');
            if ($storeStatus) {

                $attachment = new Attachment();
                $attachment->user_id =   $user->id;
                $attachment->status = 1;
                $attachment->name = $fileName;
                $attachment->type = $resume->getClientOriginalExtension();
                $attachment->file = $user->id . '/private/' . $fileName;
                $attachment->save();

                $userAttachments = Attachment::where('user_id', $user->id)->get();

                $output = array(
                    'status' => '1',
                    'message' => 'Resume succesfully uploaded',
                    'file' => asset('images/user/' . $user->id . '/private/' . $fileName),
                    'attachments' => $userAttachments,

                );
                return response()->json($output);
            } else {
                $output = array(
                    'status' => '0',
                    'message' => 'Error Uploading File.'
                );
                return response()->json($output);
            }
        }
    }



    //====================================================================================================================================//
    // Upload user selected resume.
    // POST Ajax request submitted from profile private area.
    //====================================================================================================================================//
    public function removeAttachment(Request $request)
    {
        //  dd($request->toArray());
        $user = Auth::user();
        $attachment_id = $request->attachment_id;

        if (!empty($attachment_id)) {
            $attachment = Attachment::find($attachment_id);
            if ($attachment->user_id === $user->id) {
                $exists = Storage::disk('user')->exists($attachment->file);
                if ($exists) {
                    Storage::disk('user')->delete($attachment->file);
                }
                $attachment->delete();
                $output = array(
                    'status' => '1',
                    'message' => 'Attachment Removed.'
                );
                return response()->json($output);
            }
        }
    }


    //====================================================================================================================================//
    // Add new user activity.
    // POST Ajax request submitted from profile area.
    //====================================================================================================================================//
    public function saveNewActivity(Request $request)
    {
        $user = Auth::user();
        $rules = array(
            'title' => 'required|string',
            'month' => 'required|between:1,12',
            'year' => 'required|digits:4|integer|min:1947|max:' . (date('Y') + 1),
            'act_description' => 'string',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {
            $month = str_pad($request->month, 2, "0", STR_PAD_LEFT);
            $description = Str::limit(preg_replace("/[^A-Za-z0-9 ]/", '', $request->act_description), 500);
            $activity = new UserActivity();
            $activity->type = 'academic';
            $activity->user_id = $user->id;
            $activity->title = $request->title;
            $activity->date = $request->year . '-' . $month . '-01 00:00:00';  // 2020-05-08 00:00:00
            $activity->description = $description;
            $activity->save();
            $output = array(
                'status' => '1',
                'message' => 'Activity Saved.',
                'data' => $activity
            );
            return response()->json($output);
        }
    }




    //====================================================================================================================================//
    // Add new user activity.
    // POST Ajax request submitted from profile area.
    //====================================================================================================================================//
    public function uploadVideo(Request $request)
    {

        $user = Auth::user();
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

            $fileName = 'video-' . time() . '.' . $video->getClientOriginalExtension();
            $storeStatus = Storage::disk('user')->put($user->id . '/private/videos/' . $fileName, file_get_contents($video), 'public');

            $video = new Video();
            $video->title = $fileName;
            $video->type = $mime;
            $video->user_id = $user->id;
            $video->status = 1;
            $video->file =  $user->id . '/private/videos/' . $fileName;
            $video->save();

            return response()->json([
                'status' => '1',
                'data'   => $video
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->errors()->add('video', 'Video MimeType not allowed')
            ]);
        }
    }






    //====================================================================================================================================//
    // Delete user video.
    // POST Ajax request submitted from profile video area.
    //====================================================================================================================================//
    public function deleteVideo(Request $request)
    {

        $user = Auth::user();
        $video_id = $request->video_id;

        if (!empty($video_id)) {
            $video = Video::find($video_id);
            if ($video->user_id === $user->id) {
                $exists = Storage::disk('user')->exists($video->file);
                if ($exists) {
                    Storage::disk('user')->delete($video->file);
                }
                $video->delete();
                $output = array(
                    'status' => '1',
                    'message' => 'video Removed.'
                );
                return response()->json($output);
            }
        }
    }





    //====================================================================================================================================//
    // GET // Job Search/Listing layout.
    //====================================================================================================================================//
    public function jobs(){

        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Jobs';
        $data['classes_body'] = 'jobs';
        $data['jobs'] = Jobs::get();
        return view('site.jobs.jobs', $data);

    }


    //====================================================================================================================================//
    // GET // Job Apply information layout.
    //====================================================================================================================================//
    public function jobApplyInfo($job_id){
        $user = Auth::user();
        $data['user'] = $user;
        // $data['title'] = 'Jobs';
        // $data['classes_body'] = 'jobs';
        $data['job'] = Jobs::find($job_id);
        return view('site.jobs.applyInfo', $data);
    }


    //====================================================================================================================================//
    // Ajax POST // Job Apply Submitted.
    //====================================================================================================================================//
    public function jobApplySubmit(Request $request){
        $user = Auth::user();
        // dd($request->toArray());
        $requestData = $request->all();

        $requestData['applyProposal'] = my_sanitize_string( $requestData['applyProposal'] );
        foreach ($requestData['applyAnswer'] as $rk => $rv) { $requestData['applyAnswer'][$rk] = my_sanitize_string($rv); }

        $job = Jobs::find($requestData['job_id']);
        // check to confirm job with id exist
        if ($job == null){
            return response()->json([
                'status' => 0,
                'error' => 'Job with id '.$requestData['job_id'].' does not exist'
            ]);
        }else{
            // check if user has not submitted application already.
            $jobApplication = JobsApplication::where('user_id',$user->id)->where('job_id',$requestData['job_id'])->first();
            if (!empty($jobApplication)) {
                return response()->json([
                    'status' => 0,
                    'error' => 'You already submit application for this job'
                ]);
            }

            $newJobApplication = new JobsApplication();
            $newJobApplication->user_id = $user->id;
            $newJobApplication->job_id = $job->id;
            $newJobApplication->status = 'pending';
            $newJobApplication->questions = ($job->questions)?(json_encode($job->questions)):'';
            $newJobApplication->answers  = json_encode( $requestData['applyAnswer'] );
            $newJobApplication->save();

            if ($newJobApplication) {
                return response()->json([
                    'status' => 1,
                    'message' => 'You Job Application has been submitted succesfully'
                ]);
            }
        }

    }



    //====================================================================================================================================//
    // GET // Display user submit Job Application.
    //====================================================================================================================================//
    public function jobApplications(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My job applications';
        $data['classes_body'] = 'jobApplications';
        $data['applications'] = JobsApplication::with('job')->where('user_id',$user->id)->get();
        return view('site.jobs.applied', $data);
    }


    //====================================================================================================================================//
    // POST // delete job application.
    //====================================================================================================================================//
    public function deleteJobApplication($jobAppId){
        $user = Auth::user();
        $jobApplication = JobsApplication::find($jobAppId);
        if($jobApplication == null){
            return response()->json([
                'status' => 0,
                'error' => 'JobApplication with id '.$jobAppId.' does not exist'
            ]);
        }

        if( $jobApplication->user_id != $user->id ){
            return response()->json([
                'status' => 0,
                'error' => 'You can not removed this job application'
            ]);
        }

        $jobApplication->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Job application succesfully deleted'
        ]);

    }


    //====================================================================================================================================//
    // POST // delete job.
    //====================================================================================================================================//
    public function deleteJob($jobId){
        $user = Auth::user();
        $job = Jobs::find($jobId);
        if($job == null){
            return response()->json([
                'status' => 0,
                'error' => 'Job with id '.$job.' does not exist'
            ]);
        }

        if( $job->user_id != $user->id ){
            return response()->json([
                'status' => 0,
                'error' => 'You can not allowed to removed this job'
            ]);
        }

        $job->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Job succesfully deleted'
        ]);

    }





}
