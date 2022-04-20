<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\UserGallery;
use App\Attachment;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Video;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notes;

use App\UserIndustries;
use App\UserInterview;
use App\UserInterviewAnswers;
use App\UserOnlineTest;
use App\UserOnlineTestAnswers;
use App\UserPool;
use App\UserQualification;
use App\UserTags;
use App\Interviews_booking;
use Carbon\Carbon;



class UserController extends Controller
{

    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = '';
        return view('admin.user.list', $data);
    }


    public function pendingUsers() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = 'pending';
        return view('admin.user.list', $data); // admin/user/list
    }

    public function verifiedUsers() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Job Seekers';
        $data['filter_status'] = 'verified';
        return view('admin.user.list', $data); // admin/user/list
    }

    public function employers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = null;
        return view('admin.employer.list', $data);
        // admin/employer/list
    }

    public function verifiedEmployers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = 'verified';
        return view('admin.employer.list', $data);
        // admin/employer/list
    }
    public function pendingEmployers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        $data['filter_status'] = 'pending';
        return view('admin.employer.list', $data);
        // admin/employer/list
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getDatatable(Request $request){
      $records = array();

       // dd($request->toArray());
      $records = User::select(['id', 'name', 'surname', 'city','email','phone','verified','created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
     if(isset($request->status) && !empty($request->status)){

        if($request->status == 'verified')
            $records = $records->where('verified','1');

        if($request->status == 'pending')
            $records = $records->where('verified','0');

     }



      return datatables($records)

      ->editColumn('created_at', function ($records) {

        return humanReadableDateTime($records->created_at); // human readable format
      })

      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('users.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px;"><i class="far fa-edit"></i></button></a>';
            $rhtml .= '<button id="userdel" type="button" class="btn btn-danger btn-sm" data-type="User" user-id='. $records->id.' user-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
            if(!$records->verified){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnVerifyUser m-1" user-id='. $records->id.'">Verify</button>';
            }
            return $rhtml;
        }})
        ->addColumn('profile', function ($records) {
            if (isAdmin()){
                $rhtml = '<a class="btn btn-primary btn-sm" href="'.route('jobSeekerInfo',['id'=>$records->id]).'" target="_blank" >Info</a>';
                return $rhtml;
            }})
        ->addColumn('videoInfo', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserVideoInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
        }})

        ->addColumn('resume', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserResumeInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
        }})
      ->removeColumn('verified')
      ->rawColumns(['profile','videoInfo','resume','action'])
      ->toJson();
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getEmployerDatatable(Request $request){
      $records = array();
      $records = User::select(['id', 'company', 'email', 'created_at','verified','employerStatus'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');

     if(isset($request->status) && !empty($request->status)){
        if($request->status == 'verified')
            $records = $records->where('verified','1');
        if($request->status == 'pending')
            $records = $records->where('verified','0');
     }

      return datatables($records)

      ->editColumn('created_at', function ($records) {

        return humanReadableDateTime($records->created_at); // human readable format
      })
      
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('employers.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px"><i class="far fa-edit"></i></button></a>';

            $rhtml .= '<button id="empdel" type="button" class="btn btn-danger btn-sm" data-type="Employer" emp-id='. $records->id.' emp-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';

            if(!$records->verified){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnVerifyUser m-1" user-id='. $records->id.'">Verify</button>';
            }

            if($records->employerStatus == 'unpaid' && $records->verified == 1 ){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm makePaidButton m-1" data-toggle = "modal" data-target= "#makePaid_modal" emp-id="'. $records->id.'">Make Paid</button>';
            }
            if($records->employerStatus == 'paid' && $records->verified == 1 ){
                $rhtml .= '<button type="button" class="btn btn-danger btn-sm m-1 makingUnpaidbutton" data-toggle = "modal" data-target= "#makeunPaid_modal" emp-id="'. $records->id.'">Make unPaid</button>';
            }
            return $rhtml;
        }
      })
      ->addColumn('profile', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserInfo" user-id='. $records->id.' >Info</button>';
            return $rhtml;
      }})
      ->rawColumns(['profile','action'])
      ->toJson();

    }


    public function uploadUserGallery(Request $request)
    {

        // dd( $request->toArray() );
        $user = User::find($request->UserID);
        $image = $request->file('file');

        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $file_thumb  = $user->id.'/gallery/small/'.$fileName;
        $file_path   = $user->id.'/gallery/'.$fileName;

        $img = Image::make($image->getRealPath());
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();

        // Storage::disk('user')->put($user->id . '/gallery/small/' . $fileName, $img, 'public');
        Storage::disk('publicMedia')->put( $file_thumb , $img);

        $img = Image::make($image->getRealPath());
        $img->stream();

        // Storage::disk('user')->put($user->id . '/gallery/' . $fileName, $img, 'public');
        Storage::disk('publicMedia')->put($file_path, $img, 'public');


        $userGallery = new UserGallery();
        $userGallery->user_id = $user->id;
        $userGallery->image = $fileName;
        $userGallery->status = 1;
        $userGallery->save();
        $html ='<div class="imageDiv" id="photodiv_'.$userGallery->id.'" style="display:inline-block;">';
        $html .='<img   id="photo_'.$userGallery->id.'"   class="photo" src="'.assetGallery(1,$user->id,'',$userGallery->image).'">';
        $html .='<div class="img-overlay text-center">';
        $html .= '<button onclick="UProfile.confirmPhotoDelete('.$userGallery->id.'); return false;" class="btn btn-sm btn-success">Delete</button>';
        $html .= '</div></div>';

        $output = array(
            'status' => '1',
            'success' => 'Image uploaded successfully',
            'image'  =>  asset('images/user/' . $user->id . '/gallery/small/' . $fileName), // Storage::disk('user')->url( $user->id. '/gallery/smalls/'.$fileName)
            'html'  => $html
        );
        return response()->json($output);
    }

    public function uploadVideo(Request $request){

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
            $storeStatus = Storage::disk('user')->put($user->id . '/private/videos/' . $fileName, file_get_contents($video), 'public');

            // store video in private folder by default.
            $storeStatus = Storage::disk('privateMedia')->put($user->id . '/videos/' . $fileName, file_get_contents($video));




            $video = new Video();
            $video->title = $fileName;
            $video->type = $mime;
            $video->user_id = $user->id;
            $video->status = 2;
            // $video->file =  $user->id . '/private/videos/' . $fileName;
            $video->file = $user->id.'/videos/'.$fileName;
            $video->save();

            // generate video thumbs.
            $video->generateThumbs();


            // $html  = '<div id="v_'.$video->id.'" class="item profile_photo_frame item_video" style="display: inline-block;">';
            // $html .=    '<a onclick="UProfile.showVideoModal(\''.assetVideo($video).'\')" class="video_link" target="_blank">';
            // $html .=        '<div class="v_title_shadow"><span class="v_title">'.$video->title.'</span></div>';
            // $html .=        generateVideoThumbs($video);
            // $html .=    '</a>';
            // $html .=    '<span title="Delete video" class="icon_delete" data-vid="12" onclick="UProfile.delteVideo('.$video->id.')">';
            // $html .=        '<span class="icon_delete_photo"></span>';
            // $html .=        '<span class="icon_delete_photo_hover"></span>';
            // $html .=    '</span>';

            // $html .=    '<div class="v_error error hide_it"></div>';
            // $html .=  '</div>';


            $html  =  '<div id="v_'.$video->id.'" class="showinline video_box mb-2">';
            $html .=  ' <div class="modal fade" id="modal'.$video->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            $html .=   '<div class="modal-dialog modal-lg" role="document">';
            $html .=   '<div class="modal-content">';
            $html .= '<div class="modal-body mb-0 p-0">';
            $html .= '<div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">';
            $html .= '<video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">';
            $html .= '<source src="'.assetVideo($video).'" type="video/mp4" />';
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
            $user = User::find($request->userID);
            $resume = $request->file('resume');
            // $fileName = 'resume-' . time() . '.' . $resume->getClientOriginalExtension();
            $fileName = $resume->getClientOriginalName();
            $storeStatus = Storage::disk('user')->put($user->id . '/private/' . $fileName, file_get_contents($resume), 'public');
            if ($storeStatus) {

                $attachment = new Attachment();
                $attachment->user_id =   $user->id;
                $attachment->status = 1;
                $attachment->name = $fileName;
                $attachment->type = $resume->getClientOriginalExtension();
                $attachment->file = $user->id . '/private/' . $fileName;
                $attachment->save();
                $user->step2 = 8;
                $user->save();

                $userAttachments = Attachment::where('user_id', $user->id)->get();

                $output = array(
                    'status' => '1',
                    'message' => 'Resume successfully uploaded',
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


    public function removeAttachment(Request $request)
    {
        //  dd($request->toArray());
        $user = User::find($request->userID);
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

    public function deleteVideo(Request $request){
        $user = User::find($request->userID);
        $video_id = $request->video_id;
        if (!empty($video_id)) {
            $video = Video::find($video_id);
            if ($video->user_id === $user->id) {

                // $exists = Storage::disk('user')->exists($video->file);
                // if ($exists) { Storage::disk('user')->delete($video->file); }
                $video->deleteFiles();

                $video->delete();
                $output = array(
                    'status' => '1',
                    'message' => 'video Removed.'
                );
                return response()->json($output);
            }
        }
    }

    public function deleteGallery($gallery_id, $userID)
    {

        if (empty($gallery_id)) {
            return false;
        }
        $user = User::find($userID);
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

                $g_path = (($gallery_image->access == 2)?('/private/'):('/public/')).$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                $gt_path = (($gallery_image->access == 2)?('/private/'):('/public/')).$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;

                // Storage::disk('user')->delete($user->id . '/gallery/' . $gallery_image->image);
                // Storage::disk('user')->delete($user->id . '/gallery/small/' . $gallery_image->image);
                // dd( $g_path,  $gt_path , $gallery_image);

                Storage::disk('media')->delete($g_path);
                Storage::disk('media')->delete($gt_path);

                $gallery_image->delete();
                $output = array(
                    'status' => '1',
                    'message' => 'Image succesfully removed'
                );
                return response()->json($output);
            }
        }
    }







    /** ================   ================ */
    public function create(){



        $data['record']   = FALSE;
        $data['title']  = 'User';
        $data['content_header'] = 'Add new User';
        $data['countries'] = get_Geo_Country();
        $data['qualificationList'] = getQualificationsList();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();
        $data['userquestion'] = getUserRegisterQuestions();
        $data['industry_experience'] = getIndustries();
        $data['salaryRange'] = getSalariesRange();
        return view('admin.user.edit', $data);
    }

     public function createEmployer(){
        $data['record']   = FALSE;
        $data['title']  = 'Employer';
        $data['content_header'] = 'Add new Employer';
        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();
        $data['empquestion'] = getEmpRegisterQuestions();
        return view('admin.employer.edit', $data);
    }

    /** ================   ================ */
    public function edit($id){

        $user = User::with('profileImage')->where('id',$id)->first();

        $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();
        $videos = Video::where('user_id', $user->id)->get();
        $attachments = Attachment::where('user_id', $user->id)->get();


        if(empty($user)){ return redirect(route('users.create')); }
        if($user->type == 'employer'){
            return redirect(route('employers.edit', ['id' => $user->id]));
        }else if($user->type == 'user'){
            $data['record']   = $user;
            $data['title']  = 'User';
            $data['content_header'] = 'Edit User';
            $data['countries'] = get_Geo_Country();
            $data['qualificationList'] = getQualificationsList();
            $data['languages'] = getLanguages();
            $data['hobbies'] = getHobbies();
            $data['userquestion'] = getUserRegisterQuestions();
            $data['industriesList'] = getIndustries();
            $data['salaryRange'] = getSalariesRange();
            $data['questionsList'] = getIndustries();
            $data['user_gallery'] = $user_gallery;
            $data['videos'] = $videos;
            $data['attachments'] = $attachments;
            return view('admin.user.edit', $data); // admin/user/edit
        }
        
    }

    /** ================  ================ */
    public function editEmployer(User $id){


        $user = $id;

        $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();

        $data['record']   = $id;
        $data['title']  = 'Employer';
        $data['content_header'] = 'Edit Employer';
        $data['countries'] = get_Geo_Country();
        $data['educationDropdown'] = getEducationDropdown();
        $data['languages'] = getLanguages();
        $data['hobbies'] = getHobbies();
        $data['familyType'] = getFamilyType();
        $data['eyeColor'] = getEyeColor();
        $data['Days'] = getDays();
        $data['Months'] = getMonths();
        $data['years'] = getYears();
        $data['qualificationList'] = getQualificationsList();
        $data['industriesList'] = getIndustries();
        $data['questionsList'] = getEmpRegisterQuestions();
        $data['user_gallery'] = $user_gallery;

        // edit end

        return view('admin.employer.edit', $data);
    }

    public function admin_userUpdate(Request $request, $id){

        $user = User::find($id);
        if (!$user){
            return redirect(route('users'))->withErrors(['token' => 'User with id '.$id.' does not exist']);
        }

        // dd($request->toArray());

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'phone' => 'max:15',
            'country' => 'max:50',
            'state' => 'max:50',
            'city' => 'max:50',
            'age' => 'max:15',
            // 'bday' => 'max:2',
            // 'bmonth' => 'max:2',
            // 'byear' => 'max:4',
            // 'statusText' => 'max:125',
            'gender' => 'max:25',
            // 'eye' => 'max:15',
            'family' => 'max:15',
            // 'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:500',
            'interested_in' => 'max:250',
            'userquestion' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        // $user->age = $request->age;
        // $user->bday = $request->bday;
        // $user->bmonth = $request->bmonth;
        // $user->byear = $request->byear;
        // $user->statusText = $request->statusText;
        // $user->gender = $request->gender;
        // $user->eye = $request->eye;
        $user->family = $request->family;
        $user->language = $request->language;
        // $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

         // dd(  $request->toArray() );

        $user->questions = json_encode($request->questions);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;
        $user->qualification = $request->qualification;
        $user->industry_experience = $request->industry_experience;
        $user->recentJob = $request->recentJob;
        $user->salaryRange = $request->salaryRange;
        
        // ======================= update passing year and age of user =======================
        $user->passing_year = $request->passing_year; 
        
        $today_date = date('Y');
        $passing_year = $request->passing_year;
        $diff = $today_date - $passing_year;
        $age = 18 + $diff;
        $user->age = $age ;

        // dd($age);

        if( $user->save() ){
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }



    public function addNewLoaction(Request $request) {
        $rules = array(
            'location' => 'max:100',
            'country' => 'max:100',
            'state' => 'max:100',
            'city' => 'max:100',
            'location_lat' => 'max:50',
            'location_long' => 'max:50',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {
            // check country state city correction.
            // $geo_country = \App\GeoCountry::where('country_id', $request->country)->first();
            // if (!$geo_country) {
            //     return response()->json([
            //         'status' => 0,
            //         'validator' =>  $validator->errors()->add('country', 'Wrong Country id')
            //     ]);
            // }
            // $geo_validate_state = $geo_country->validateState($request->state);
            // if (!$geo_validate_state) {
            //     $validator->errors()->add('state', 'Wrong State selected');
            //     return response()->json([
            //         'status' => 0,
            //         'validator' => $validator->getMessageBag()->toArray()
            //     ]);
            // }
            // $geo_validate_city  = $geo_country->validateCity($request->state, $request->city);
            // if (!$geo_validate_city) {
            //     $validator->errors()->add('city', 'Wrong City selected');
            //     return response()->json([
            //         'status' => 0,
            //         'validator' => $validator->getMessageBag()->toArray()
            //     ]);
            // }

            // $lati = $request->location_lat;

            $user = User::findOrFail($request->user_id);
            $user->location_lat     = $request->location_lat;
            $user->location_long    = $request->location_long;


            if($request->location == $request->city){
                $user->location = '';
            }
            else{
                $user->location         = $request->location;
            }
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city = $request->city;


            try {
                $user->save();
                return response()->json([
                    'status' => 1,
                    'validator' => 'record Succesfully saved',
                    'data' => userLocation($user)
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 0,
                    'error' => $e->errorInfo[2]
                ]);
            }
        }
    }









    public function updateEmployer(Request $request, $id){

        // dd($request->toArray());
        $user = User::find($id);

        if (!$user){
            return redirect(route('adminEmployers'))->withErrors(['token' => 'Employers with id '.$id.' does not exist']);
        }

        $this->validate($request, [
            'name' => 'max:255',
            'email' => 'email',
            'statusText' => 'max:25',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',
        ]);

        if(!empty($request->name)){
            $user->name = $request->name;
        }
        else{
            $user->name = '';
        }


        $user->email = $request->email;
        $user->statusText = $request->statusText;

             if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }


        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;
        if(!empty($request->qualification)){
            $user->qualification = $request->qualification;
        }
        else{
            $user->qualification = '';
        }


        if(!empty($request->industry_experience)){
            $user->industry_experience = $request->industry_experience;
        }
        else{
            $user->industry_experience = '';
        }
        $user->questions = json_encode($request->questions);
        $user->company = $request->company;
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;

        if( $user->save() ){
            return redirect(route('adminEmployers'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function store(Request $request){


        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'password' => 'required',
            'phone' => 'max:15',
            'country' => 'max:50',
            'state' => 'max:50',
            'city' => 'max:50',
            'age' => 'max:15',
            'bday' => 'max:2',
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:125',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            // 'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;

        // $user->education = $request->education;

        $user->qualification = $request->qualifications;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;

        // $user->questions = implode(',',$request->questions);

        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->credit = $request->credit;
        $user->industry_experience = $request->industry_experience;
        $user->recentJob = $request->recentJob;
        $user->salaryRange = $request->salaryRange;
        $user->type = "user";
        if( $user->save() ){
            $user->roles()->attach([config('app.user_role')]);
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function storeEmployer(Request $request){
        // dd( $request->toArray() );
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'password' => 'required',
            'phone' => 'max:15',
            'country' => 'max:50',
            'state' => 'max:50',
            'city' => 'max:50',
            'age' => 'max:15',
            'bday' => 'max:2',
            'bmonth' => 'max:2',
            'byear' => 'max:4',
            'statusText' => 'max:25',
            'gender' => 'max:25',
            'eye' => 'max:15',
            'family' => 'max:15',
            'educaion' => 'max:15',
            'language' => 'max:15',
            'hobbies' => 'max:15',
            'about_me' => 'max:250',
            'interested_in' => 'max:250',
            'questions' => 'max:250',
            'created_at' => 'max:250',
            'updated_at' => 'max:250',
            'credit' => 'max:250',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;
        $user->education = $request->education;
        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->interested_in = $request->interested_in;
        $user->questions = json_encode($request->questions);
        $user->created_at = $request->created_at;
        $user->updated_at = $request->updated_at;
        $user->company = $request->company;
        $user->credit = $request->credit;
        $user->type = "employer";

        if( $user->save() ){
            $user->roles()->attach([config('app.employer_role')]);
            return redirect(route('adminEmployers'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    public function show($id){}

    // ========================================================================================= 
    //Destroy User
    // ========================================================================================= 

    public function destroyUser($id){
        $user = User::find($id);
        // dd($user->id);

        //  
        if(!empty($user)){

            
            $Interviews_booking = Interviews_booking::where('email',$user->email)->where('mobile' , $user->phone)->get();
            if (!empty($Interviews_booking)) {
                foreach ($Interviews_booking as $int_booking) {
                    $int_booking->delete();
                }
            }



            $UserTags = UserTags::where('user_id',$user->id)->get();
            if (!empty($UserTags)) {
                foreach ($UserTags as $tags) {
                    $tags->delete();
                }
            }

            // ====================================== Remove Videos ====================================== 

            $Video = Video::where('user_id' , $user->id)->get();
            if (!empty($Video)) {
                // dd($Video);
                foreach ($Video as $vid) {
                    $vid->deleteFiles();
                    $vid->delete();
                }
                
            }

            // ====================================== Remove galelery like profile pictures ====================================== 
            $UserGallery = UserGallery::where('user_id',$user->id)->get();
            if (!empty($UserGallery)) {
                foreach ($UserGallery as $gallery_image) {
                    if ($gallery_image->user_id == $user->id) {
                        $g_path = (($gallery_image->access == 2)?('/private/'):('/public/')).$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                        $gt_path = (($gallery_image->access == 2)?('/private/'):('/public/')).$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;
                        Storage::disk('media')->delete($g_path);
                        Storage::disk('media')->delete($gt_path);
                    }
                }

            }


            // ====================================== Remove Attachment ====================================== 

            $Attachment = Attachment::where('user_id',$user->id)->get();
            if (!empty($Attachment)) {
                foreach ($Attachment as $Attach) {
                    if ($Attach->user_id == $user->id) {
                        $exists = Storage::disk('user')->exists($Attach->file);
                        if ($exists) {
                            Storage::disk('user')->delete($Attach->file);
                        }
                        $Attach->delete();
                    }
                
                }
            }

            // ====================================== Remove Qualification ====================================== 

            $UserQualification = UserQualification::where('user_id',$user->id)->get();
            if (!empty($UserQualification)) {
                // dd($UserQualification);
                foreach ($UserQualification as $qualification) {
                    $qualification->delete();
                }
            }

            $UserIndustries = UserIndustries::where('user_id',$user->id)->get();
            if (!empty($UserIndustries)) {
                foreach ($UserIndustries as $industry) {
                    $industry->delete();
                }
                // dd($UserIndustries);
            }

            $UserInterview = UserInterview::where('user_id',$user->id)->get();
            if (!empty($UserInterview)) {
                foreach ($UserInterview as $interview) {
                    $interview->delete();
                }
            }


            $UserOnlineTest = UserOnlineTest::where('user_id',$user->id)->get();
            if (!empty($UserOnlineTest)) {
                foreach ($UserOnlineTest as $test) {
                    $test->delete();
                }
                // dd($UserOnlineTest);
            }

            $UserInterviewAnswers = UserInterviewAnswers::where('user_id',$user->id)->get();
            if (!empty($UserInterviewAnswers)) {
                foreach ($UserInterviewAnswers as $interview_answers) {
                    $interview_answers->delete();
                }
                // dd($UserInterviewAnswers)
            }

            $UserOnlineTestAnswers = UserOnlineTestAnswers::where('user_id',$user->id)->get();
            if (!empty($UserOnlineTestAnswers)) {
                foreach ($UserOnlineTestAnswers as $onlineTest) {
                    $onlineTest->delete();
                }
                // dd($UserOnlineTestAnswers);
            }

            $UserPool = UserPool::where('user_id',$user->id)->get();
            if (!empty($UserPool)) {
                foreach ($UserPool as $pool) {
                    $pool->delete();
                }
                // dd($UserPool);
            }

        }

      if(!empty($user)){

        /*        $g_path = '/private/'.$user->id;
                $gt_path = '/public/'.$user->id;
                // $gt_path = (($gallery_image->access == 2)?('/private/'):('/public/')).$user->id.'/gallery/small/'.$gallery_image->image;
                dd($gt_path);
                Storage::disk('media')->delete($g_path);
                Storage::disk('media')->delete($gt_path);
        */
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'User Succesfully Deleted',
          ]);
      }
    }

    // =================================================== Destroy Employer ===================================================

    public function destroyemployers($id){
      $user = User::find($id);
      if(!empty($user)){
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Job Succesfully Deleted',
          ]);
      }
    }   

    // =================================================== Profile ===================================================


    public function profilePopup(Request $request){
     $user = User::with(['Gallery','profileImage'])->where('id',$request->id)->first();
     if($user){
        // $gallery =  UserGallery::where('user_id',$request->id)->get();
        $data['user'] = $user;

        return view('admin.user.profilePopup', $data);
        // admin/user/profilePopup
     }
    }


    //===============================================================================================================//
    // return user uploaded videos for user lising page popup .
    //===============================================================================================================//
    public function profileVideoPopup(Request $request){
     $user = User::with('vidoes')->where('id',$request->id)->first();
     if($user){
        $data['user'] = $user;
        return view('admin.user.profileVideoPopup', $data);
        // admin/user/profileVideoPopup
     }
    }


    //===============================================================================================================//
    // return JobSeeker uploaded Resume link.
    //===============================================================================================================//
    public function resumeData(Request $request){
     $resume = Attachment::where('user_id',$request->id)->first();
     if(!empty($resume))
        return assetResume($resume);
    }

    //===============================================================================================================//
    // make all selected checkbox user account verified/enabled.
    //===============================================================================================================//
    public function confirmAccount(Request $request){
      onlyAdmin();
      // dd($request->cbx);
      if(!empty($request->cbx) && is_array($request->cbx)){
        $result =  User::whereIn('id', $request->cbx)->update(array('verified' => 1, 'email_verified_at' => date("Y-m-d H:i:s")));
        if($result > 0){
            return response()->json([
                'status' => 1,
                'message' => '<h3 class="text-center">('.$result.') JobSeekers Succesfully Approved</h3>',
          ]);
        }
      }
    }

    // end here
    public function controJSlndex() {
        $data['title'] = 'Job Seekers';
        $data['content_header'] = 'Control Job Seekers';
        $data['filter_status'] = '';
        return view('admin.controlsJS.list', $data);     // admin/controlsJS/list
    }

    // ========================================= Control Job Seeker Data Table Start =========================================

    public function CJSgetDatatable(Request $request){
      $records = array();

       // dd($request->toArray());
      $records = User::select(['id', 'name' ,'surname', 'city','email','phone','verified','created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');

      return datatables($records)

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
      })
      
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href =" ' .route('useridforcontroling' , ['id' => $records->id]).'"><button type="button" value = "'.$records->id.'" class="btn btn-primary btn-sm"style = "margin-right:2px;"> Control </button></a>';

            // $rhtml = '<a href="'.route('users.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px;"><i class="far fa-edit"></i></button></a>';

            return $rhtml;
        }})

      ->toJson();
    }

    // ========================================= Control Job Seeker Data Table End =========================================
    // ========================================= Control Employer Start =========================================

     public function controlEmpIndex() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Control Employer';
        $data['filter_status'] = null;
        return view('admin.controlsEmp.list', $data);
        // admin/controlsEmp/list
    }
    

    
    // ========================================= Control Employer End  =========================================

    // ========================================= Control Employer Data Table Start =========================================

    public function cEmpDatatable(Request $request){
      $records = array();
      $records = User::select(['id', 'company', 'email', 'created_at','verified'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
      })

      ->addColumn('action', function ($records) {
        if (isAdmin()){

            $rhtml = '<a href =" ' .route('employeridforcontroling' , ['id' => $records->id]).'"><button type="button" value = "'.$records->id.'" class="btn btn-primary btn-sm"style = "margin-right:2px"> Control</button></a>';

            // $rhtml = '<a href="'.route('employers.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px"><i class="far fa-edit"></i></button></a>';


            return $rhtml;
        }
      })
      
      // ->rawColumns(['profile','action'])
      ->toJson();

    }

    // ========================================= Control Employer Data Table Start =========================================


    // ========================================= Admin Notes Start =========================================

     public function adminNotes() {
        $data['title'] = 'Notes';
        $data['content_header'] = 'Notes';
        $data['filter_status'] = null;
        return view('admin.notes.notes', $data);
        // admin/notes/notes
    }


    // ========================================= Admin Notes Data Table Start =========================================

    public function notesDataTable(Request $request){
      $records = array();
      $records = Notes::select(['id', 'user_id', 'js_id', 'text', 'created_at'])
        // ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      ->editColumn('created_at', function ($request) {
        return $request->created_at->format('d-m-Y'); // human readable format
      })

      ->addColumn('action', function ($records) {
        if (isAdmin()){

            $rhtml = ' <i value = "'.$records->id.'" class="fas fa-trash text-danger pointer noteId" data-toggle="modal" data-target="#deleteNoteModal" > </i>';

            //  $rhtml .= '<a href =" ' .route('adminEditNote' , ['id' => $records->id]).'">
            // <i value = "'.$records->id.'" class="fas fa-edit text-danger"> </i></a>';

            // $rhtml = '<a href =" ' .route('AdminDeleteNote' , ['id' => $records->id]).'">
            // <i value = "'.$records->id.'" class="fas fa-trash text-danger"> </i></a>';

            return $rhtml;
        }
      })
      
      // ->rawColumns(['profile','action'])
      ->toJson();

    }

    // ========================================= Admin Notes Delete end =========================================

    public function adminDeleteNote(Request $request){
        $id = $request->id;
        $note = Notes::find($id);
        if(!empty($note)){
            if (isAdmin()) {
                $note->delete();
                return response()->json([
                'status' => 1,
                'message' => 'Note Succesfully Deleted',
                ]);
            }
            
        }
    }

    // ========================================= Admin Notes Edit =========================================

    public function adminEditNote($id){

        Auth::user();

        return view('admin.user.edit', $data);
        
        $id = $request->id;
        $note = Notes::find($id);
        if(!empty($note)){
            if (isAdmin()) {
                $note->delete();
                return response()->json([
                'status' => 1,
                'message' => 'Note Succesfully Deleted',
                ]);
            }
            
        }
    }




    // ========================================= Iteration-8 Live Tracker =========================================

    public function trackUsers() {
        Auth::user();
        $data['title'] = 'Live Tracker';
        $data['content_header'] = 'Live Tracker';
        $data['filter_status'] = 'verified';
        // $data['jobStatusArray'] = jobStatusArray();
        
        return view('admin.candidate_tracking.list', $data); // admin/candidate_tracking/list
    }




    //  =================================================== Tracker datatable ===================================================

    public function getDatatableTracker(Request $request){
        $records = array();
        // dd($request);
        $records = User::select(['id', 'name','email', 'default_job' ,'phone','verified'])
        ->where('tracker' , '1')
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
        if(isset($request->status) && !empty($request->status)){
            if($request->status == 'verified')
                $records = $records->where('verified','1');
            if($request->status == 'pending')
                $records = $records->where('verified','0');
        }
        return datatables($records)
        
        ->addColumn('profile', function ($records) {
            if (isAdmin()){
                $rhtml = '<a class="btn btn-primary btn-sm" href="'.route('jobSeekerInfo',['id'=>$records->id]).'" target="_blank" >Info</a>';
                return $rhtml;
            }})

        ->addColumn('select_job', function ($records) {
            if (isAdmin()){
                $jobAppCount = ($records->jobAppCount)?($records->jobAppCount->aggregate):0;
                if ($jobAppCount > 0) {
                    if (isset($records->default_job)) { 
                        $viewjob = '<span class = "ml-1">Job-<u><span><a class="pointer text-success " href="" target="_blank" >View</a>';
                        $jobStatusArray = jobStatusArray();
                        $jobHtml = '<button class = "btn btn-primary userJobsModal jobTitle_'.$records->id.'"  data-toggle ="modal" user_id = '.$records->id.' data-target = "#getJobsModal"> '.$records->defaultJob->job->title.' </button>';
                        $jobStatus  =  jobStatusArray();
                        return $jobHtml;
                    }
                    else{
                        $viewjob = '<span class = "ml-1">Job-<u><span><a class="pointer text-success " href="" target="_blank" >View</a>';
                        $jobStatusArray = jobStatusArray();
                        $jobHtml = '<button class = "btn btn-primary userJobsModal jobTitle_'.$records->id.'"  data-toggle ="modal" user_id = '.$records->id.' data-target = "#getJobsModal"> Select Job </button>';
                        $jobStatus  =  jobStatusArray();
                        return $jobHtml;
                    }
                }
                else{
                    $nan = '<span class = "text-danger"> None Available </span>';
                    return $nan;
                }
            }})

        ->addColumn('job_status', function ($records) {
            if (isAdmin()){
                $jobAppCount = ($records->jobAppCount)?($records->jobAppCount->aggregate):0;
                if ($jobAppCount > 0) {
                    if (isset($records->default_job)) { 
                        if ($records->defaultJob->status == 'inreview') {
                            $rhtml = '<a class="text-dark jobStatus changeJobStatusButton text-capitalize pointer jobStatus_'.$records->id.'" jobapp_id = "'.$records->defaultJob->id.'" user_id = "'.$records->id.'" target="_blank" > In Review</a>';
                            return $rhtml;
                        }
                        else{
                            $rhtml = '<a class="text-dark jobStatus changeJobStatusButton text-capitalize pointer jobStatus_'.$records->id.'" jobapp_id = "'.$records->defaultJob->id.'" user_id = "'.$records->id.'" target="_blank" > '.$records->defaultJob->status.'</a>';
                            return $rhtml;
                        }
                    }
                    else{
                        $rhtml = '<a class="text-dark jobStatus pointer jobStatus_'.$records->id.'" user_id = "'.$records->id.'" target="_blank" >Job Status</a>';
                        return $rhtml;
                    }
                }
                else{
                    $nan = '<span class = "text-danger"> None Available </span>';
                    return $nan;
                }
            }})

        ->addColumn('ref_check', function ($records) {
        if (isAdmin()){
            $refCount = ($records->crossreferenceCount)?($records->crossreferenceCount->aggregate):0;
            if ($refCount > 0) {
                $viewRef = '<span class = "ml-1">Complete-<u><span><a class="pointer text-success " href="'.route('referencesForAll',['id'=>$records->id, 'name'=>$records->name ]).'" target="_blank" >View</a>';
                $refHtml = '<span class = "text-success "> '.$refCount.' '.$viewRef.' </u></span>';
                return $refHtml;
            }
            else{
                $nan = '<span class = "text-danger"> None Available </span>';
                return $nan;
            }

        }})


        ->addColumn('tests', function ($records) {
        if (isAdmin()){
            $refCount = ($records->userOnlineTestCount)?($records->userOnlineTestCount->aggregate):0;
            if ($refCount > 0) {
                $viewRef = '<span class = "ml-1">Complete-<u><span><a class="pointer text-success " 
                href="'.route('completedOnlineTests',['id'=>$records->id]).'" target="_blank" >View</a>';
                $refHtml = '<span class = "text-success "> '.$refCount.' '.$viewRef.' </u></span>';


                // $userOnlineTestCount = ($records->userOnlineTestCount)?($records->userOnlineTestCount->aggregate):0;
                // dd($userOnlineTestCount);
                
                return $refHtml;
            }
            else{
                $nan = '<span class = "text-danger"> None Available </span>';
                return $nan;
            }

        }})

        ->addColumn('interviews', function ($records) {
        if (isAdmin()){
            $refCount = ($records->user_interviewsAccount)?($records->user_interviewsAccount->aggregate):0;
            if ($refCount > 0) {
                $viewRef = '<span class = "ml-1">Complete-<u><span><a class="pointer text-success " 
                href="'.route('completedInterviews',['id'=>$records->id]).'" target="_blank" >View</a>';
                $refHtml = '<span class = "text-success "> '.$refCount.' '.$viewRef.' </u></span>';

                return $refHtml;
            }
            else{
                $nan = '<span class = "text-danger"> None Available </span>';
                return $nan;
            }

        }})

        ->addColumn('notes', function ($records) {
            if (isAdmin()){
                $notes = $records->notesCount;
                if ($notes) {
                    $rview = '<div class = "noteDiv">';
                    $rview .= '<h4><i class = "fas fa-times adminNote">  </i></h4>';
                    $rview .= '<p class = "noteText mt-3"> '.$notes->text.' </p>';
                    $rview .= '</div>';
                    $rview .= '<span class = "newNote d-none" ><input type = "text" note_id = "'.$notes->id.'" user_id = '.$records->id.' class = "form-control newNoteInput"></span';

                    return $rview;
                }
                else{

                    $view = '<span class = "addNotesField btn btn-primary"> Add Note' ;
                    $view .= '</span>';
                    $view .= '<input type = "text" user_id = '.$records->id.' class = "form-control d-none inputType">';

                    return $view;
                }
            }})



        /*->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a > <i class ="far fa-trash-alt btn btn-danger btn-sm deleteCandidate" data-id= "'.$records->id.'"> </i> </a>';
            return $rhtml;
        }})*/

        // ->addColumn('resume', function ($records) {
        // if (isAdmin()){
        //     $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserResumeInfo" user-id='. $records->id.' >Info</button>';
        //     return $rhtml;
        // }})

      ->removeColumn('verified')
      ->rawColumns(['profile','select_job','job_status','ref_check', 'tests', 'interviews', 'notes'])
      ->toJson();
    }


    // =================================================== Get Job Application for admin iteration-8 ===================================================

  public function addCandidate(Request $request){


    $data['title'] = 'Add Candidate';
    $data['content_header'] = 'Add Candidate';
    $data['filter_status'] = 'verified';
    // $data['jobStatusArray'] = jobStatusArray();        
    return view('admin.candidate_tracking.add_candidate', $data);
    // admin/candidate_tracking/add_candidate
  }

    // =================================================== Get Job Application for admin iteration-8 ===================================================

    
    
    public function addCandidateDatatable(Request $request){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'phone', 'created_at'])
      ->where('tracker', '0')
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      // ->editColumn('created_at', function ($request) {
      //   return $request->created_at->format('Y-m-d'); // human readable format
      // })

      ->addColumn('profile', function ($records) {
            if (isAdmin()){
                $rhtml = '<a class="btn btn-primary btn-sm" href="'.route('jobSeekerInfo',['id'=>$records->id]).'" target="_blank" >Info</a>';
                return $rhtml;
            }})

      ->addColumn('action', function ($records) {
        if (isAdmin()){
                $rhtml = ' <button value = "'.$records->id.'" class="btn btn-primary addCandidate" > Add to Tracker</button>';
            return $rhtml;
        }
      })
      
      ->rawColumns(['profile','action'])
      ->toJson();

    }

    // =================================================== Add to tracker admin iteration-8 ===================================================

    public function addToTracker(Request $request){

        $user = User::where('id' , $request->id)->first();
        // dd($user->tracker);
        $user->tracker = 1;
        $user->save();

    }

    // =================================================== Remove candidate from tracker admin iteration-9 ===================================================

    public function removefromTracker(Request $request){
        $data = $request->toArray();
        foreach ($data['cbx'] as $key => $value) {
            $user = User::where('id' , $value)->first();
            if (isAdmin()) {
                $user->tracker = 0;
                $user->save();
            }
        }
        // return redirect()->route('trackUsers');
        return redirect(route('trackUsers'))->withSuccess( __('Users removed from tracker successfully'));

    }

    // =================================================== Add Note admin iteration-8 ===================================================

    public function addUsersNote(Request $request){
        $user = Auth::user();
        $note = new Notes();
        $note->admin_id = $user->id;
        $note->js_id = $request->user_id;
        $note->user_id = $user->id;
        $note->text = $request->text;
        $note->save();
    }

    // =================================================== Add Note admin iteration-8 ===================================================

    public function updateNote(Request $request){
        // dd($request->all());
        $user = Auth::user();
        if (isAdmin()) {
            
            $note = new Notes;
            $note->text = $request->text;
            $note->js_id = $request->js_id;
            $note->admin_id = 1;
            $note->save();

            return response()->json([
                'status' => 1,
                'message' => 'Note added successfully'

            ]);

        }
        
    }







    



}
