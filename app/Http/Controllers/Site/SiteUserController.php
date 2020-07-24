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


class SiteUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


   
    public function index(Request $request) {
        $user = Auth::user();

        if ($request->username ===  $user->username) {
            $user_gallery = UserGallery::where('user_id', $user->id)->where('status', 1)->get();
            $profile_image   = UserGallery::where('user_id', $user->id)->where('status', 1)->where('profile', 1)->first();
            if (!$profile_image) {
                if ($user_gallery->count() > 0) {
                   $profile_image   = assetGallery($user_gallery->first()->access,$user->id,'',$user_gallery->first()->image);
                } else {
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                }
            } else {
                $profile_image   = assetGallery($profile_image->access,$user->id,'',$profile_image->image);
            }


            $attachments = Attachment::where('user_id', $user->id)->get();
            $activities = UserActivity::where('user_id', $user->id)->get();
            $videos = Video::where('user_id', $user->id)->get();


            $data['user'] =  $user;
            $data['user_gallery'] = $user_gallery;
            $data['geo_country'] = get_Geo_Country();
            
            $data['geo_state'] = !empty($user->country)?(get_Geo_State($user->country)):null;
            $data['geo_city'] = !empty($user->country)?(get_Geo_City($user->country,$user->state)):null; 

            $data['profile_image']    = $profile_image;
            $data['title'] = 'profile';
            $data['classes_body'] = 'profile';
            $data['content'] = 'this is page content';
            $data['attachments'] = $attachments;
            $data['activities'] = $activities;
            $data['videos'] = $videos;
            
            // Getting Salaries
            $data['salaryRange'] = getSalariesRange();
            $data['qualificationList'] = getQualificationsList();
            

            $view_name = 'site.user.profile.profile';
            return view($view_name, $data);
        } else {
            return view('site.404');
        }
    }


    
    //====================================================================================================================================//
    // Display Step2 form for Employer, on first time registeration.
    //====================================================================================================================================//

    public function step2User(){
        // dd(' step2Employer ');
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'User';
        $data['classes_body'] = 'userStep2';
        // $data['content'] = 'this is page content';

        $tagCategories = TagCategory::get();
        $tags = Tags::orderBy('usage', 'DESC')->limit(30)->get();

        // dump(  $tags );
        // dd(  $tagCategories );
        
        $data['tags'] = $tags;
        $data['tagCategories'] = $tagCategories;
        
        return view('site.register.user_step2', $data);

    }

    //====================================================================================================================================//
    //Ajax Post from step2 layout  // Add user step2 data.
    //====================================================================================================================================//
    public function Step2(Request $request){
        
        $requestData = $request->all();
        $requestData['questions']       = json_decode( $request->questions, true );
        $requestData['about_me']        = my_sanitize_string($request->about_me);
        $requestData['interested_in']   = my_sanitize_string($request->interested_in);
        $requestData['recentJob']       = my_sanitize_string($request->recentJob);
        $requestData['industry_experience'] = my_sanitize_array_string(json_decode(stripslashes($request->industry_experience),true));
        $requestData['qualification'] = my_sanitize_array_number(json_decode(stripslashes($request->qualification),true));
        $requestData['salaryRange'] = my_sanitize_string($request->salaryRange);
        $requestData['tags'] = my_sanitize_string($request->tags);
        $requestData['tags'] = !empty($requestData['tags'])?(explode(',', $requestData['tags'])):null;

        // dump($requestData['tags']);
        // dump($requestData['industry_experience']);
        // dd( $request->toArray() );

        // dd( $request->all() );
        // dd(  $requestData );
        if( !empty($requestData['questions']) ){
            foreach($requestData['questions'] as $qk => $qv){
                $requestData['questions'][$qk] = my_sanitize_string($qv);
            }
        }

        // card_step2_validation
        $rules = array(
            'questions'  => 'required',
            'about_me' => 'required|max:150',
            'interested_in' => 'required|max:150',
            'recentJob'  => 'required',
            'industry_experience'  => 'required',
            'qualification'  => 'required',
            'salaryRange'  => 'required',
            'tags'  => 'required',
           
        );
        $validator = Validator::make( $requestData , $rules);

        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{

            // dump( ' validation success ' ); 
            // dd( $request->all() );


            $user = Auth::user();
            $user->questions        = $requestData['questions'];
            $user->about_me         = $requestData['about_me'];
            $user->interested_in    = $requestData['interested_in'];
            $user->recentJob        = $requestData['recentJob'];
            $user->industry_experience = $requestData['industry_experience'];
            $user->qualification    = $requestData['qualification'];
            $user->salaryRange      = $requestData['salaryRange'];
            $user->step2            = 1;
            $user->save();
            $user->tags()->sync($requestData['tags']); 

            if(!empty($request->file('file'))){
                $image = $request->file('file');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                
                $file_thumb  = $user->id.'/gallery/small/'.$fileName;
                $file_path   = $user->id.'/gallery/'.$fileName;

                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) { $constraint->aspectRatio(); });
                $img->stream();
                Storage::disk('publicMedia')->put( $file_thumb , $img);

                $img = Image::make($image->getRealPath());
                $img->stream();

                Storage::disk('publicMedia')->put($file_path, $img, 'public');

                $userGallery = new UserGallery();
                $userGallery->user_id = $user->id;
                $userGallery->image = $fileName;
                $userGallery->status = 1;
                $userGallery->profile = 1;
                $userGallery->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'data saved succesfully',
                    'redirect' => route('profile')
                ]);
            }
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

                $html_userProfileLocation  = '<ul class="list_info userProfileLocation">'; 
                $html_userProfileLocation .= '<li><span id="list_info_age">'.$user->age.'</span><span class="basic_info">•</span></li>'; 
                $html_userProfileLocation .= '<li id="list_info_location">'; 
                $html_userProfileLocation .= ($user->GeoCity)?($user->GeoCity->city_title):'';
                $html_userProfileLocation .= ', ';
                $html_userProfileLocation .= ($user->GeoState)?($user->GeoState->state_title):'';
                $html_userProfileLocation .= ', ';
                $html_userProfileLocation .= ($user->GeoCountry)?($user->GeoCountry->country_title):''; 
                $html_userProfileLocation .= '</li>';



                $html_userProfileLocation .= '<li><span class="basic_info">•</span><span id="list_info_gender">'.(isTypeEmployer($user)?'Employer':'Job Seeker').'</span></li>';
                $html_userProfileLocation .= '</ul>';


                return response()->json([
                    'status' => 1,
                    'validator' => 'record Succesfully saved',
                    'html_location' => $html_userProfileLocation
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
    // chagne JobSeeker recent job text.
    // Ajax / triggered from User profile page.
    //====================================================================================================================================//
    public function updateRecentJob(Request $request)
    {
        $rules = array('recentjob' => 'string|max:100');
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->recentJob = $request->recentjob;
            $user->save();
            return response()->json([
                    'status' => 1,
                    'data' => $user->recentJob
            ]);
        }
    }

 // Ajax For updating Salary Range.
    //====================================================================================================================================//


    public function updateSalaryRange(Request $request)
    {
        $rules = array('salaryRange' => 'string|max:100');
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->salaryRange = $request->salaryRange;
            $user->save();
            return response()->json([
                    'status' => 1,
                    'data' => $user->salaryRange
            ]);
        }
    }

    //====================================================================================================================================//
    // Ajax For updating Qualification.
    // Called from JobSeeker Profile page. 
    //====================================================================================================================================//
    public function updateQualification(Request $request){
        
        // dd($request->toArray());
        // dump($request->qualification);

        // $data = $request->validate([
        //     "qualification"    => "required|array|min:13",
        //     "qualification.*"  => "required|string|distinct|min:3",
        // ]);

        $requestData = $request->all();  
        // $requestData['qualification'][2] = 'test not integer'; 
        $rules = array(
                    'qualification'    => 'required|array', 
                    'qualification.*'  => 'required|integer'
                );
        $validator = Validator::make($requestData, $rules); 

        // dd( $validator->errors() ); 

        if (!$validator->fails()) {
            $user = Auth::user();
            $user->qualification = $request->qualification;
            $user->save();
            
            return response()->json([
                    'status' => 1,
                    'data' => $user->qualification
            ]);
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

                $data = array();
                $data['user'] = $user;
                $view = view('site.user.profile.personalInfoTable', $data);
                $html = $view->render();

                return response()->json([
                    'status' => 1,
                    'validator' => 'record Succesfully saved',
                    'data' =>  $user,
                    'html' =>  $html
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

        $html  = '<div id="'.$userGallery->id.'" class="item profile_photo_frame gallery_'.$userGallery->id.'">';
        

        // $html .=    '<a data-offset-id="'.$userGallery->id.'" class="show_photo_gallery" href="'.asset('images/user/'.$user->id.'/gallery/'.$userGallery->image).'" data-lcl-thumb="'.asset('images/user/'.$user->id.'/gallery/small/'.$userGallery->image).'" >';
        // $html .=       '<img data-photo-id="'.$userGallery->id.'"  id="photo_'.$userGallery->id.'"   class="photo" data-src="'.asset('images/user/'.$user->id.'/gallery/'.$userGallery->image).'" src="'.asset('images/user/'.$user->id.'/gallery/small/'.$userGallery->image).'">';
        // $html .=    '<a/>';

        $html .=    '<a data-offset-id="'.$userGallery->id.'" class="show_photo_gallery" href="'.assetGallery(1,$user->id,'',$userGallery->image).'" data-lcl-thumb="'.assetGallery(1,$user->id,'small',$userGallery->image).'" >';
        $html .=       '<img data-photo-id="'.$userGallery->id.'"  id="photo_'.$userGallery->id.'"   class="photo" data-src="'.assetGallery(1,$user->id,'',$userGallery->image).'" src="'.assetGallery(1,$user->id,'small',$userGallery->image).'">';
        $html .=    '<a/>';

        $html .=    '<span onclick="UProfile.confirmPhotoDelete('.$userGallery->id.');" title="Delete photo" class="icon_delete">';
        $html .=        '<span class="icon_delete_photo"></span>';
        $html .=        '<span class="icon_delete_photo_hover"></span>';
        $html .=    '</span>';

        $html .=    '<span onclick="UProfile.setPrivateAccess('.$userGallery->id.')"  title="Make private" class="icon_private">';
        $html .=        '<span class="icon_private_photo"></span>';
        $html .=        '<span class="icon_private_photo_hover"></span>';
        $html .=    '</span>';

        $html .=    '<span onclick="UProfile.setAsProfile('.$userGallery->id.')" title="Make Profile" class="icon_image_profile"><span class=""></span></span>';

        $html .= '</div>';


        $output = array(
            'status' => '1',
            'success' => 'Image uploaded successfully',
            'image'  =>  asset('images/user/' . $user->id . '/gallery/small/' . $fileName), // Storage::disk('user')->url( $user->id. '/gallery/smalls/'.$fileName)
            'html'  => $html
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
                $old_access = $gallery_image->access; 
                $gallery_image->access = ($gallery_image->access == 1)?2:1;
                $gallery_image->save();

                // move image to specific folder on base of access (private/public)  
                if($old_access == 2){
                    $path       = '/private/'.$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                    $newPath    = '/public/'.$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                }else{
                    $path       = '/public/'.$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                    $newPath    = '/private/'.$gallery_image->user_id.'/gallery/'.$gallery_image->image;
                }

                $image_file = Storage::disk('media')->get($path);
                Storage::disk('media')->put($newPath, $image_file); 
                Storage::disk('media')->delete($path);



                // move small image to specific folder on base of access (private/public)  
                if($old_access == 2){
                    $path       = '/private/'.$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;
                    $newPath    = '/public/'.$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;
                }else{
                    $path       = '/public/'.$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;
                    $newPath    = '/private/'.$gallery_image->user_id.'/gallery/small/'.$gallery_image->image;
                }

                $image_file = Storage::disk('media')->get($path);
                Storage::disk('media')->put($newPath, $image_file); 
                Storage::disk('media')->delete($path);
               

                // dd($path, $newPath); 

                $output = array(
                    'status' => '1',
                    'message' => 'Image succesfully updated',
                    'access' => $gallery_image->access
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
                        'small' => assetGallery($gallery_image->access,$user->id,'small',$gallery_image->image),
                        'large' => assetGallery($gallery_image->access,$user->id,'',$gallery_image->image)
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

            $activity_html  = '<div class="activity_'.$activity->id.' activity">';
            $activity_html .=   '<div class="activity_title">'.$activity->title.' ('.$activity->date->format('F Y').') </div>';
            $activity_html .=   '<div class="activity_desc">'.$activity->description.'</div>';
            $activity_html .=   '<div class="act_action"><span class="close_icon activityRemove" data-id="'.$activity->id.'"></span></div>';
            $activity_html .= '</div>';

            $output = array(
                'status' => '1',
                'message' => 'Activity Saved.',
                'data' => $activity,
                'activity_html' => $activity_html
            );
            return response()->json($output);
        }
    }


    //====================================================================================================================================//
    // POST Ajax request to remove activity.
    //====================================================================================================================================//
    public function removeActivity(Request $request)
    {
        $user = Auth::user();
        $activity_id = (int) $request->id;
        // remove activity if its associated with this user.
       $delete =  UserActivity::where('user_id',$user->id)->where('id',$activity_id)->delete();
        if ($delete){
            return response()->json([
                'status' => '1',
                'message' => 'Activity Deleted'
            ]);
        }
    }



    //====================================================================================================================================//
    // Add new user activity.
    // POST Ajax request submitted from profile area.
    //====================================================================================================================================//
    public function uploadVideo(Request $request){

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


            $html  = '<div id="v_'.$video->id.'" class="item profile_photo_frame item_video" style="display: inline-block;">';
            $html .=    '<a onclick="UProfile.showVideoModal(\''.assetVideo($video).'\')" class="video_link" target="_blank">';
            $html .=        '<div class="v_title_shadow"><span class="v_title">'.$video->title.'</span></div>';
            $html .=        generateVideoThumbs($video);
            $html .=    '</a>';
            $html .=    '<span title="Delete video" class="icon_delete" data-vid="12" onclick="UProfile.delteVideo('.$video->id.')">';
            $html .=        '<span class="icon_delete_photo"></span>';
            $html .=        '<span class="icon_delete_photo_hover"></span>';
            $html .=    '</span>';

            $html .=    '<div class="v_error error hide_it"></div>';
            $html .=  '</div>';

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






    //====================================================================================================================================//
    // Delete user video.
    // POST Ajax request submitted from profile video area.
    //====================================================================================================================================//
    public function deleteVideo(Request $request){
        $user = Auth::user();
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





    //====================================================================================================================================//
    // GET // Job Search/Listing layout.
    //====================================================================================================================================//
    public function jobs(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Jobs';
        $data['classes_body'] = 'jobs';
        $data['jobs'] = Jobs::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->get();
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
        $data['job'] = Jobs::with('questions')->find($job_id);
        // dd( $data['job']  ); 
        // dd( $data['job']->questions()->count() ); 
        return view('site.jobs.applyInfo', $data);
        // site/jobs/applyInfo 
    }


    //====================================================================================================================================//
    // Ajax POST // Job Apply Submitted.
    //====================================================================================================================================//
    public function jobApplySubmit(Request $request){
        $user = Auth::user();

        $requestData = $request->all();
        $requestData['job_id'] = my_sanitize_number( $requestData['job_id'] );

        if(isset($requestData['answer']) && !empty($requestData['answer'])){
            foreach ($requestData['answer'] as $ansK => $ansV) { 
                $requestData['answer'][$ansK]['question_id'] = my_sanitize_number($ansV['question_id']); 
                $requestData['answer'][$ansK]['option'] = my_sanitize_string($ansV['option']); 
            }  
        }


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
            $newJobApplication->status = 'applied';
            // $newJobApplication->questions = ($job->questions)?(json_encode($job->questions)):'';
            // $newJobApplication->answers  = isset($requestData['applyAnswer'])?(json_encode($requestData['applyAnswer'])):'';
            $newJobApplication->save();

            // if jobApplication is succesfully added then add job answers. 
            if( $newJobApplication->id > 0 ){
                
                if(isset($requestData['answer']) && !empty($requestData['answer'])){
                    foreach ($requestData['answer'] as $ansK => $ansV) { 
                        // $requestData['answer'][$ansK]['question_id'] = my_sanitize_number($ansV['question_id']); 
                        // $requestData['answer'][$ansK]['option'] = my_sanitize_string($ansV['option']); 

                        $jobQuestion = JobsQuestions::find($ansV['question_id']);

                        // check if jqb question exist 
                        if(!empty($jobQuestion)){

                            // get the goldstar and preffer option 
                            // $goldstar = !empty($jobQuestion->goldstar)?(json_decode($jobQuestion->goldstar, true)):(array()); 
                            // $preffer  = !empty($jobQuestion->preffer)?(json_decode($jobQuestion->preffer, true)):(array());

                            $goldstar = array();
                            if(!empty($jobQuestion->goldstar)){
                                if(!is_array($jobQuestion->goldstar)){
                                   $goldstar = json_decode($jobQuestion->goldstar, true); 
                                }else{
                                   $goldstar =  $jobQuestion->goldstar;
                                }
                            }

                            $preffer = array(); 
                            if(!empty($jobQuestion->preffer)){
                                if(!is_array($jobQuestion->preffer)){
                                   $preffer = json_decode($jobQuestion->preffer, true); 
                                }else{
                                     $preffer = $jobQuestion->preffer;
                                }
                            }

                            // dump('goldstar', $goldstar);
                            // dump('preffer', $preffer);
                            // dump('ansV', $ansV);
                           
                            $jobAnswer              = new JobsAnswers(); 
                            $jobAnswer->question_id = $ansV['question_id'];
                            $jobAnswer->user_id     = $user->id;
                            $jobAnswer->answer      = $ansV['option'];

                            $newJobApplicationUpdate = false; 

                            if(in_array($jobAnswer->answer,  $goldstar)){
                                $newJobApplication->goldstar = $newJobApplication->goldstar+1;
                                $newJobApplicationUpdate = true; 
                            }
                            
                            if(in_array($jobAnswer->answer,  $preffer)){
                                $newJobApplication->preffer = $newJobApplication->preffer+1;
                                $newJobApplicationUpdate = true; 
                            }

                            if( $newJobApplicationUpdate ){  $newJobApplication->save(); }


                            $newJobApplication->answers()->save($jobAnswer); 

                        }

                      

                    }  
                }

               

            }


             // dd($request->toArray());

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




    //====================================================================================================================================//
    // Get // layout for Block User List.
    //====================================================================================================================================//
    public function blockList(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Block Users';
        $data['classes_body'] = 'blockUsers';
        $data['blockUsers'] = BlockUser::with('user')->where('user_id',$user->id)->get();
        return view('site.user.blockUsers', $data);
    }

    

    //=====================Like Function ==============================================//

    public function likeList(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Like Users';
        $data['classes_body'] = 'likeUsers';
        $data['likeUsers'] = LikeUser::with('user')->where('user_id',$user->id)->get();
        return view('site.user.likeUsers', $data);
    }

    //====================================================================================================================================//
    // Ajax Post // Remove user from user block User List.
    //====================================================================================================================================//
    public function unBlockUser(Request $request){
        // dd( $request->toArray() );
        $user = Auth::user();
        $blockUserId = (int) $request->id;
        BlockUser::where('user_id',$user->id)->where('block',$blockUserId)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'User Unblocked Succesfully'
        ]);
    }

    //====================================================================================================================================//
    // Ajax Post // Remove user from user Like User List.
    //====================================================================================================================================//

    public function unLikeUser(Request $request){
        // dd( $request->toArray() );
        $user = Auth::user();
        $likeUserId = (int) $request->id;
        LikeUser::where('user_id',$user->id)->where('like',$likeUserId)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'User unLiked Succesfully'
        ]);
    }



    //====================================================================================================================================//
    // Ajax Get // get list of tags based on tag category.
    //====================================================================================================================================//
    function getTags(TagCategory $category, $offset = 0){
        // dd($category->toArray());
         // dd($tagsCount);

        if($category) { 

          $limit = 30;  
          // $limit = 2;  
          $skip = $offset * $limit; 

          $tags      = Tags::where('category_id',$category->id)->orderBy('usage', 'DESC')->skip($skip)->limit($limit)->get();
          $tagsCount = Tags::where('category_id',$category->id)->count();
          
          $moreTagExist = (($tagsCount >  $limit) && (($skip + $limit) < $tagsCount))?1:0;


          $tagsListHtml  = '<input type="hidden" name="tagPagination" value="0" />'; 
          $tagsListHtml .= '<ul class="tagList">'; 
          if(!empty($tags) & ($tags->count() > 0)){
            foreach ($tags as $tkey => $tag) {
                $tagsListHtml .=  '<li class="tag tagItem" data-id="'.$tag->id.'"><i class="tagIcon '.$tag->icon.'"></i>'.$tag->title.'</li>';
            }
 
            if( $moreTagExist ){
               $tagsListHtml .=  '<li class=""><a class="loadMoreTags" data-offset="'.($offset+1).'">More interests<i class="tagIcon fa fa-redo"></i></a></li>'; 
            }
          }
          $tagsListHtml .= '</ul>'; 
          return response()->json([
            'status' => 1,
            'data' => $tagsListHtml
          ]);
        }
    }


    //====================================================================================================================================//
    // Ajax Get // return list of tags based on search keyword.
    //====================================================================================================================================//
    function searchTags(Request $request){
        $search = $request->search; 
        if (!empty($search)){
            $exclude = !empty($request->exclude)?($request->exclude):(array());
            $tags = Tags::where('title', 'like', '%'.$search.'%')->whereNotIn('id',$exclude)->orderBy('usage', 'DESC')->limit(100)->get();
           // dd($tags->toArray());
           return response()->json([
            'status' => 1,
            'data' => $tags
          ]);
        }
    }


    //====================================================================================================================================//
    // Ajax Post // add new tag.
    //====================================================================================================================================//
    function addNewTag(Request $request){
        // dd( $request->toArray() );
        $rules = array(
            'newTagtitle'    => 'required|regex:/[a-zA-Z0-9\s]+/|max:20',
            'newTagCategory' => 'required|exists:tag_categories,id',
            // 'newTagIcon'     => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {

            $exist = Tags::where('title',$request->newTagtitle)->where('category_id',$request->newTagCategory)->first();
            if($exist){
                return response()->json([
                    'status' => 0,
                    'error' =>  'Tag with Title ('.$request->newTagtitle.') and Category ('.$request->newTagCategory.') already Exist',
                ]);
             }

            $newTag = new Tags();
            $newTag->title = $request->newTagtitle;
            $newTag->category_id = $request->newTagCategory;
            // $newTag->icon = $request->newTagIcon;
            $newTag->usage = 0;
            $newTag->save(); 

            return response()->json([
                'status' => 1,
                'data'   => $newTag 
            ]);

        }
    }
    


}
