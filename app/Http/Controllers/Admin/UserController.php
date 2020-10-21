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
      $records = User::select(['id', 'surname', 'city','email','phone','verified','created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
     if(isset($request->status) && !empty($request->status)){

        if($request->status == 'verified')
            $records = $records->where('verified','1');

        if($request->status == 'pending')
            $records = $records->where('verified','0');

     }

      return datatables($records)
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
      $records = User::select(['id', 'name', 'email', 'created_at','verified'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');

     if(isset($request->status) && !empty($request->status)){
        if($request->status == 'verified')
            $records = $records->where('verified','1');
        if($request->status == 'pending')
            $records = $records->where('verified','0');
     }

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('employers.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-right:2px"><i class="far fa-edit"></i></button></a>';

            $rhtml .= '<button id="empdel" type="button" class="btn btn-danger btn-sm" data-type="Employer" emp-id='. $records->id.' emp-title="'.$records->name.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';

            if(!$records->verified){
                 $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnVerifyUser m-1" user-id='. $records->id.'">Verify</button>';
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

            // $data['familyType'] = getFamilyType();
            // $data['eyeColor'] = getEyeColor();
            // $data['Days'] = getDays();
            // $data['Months'] = getMonths();
            // $data['years'] = getYears();

            // $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
            // $data['states'] = get_Geo_State($user->country)->pluck('state_title','state_id')->toArray();
            // $data['cities'] = get_Geo_City($user->country,$user->state)->pluck('city_title','city_id')->toArray();
            $data['userquestion'] = getUserRegisterQuestions();
            $data['industriesList'] = getIndustries();
            $data['salaryRange'] = getSalariesRange();
            $data['questionsList'] = getIndustries();

            $data['user_gallery'] = $user_gallery;
            $data['videos'] = $videos;
            $data['attachments'] = $attachments;


            return view('admin.user.edit', $data);
        }
        // admin/user/edit
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

    public function update(Request $request, $id){

        $user = User::find($id);
        if (!$user){
            return redirect(route('users'))->withErrors(['token' => 'User with id '.$id.' does not exist']);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
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
        $user->age = $request->age;
        $user->bday = $request->bday;
        $user->bmonth = $request->bmonth;
        $user->byear = $request->byear;
        $user->statusText = $request->statusText;
        $user->gender = $request->gender;
        $user->eye = $request->eye;
        $user->family = $request->family;

        // $user->education = $request->education;

        $user->language = $request->language;
        $user->hobbies = $request->hobbies;
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

    // Destroy User
    public function destroyUser($id){
      $user = User::find($id);
      if(!empty($user)){
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Job Succesfully Deleted',
          ]);
      }
    }
    // Destroy User end here


    // Destroy Employer
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
      dd($request->cbx);
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
}
