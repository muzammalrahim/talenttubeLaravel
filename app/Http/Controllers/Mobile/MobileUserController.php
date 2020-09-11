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

use App\fbremacc;

// use App\Hash;
use Illuminate\Support\Facades\Hash;




class MobileUserController extends Controller
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
            // $data['industry_experience'] = getIndustries();
            $data['industriesList'] = getIndustries();
            $data['userquestion'] = getUserRegisterQuestions();
            $view_name = 'site.user.profile.profile'; // site/user/profile/profile
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
								// dd($user);
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

        return view('mobile.register.user_step2', $data);    //		mobile/register/user_step2

    }

    //====================================================================================================================================//
    //Ajax Post from step2 layout  // Add user step2 data.
    //====================================================================================================================================//
    public function Step2(Request $request){
								// dd($request);
					$requestData = $request->all();
					$requestData['step'] = my_sanitize_number($request->step);

													$user = Auth::user();
													if ($requestData['step'] == 2)
													{
																	$requestData['questions']       = json_decode($request->questions, true);
																	if( !empty($requestData['questions']) ){
																					foreach($requestData['questions'] as $qk => $qv){
																									$requestData['questions'][$qk] = my_sanitize_string($qv);
																					}
																	}
					//            dd($requestData['questions']);
																	$rules = array(
																					'questions'  => 'required'
																	);
																	$validator = Validator::make($requestData, $rules);
																	if ($validator->fails()){
																					return response()->json([
																									'status' => 0,
																									'validator' => $validator->getMessageBag()->toArray()
																					]);
																	} else {
																					$user->questions = $requestData['questions'];
																					$user->step2 = $requestData['step'];
																					$user->save();
																					return response()->json([
																									'status' => 1,
																									'message' => 'questions saved succesfully'
																					]);
																	}
													} elseif ($requestData['step'] == 3) {
																	$rules = array(
																					'about_me' => 'required|max:300',
																					'interested_in' => 'required|max:150',
																					'recentJob'  => 'required'
																	);
																	$validator = Validator::make($requestData, $rules);
																	if ($validator->fails()){
																					return response()->json([
																									'status' => 0,
																									'validator' => $validator->getMessageBag()->toArray()
																					]);
																	}
																	$user->about_me         = $requestData['about_me'];
																	$user->interested_in    = $requestData['interested_in'];
																	$user->recentJob        = $requestData['recentJob'];
																	$user->step2 = $requestData['step'];
																	$user->save();
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
																	}
																	return response()->json([
																					'status' => 1,
																					'message' => 'about me saved succesfully'
																	]);
													}
													elseif ($requestData['step'] == 4)
													{
																	$requestData['qualification'] = my_sanitize_array_number(json_decode(stripslashes($request->qualification),true));
																	$requestData['qualification_type'] = my_sanitize_string($request->qualification_type);
																	$rules = array(
																					'qualification'  => 'required'
																	);
																	$validator = Validator::make($requestData, $rules);
																	if ($validator->fails()){
																					return response()->json([
																									'status' => 0,
																									'validator' => $validator->getMessageBag()->toArray()
																					]);
																	}
																	$user->qualification    = $requestData['qualification'];
																	$user->qualificationType= $requestData['qualification_type'];
																	$user->step2 = $requestData['step'];
																	$user->save();
																	$user->qualificationRelation()->sync($requestData['qualification']);
																	return response()->json([
																					'status' => 1,
																					'message' => 'qualification saved succesfully',
																	]);
													} elseif ($requestData['step'] == 5)
													{
																	$requestData['industry_experience'] = my_sanitize_array_string(json_decode(stripslashes($request->industry_experience),true));
																	$rules = array(
																					'industry_experience'  => 'required'
																	);
																	$validator = Validator::make($requestData, $rules);
																	if ($validator->fails()){
																					return response()->json([
																									'status' => 0,
																									'validator' => $validator->getMessageBag()->toArray()
																					]);
																	}
																	$user->industry_experience = $requestData['industry_experience'];
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'industry experience saved succesfully',
																	]);
													} elseif ($requestData['step'] == 6)
													{
																	$requestData['salaryRange'] = my_sanitize_string($request->salaryRange);
																	$rules = array(
																					'salaryRange'  => 'required'
																	);
																	$validator = Validator::make($requestData, $rules);
																	if ($validator->fails()){
																					return response()->json([
																									'status' => 0,
																									'validator' => $validator->getMessageBag()->toArray()
																					]);
																	}
																	$user->salaryRange      = $requestData['salaryRange'];
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'salary range saved succesfully',
																	]);
													} elseif ($requestData['step'] == 7)
													{
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'data saved successfully'
																	]);
													} elseif($requestData['step'] == 8) {
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'data saved successfully'
																	]);
													} elseif($requestData['step'] == 9) {
																	$requestData['tags'] = my_sanitize_string($request->tags);
																	$requestData['tags'] = !empty($requestData['tags'])?(explode(',', $requestData['tags'])):null;
					//            $rules = array(
					//                'tags'  => 'required'
					//            );
					//            $validator = Validator::make($requestData, $rules);
					//            if ($validator->fails()){
					//                return response()->json([
					//                    'status' => 0,
					//                    'validator' => $validator->getMessageBag()->toArray()
					//                ]);
					//            }
																	if ($requestData['tags'] != null) {
																					$user->step2 = $requestData['step'];
																					$user->save();
																					$user->tags()->sync($requestData['tags']);
																	}
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'data saved successfully'
																	]);
													} else {
																	$user->step2 = $requestData['step'];
																	$user->save();
																	return response()->json([
																					'status' => 1,
																					'message' => 'data saved successfully',
																					'redirect' => route('mProfile'),
																					'step' => $requestData['step']
																	]);
													}
    }



    //====================================================================================================================================//
    // save post user profile data. posted from profile setting page
    //====================================================================================================================================//
    public function updateUserProfile(Request $request) {
        $rules = array(
            'nickname' => 'required',
            'biirth_day' => 'day|integer',
            'birth_month' => 'month|integer',
            'birth_year' => 'year|integer',

            'location_name' => 'max:100',
            'location_country' => 'max:100',
            'location_state' => 'max:100',
            'location_city' => 'max:100',
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

            $user = Auth::user();
            $user->name = $request->nickname;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city =  $request->city;
            $user->bday = $request->day;
            $user->bmonth = $request->month;
            $user->byear = $request->year;
            $user->location_lat     = $request->location_lat;
            $user->location_long    = $request->location_long;
            $user->location         = $request->location_name;
            $user->country = $request->location_country;
            $user->state = $request->location_state;
            $user->city = $request->location_city;


            try {
                $user->save();
                $html_userProfileLocation  = '<ul class="list_info userProfileLocation">';
                $html_userProfileLocation .= '<li><span id="list_info_age">'.$user->age.'</span><span class="basic_info">•</span></li>';
                $html_userProfileLocation .= '<li id="list_info_location">'.userLocation($user).'</li>';
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
    // Ajax For updating Interested In.
    // Called from JobSeeker Profile page.
    //====================================================================================================================================//
    public function MupdateInterested_in(Request $request){

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

    // Ajax For updating Interested In.
    //====================================================================================================================================//

    //====================================================================================================================================//
    // Ajax For updating About Me.

    public function Mabout_me(Request $request){

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

    // Ajax For updating About Me.
    //====================================================================================================================================//


    //====================================================================================================================================//
    // Ajax For updating Qualification.
    // Called from JobSeeker Profile page.
    //====================================================================================================================================//
    public function MupdateQualification(Request $request){

        $requestData = $request->all();
        $rules = array(
                    'qualification'    => 'required|array',
                    'qualification.*'  => 'required|integer'
                );
        $validator = Validator::make($requestData, $rules);
        // dd( $validator->errors() );
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->qualification = $request->qualification;
            $user->qualificationRelation()->sync($requestData['qualification']);
            $user->save();
            $data['user'] = User::find($user->id);
            $QualificationView =  view('mobile.layout.parts.jobSeekerQualificationList', $data);
            $QualificationHtml = $QualificationView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $QualificationHtml,
            ]);
        }
    }

    // Ajax For updating Questions.
    //====================================================================================================================================//


    public function MupdateQuestions(Request $request){

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
            return response()->json([
                    'status' => 1,
                    'data' => $user->questions
            ]);
        // }
    }

    //====================================================================================================================================//
    // Ajax POST // Like Employer on JobSeeker Employer listing page.
    //====================================================================================================================================//
    public function MlikeEmployer($employerId){
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
            'message' => 'Employer Succefully Liked',
            'data' =>  $record
        ]);
    }


    // Ajax For Liking Employer End here.
    //====================================================================================================================================//


    //====================================================================================================================================//
    // Ajax POST // Block Employer on JobSeeker Employers listing page.
    //====================================================================================================================================//

    public function MblockEmployer($employerId){
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
    public function Mjobs(){
		$user = Auth::user();
		$user->step2 = 10;
		$user->save();
        $data['user'] = $user;
        $data['title'] = 'Jobs';
        $data['classes_body'] = 'jobs';
       // $data['jobs'] =Jobs::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->paginate(2);
        return view('mobile.jobs.index', $data); // mobile/jobs/index
				}




	public function step2Jobs(){
		$user = Auth::user();
		//        $data = array();
		if (!isEmployer($user)){
						$jobs = Jobs::take(10)->get();
						return view('mobile.jobs.jobsListstep2', compact('jobs'));
		}
	}


	function jobsFilter(Request $request){
		// dd($request->toArray());
		$user = Auth::user();
		$data = array();
		if(!isEmployer($user)){
			$data['user'] = $user;
			$data['title'] = 'Jobs';
			$data['classes_body'] = 'jobs';
			// $applications = new JobsApplication();
			// $applications = $applications->getFilterApplication($request);
			// $likeUsers    = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();

			// $jobs =Jobs::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->paginate(2);
			// $jobs = $jobs->filterJobs($request);
			$jobs = new Jobs();
			$jobs = $jobs->filterJobs($request);
			// ::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->get();

				$data['jobs'] = $jobs;
			//	dd($jobs);
							return view('mobile.jobs.jobsList', $data);
						// mobile/jobs/list
		}
	}
    //====================================================================================================================================//
    // Get // Add new job layout.
    //====================================================================================================================================//

    public function MnewJob(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Add New Job';
        $data['classes_body'] = 'newJob';

        $data['geo_state']      = get_Geo_State(default_Country_id());
        $data['geo_cities']     = get_Geo_City(default_Country_id(), default_State_id());

        // $jobs =  Jobs::find(12);
        // dd( json_decode($jobs->questions()->first()->options, true) );
        // dd( $jobs->questions()->first()->options );

        $data['geo_country'] = get_Geo_Country();
        return view('mobile.jobs.new', $data); // site/jobs/new
    }

// ========================================== Employers on Mobile Phone ==========================================
  public function Memployers(Request $request){
        $user = Auth::user();
        if (isEmployer($user)){ return redirect(route('jobSeekers')); }
        $data['user']           = $user;
        $data['title']          = 'Employers';
        $data['classes_body']   = 'employers';
        $employersObj          = new User();
       // $jobSeekers             = $employersObj->getEmployersp($request, $user);
        $jobSeekers             = $employersObj->getEmployers($request, $user);
        $likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $blockUsers             = BlockUser::where('user_id',$user->id)->pluck('block')->toArray();
        // dd($blockUsers);
        $data['blockUsers'] = $blockUsers;
        $data['likeUsers'] = $likeUsers;
        // $data['ajax'] =  $request->ajax;cx
        //$data['employers'] = $jobSeekers;
        // if($data['ajax']){
								//
        //         return view('mobile.user.employersList', $data); // mobile/user/employers
        //         //  $view = view('mobile.user.employers', $data);
        //         // $view = $view->render();
        //         // echo  $view;
        //         // exit;

        // }else{
             return view('mobile.user.employers', $data);		//		mobile/user/employers
        // }
		}

				public function Memployerspost(Request $request){
        //dd($request);
					$user = Auth::user();
					if (isEmployer($user)){ return redirect(route('jobSeekers')); }
					$data['user']           = $user;
					$data['title']          = 'Employers';
					$data['classes_body']   = 'employers';
					$employersObj          = new User();
					$employers             = $employersObj->getEmployersp($request, $user);
					$likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
					$data['likeUsers'] = $likeUsers;
					$data['employers'] = $employers;
					return view('mobile.user.employersList', $data); // mobile/user/employers
					//  $view = view('mobile.user.employers', $data);
					// $view = $view->render();
					// echo  $view;
					// exit;
	}


	public function addNewJob(Request $request){
		$user = Auth::user();

		// dd( $request->toArray() );
		// dd( $request->jq );
		// Jobs::find(12)->addJobQuestions($requestData['jq']);

		$requestData = $request->all();
		$requestData['title']         = my_sanitize_string($request->title);
		$requestData['description']   =  my_sanitize_string($request->description);
		$requestData['experience']    =  my_sanitize_string($request->experience);
		$requestData['type']          =  my_sanitize_string($request->type);
		$requestData['geo_country']   =  my_sanitize_number($request->geo_country);
		$requestData['geo_states']   =  my_sanitize_number($request->geo_states);
		$requestData['geo_cities']   =  my_sanitize_number($request->geo_cities);
		$requestData['vacancies']   =  my_sanitize_number($request->vacancies);
		$requestData['salary']   =  my_sanitize_string($request->salary);
		$requestData['expiration']   =  my_sanitize_string($request->expiration);
		// $requestData['gender']   =  my_sanitize_string($request->gender);
		// $requestData['age']   =  my_sanitize_string($request->age);


		// sanitize all questions data.
		foreach ($requestData['jq'] as $jqk => $jqv) {

						// dump($requestData['jq']);
						// dump($jqk);
						// dd($jqv['title']);

						$requestData['jq'][$jqk]['title'] = my_sanitize_string($jqv['title']);
						if(!empty($jqv['option'])){
										foreach ($jqv['option'] as $jqok => $jqov) {
														$requestData['jq'][$jqk]['option'][$jqok]['text'] = my_sanitize_string($requestData['jq'][$jqk]['option'][$jqok]['text']);
										}
						}
		}

		// Jobs::find(12)->addJobQuestions($requestData['jq']);


		// $requestData['questions']       =  json_encode( $requestData['questions']);
		$rules = array(
						"title" => "required|string|max:255",
						"description" => "required|string",
						"experience"  => "string|max:255",
						"type"  => "required|string|max:10",
						"geo_country"  => "integer",
						"geo_states"  => "integer",
						"geo_cities"  => "integer",
						"vacancies"  => "integer",
						"salary"  => "string|max:255",
						// "gender" => "required|in:male,female,any",
						"expiration" => "string|max:60",
						// "age" => "string|max:20",
        );
		$validator = Validator::make( $requestData , $rules);
		if ($validator->fails()){
						return response()->json([
										'status' => 0,
										'validator' =>  $validator->getMessageBag()->toArray()
						]);
		}else{
						// dd(' all valiation correct ');
						$job = new Jobs();
						$job->title =  $requestData['title'];
						$job->description =  $requestData['description'];
						$job->experience =  $requestData['experience'];
						$job->type =  $requestData['type'];
						$job->country =  $requestData['geo_country'];
						$job->state =  $requestData['geo_states'];
						$job->city =  $requestData['geo_cities'];
						$job->vacancies =  $requestData['vacancies'];
						$job->salary =  $requestData['salary'];
						// $job->gender =  $requestData['gender'];
						// $job->age =  $requestData['age'];
						$job->user_id =  $user->id;
						$job->expiration =  $requestData['expiration'].' 00:00:00';
						// $job->questions =  $requestData['questions'];
						$job->code =  Jobs::generateCode(); //
						$job->save();
						$job->addJobQuestions($requestData['jq']);
						return response()->json([
										'status' => 1,
										'message' => '<h3>Job Succesfully Created.</h3><p>Click here to view job detail</p>',
										// 'redirect' => route('')
						]);
		}

}
    //====================================================================================================================================//
    // Get // layout for listing of jobSeekers on mobile.
    //====================================================================================================================================//

        public function MjobSeekers(Request $request){


									$user = Auth::user();
									if (!isEmployer($user)){ return redirect(route('jobs')); }
									$data['user']           = $user;
									$data['title']          = 'Job Seekers';
									$data['classes_body']   = 'jobSeekers';
									$jobSeekersObj          = new User();
									$jobSeekers             = $jobSeekersObj->getJobSeekersm($request, $user);
									$likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();

									$data['likeUsers'] = $likeUsers;
									//$data['jobSeekers'] = $jobSeekers; // $jobSeekers;

									return view('mobile.employer.jobSeekers.index', $data);
								 // mobile/employer/jobSeekers/index
				}




		public function jobSeekersFilter(Request $request){
			  $user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to access this information',
            ]);
        }

        $data['user']           = $user;
        $jobSeekersObj          = new User();
        $jobSeekers             = $jobSeekersObj->getJobSeekersm($request, $user);
        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;
        $qualification_type = $request->ja_filter_qualification_type;
        $qualifications = $request->ja_filter_qualification;
        $likeUsers = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        $query = User::with('profileImage')->where('type','user');
        if(!empty($block)){
            $query = $query->whereNotIn('id', $block);
        }

        // Filter by salaryRange.
        if (isset($request->filter_salary) && !empty($request->filter_salary)){
            $query = $query->where('salaryRange', '>=', $request->filter_salary);
        }

        // Filter by google map location radius.
        if (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on')){
            if( isset($request->location_lat) && isset($request->location_long)  && isset($request->filter_location_radius)){
                // $query =  $query->findByLatLongRadius($data, $request->location_lat, $request->location_long, $request->filter_location_radius);
                 $latitude = $request->location_lat;
                 $longitude = $request->location_long;
                 $radius = $request->filter_location_radius;
                 $radius_sign = ($radius <= 50)?'<':'>';

                 $query = $query->selectRaw("*,
                     ( 6371 * acos( cos(radians('".$latitude."'))
                     * cos( radians(location_lat))
                     * cos( radians(location_long) - radians('".$longitude."'))
                     + sin( radians('".$latitude."'))
                     * sin( radians( location_lat )))
                     ) AS distance")
                ->having("distance", $radius_sign, $radius)
                ->orderBy("distance",'asc');

            }
        }

        // Filter by Keyword filter_keyword
        if(varExist('filter_keyword', $request)){
            $keyword = $request->filter_keyword;
            $query = $query->where(function($q) use($keyword) {
                        $q->where('username','LIKE', "%{$keyword}%")
                        ->orWhere('name','LIKE', "%{$keyword}%")
                        ->orWhere('email','LIKE', "%{$keyword}%")
                        ->orWhere('about_me','LIKE', "%{$keyword}%")
                        ->orWhere('interested_in','LIKE', "%{$keyword}%")
                        ->orWhere('recentJob','LIKE', "%{$keyword}%");
                });
        }

        // Filter by Keyword filter_keyword
        if(varExist('filter_qualification_type', $request)){
            $query = $query->where('qualificationType', '=', $request->filter_qualification_type);
        }

        // Filter by Question
        if(varExist('filter_question', $request) && varExist('filter_question_value', $request) ){
            // SELECT * FROM `users` WHERE `questions` LIKE '%\"relocation\":\"yes\"%' ORDER BY `id` DESC
            $question_like =  '%\"'. $request->filter_question.'\":\"'. $request->filter_question_value.'\"%';
            $query = $query->where('questions', 'LIKE', $question_like);
        }


        //Filter by industry status.
        if($industry_status && !empty($industries)){
            $query = $query->where(function($q) use($industries) {
                $q->where('industry_experience','LIKE', "%{$industries[0]}%");
                if(count($industries) > 1){
                    foreach ($industries as $indk =>  $industry) {
                        if($indk == 0) continue;
                        $q->orWhere('industry_experience','LIKE', "%{$industry}%");
                    }
                }
            });
        }


        //Filter by qualification.
        if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
        if(!empty($qualifications)){
            $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                $query2->whereIn('qualifications.id', $qualifications);
                // $query->where('jobseeker.id', 1);
                // dd($query->toSql());
                return $query2;
            });
        }

								// dd($query);

        // DB::enableQueryLog();
        // print_r( $query->toSql() );exit;
        // $jobSeekers =  $query->paginate(2);
        // $jobSeekers =  $query->get();
        // dd(DB::getQueryLog());
        // return $data;
        $data['likeUsers'] = $likeUsers;
        $data['jobSeekers'] = $jobSeekers;
		    return view('mobile.employer.jobSeekers.list', $data); // mobile/employer/jobSeekers/list
	}
    //====================================================================================================================================//
    // Get // Show list of jobs posted by employer.
    //====================================================================================================================================//
    public function MemployerJobs(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My Jobs';
        $data['classes_body'] = 'myJob';
        $data['jobs'] = Jobs::with('applicationCount')->where('user_id',$user->id)->orderBy('created_at', 'DESC')->get();
        return view('mobile.employer.myjobs', $data);
        // mobile/employer/myjobs
    }


    //====================================================================================================================================//
    // Get // layout for Employer Detail.
    //====================================================================================================================================//
    public function MemployerInfo($employerId){
        $user = Auth::user();
        if (isEmployer($user)){ return redirect(route('employers')); }
        $data['user'] = $user;
        $employer = User::Employer()->where('id',$employerId)->first();

        // check if employer with id exist.
        if(empty($employer) || !isEmployer($employer) ){ return redirect(route('employers')); }

        // check if this employer has not block you.
       if(hasBlockYou($user, $employer)){ return view('unauthorized', $data); }

        $jobs                = Jobs::where('user_id',$employerId)->get();
        $employer_gallery    = UserGallery::Public()->Active()->where('user_id',$employerId)->get();
        $employer_video      = Video::where('user_id', $employerId)->get();

        $data['title']          = 'Employer Info';
        $data['classes_body']   = 'employerInfo';
        $data['employer']       = $employer;
        $data['likeUsers']      = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['jobs']           = $jobs;
        $data['galleries']        = $employer_gallery;
        $data['videos']          = $employer_video;
        $data['empquestion'] = getEmpRegisterQuestions();
        return view('mobile.user.employerInfo', $data);           // 	mobile/user/employerInfo
    }

    //====================================================================================================================================//
    // Get // layout for Employer Detail.
    //====================================================================================================================================//
    public function MjobSeekersInfo($jobseekerId){
        $user = Auth::user();
        // dump($jobseekerId);

        // if (isEmployer($user)){ return redirect(route('employers')); }
        $data['user'] = $user;
        $employer = User::JobSeeker()->where('id',$jobseekerId)->first();

        // check if employer with id exist.
        // if(empty($employer) || !isEmployer($employer) ){ return redirect(route('employers')); }

        // check if this employer has not block you.
       if(hasBlockYou($user, $employer)){ return view('unauthorized', $data); }

        $jobs                = Jobs::where('user_id',$jobseekerId)->get();
        $employer_gallery    = UserGallery::Public()->Active()->where('user_id',$jobseekerId)->get();
        $employer_video      = Video::where('user_id', $jobseekerId)->get();

        $data['title']          = 'JobSeeker Info';
        $data['classes_body']   = 'Jobseeker Info';
        $data['jobseeker']       = $employer;
        $data['likeUsers']      = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['jobs']           = $jobs;
        $data['galleries']        = $employer_gallery;
        $data['videos']          = $employer_video;
        $data['empquestion'] = getEmpRegisterQuestions();
        $data['userquestion'] = getUserRegisterQuestions();

        return view('mobile.employer.jobSeekers.jobseekersInfo', $data);          // mobile/employer/jobSeekers/jobseekersInfo

    }

    //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    // function jobsFilter(Request $request){
    //     // dd($request->toArray());
    //     $user = Auth::user();
    //     $data = array();
    //     if(!isEmployer($user)){

    //         // $applications = new JobsApplication();
    //         // $applications = $applications->getFilterApplication($request);
    //         // $likeUsers    = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();

    //         $jobs = new Jobs();
    //         $jobs = $jobs->filterJobs($request);

    //         // ::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->get();

    //          $data['jobs'] = $jobs;

    //         return view('site.jobs.list', $data);
    //         // site/jobs/list
    //     }
    // }



    //====================================================================================================================================//
    // GET // Job Apply information layout.
    //====================================================================================================================================//
    public function MjobApplyInfo($job_id){
        // dd($job_id);
        $user = Auth::user();
        $data['user'] = $user;
        $data['job'] = Jobs::with('questions')->find($job_id);
        return view('mobile.jobs.applyInfo', $data);

    }

    //====================================================================================================================================//
    // Ajax POST // Job Apply Submitted.
    //====================================================================================================================================//
    public function MjobApplySubmit(Request $request){

         // dd($request->toArray());
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


            // check application description which is mandatory.
            if(empty($request->application_description)){
                 return response()->json([
                    'status' => 0,
                    'error' => 'Please answer all mandatory question.'
                ]);
            }

            $newJobApplication = new JobsApplication();
            $newJobApplication->user_id = $user->id;
            $newJobApplication->job_id = $job->id;
            $newJobApplication->status = 'applied';
            $newJobApplication->description = $request->application_description;
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
    public function mJobApplications(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'My job applications';
        $data['classes_body'] = 'jobApplications';
        $data['applications'] = JobsApplication::with('job')->where('user_id',$user->id)->get();
        return view('mobile.jobs.applied', $data);			// 	mobile/jobs/applied
    }


    //====================================================================================================================================//
    // POST // delete job application.
    //====================================================================================================================================//
    public function MdeleteJobApplication($jobAppId){
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
    public function MdeleteJob($jobId){

    	// dd($jobId);
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
    public function MblockList(){
        $user = Auth::user();
        // $profile_image   = UserGallery::where('user_id', $user->id)->where('status', 1)->where('profile', 1)->first();
        //     if (!$profile_image) {
        //         if ($user_gallery->count() > 0) {
        //            $profile_image   = assetGallery($user_gallery->first()->access,$user->id,'',$user_gallery->first()->image);
        //         } else {
        //             $profile_image   = asset('images/site/icons/nophoto.jpg');
        //         }
        //     } else {
        //         $profile_image   = assetGallery($profile_image->access,$user->id,'',$profile_image->image);
        //     }

        // $data['profile_image']    = $profile_image;
        $data['user'] = $user;
        $data['title'] = 'Block Users';
        $data['classes_body'] = 'blockUsers';
        $data['blockUsers'] = BlockUser::with('user')->where('user_id',$user->id)->get();
        return view('mobile.user.blockUsers', $data);  //   mobile/user/blockUsers
    }

    //=====================Like Function ==============================================//

    public function MlikeList(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Like Users';
        $data['classes_body'] = 'likeUsers';
        $data['likeUsers'] = LikeUser::with('user')->where('user_id',$user->id)->get();
        return view('mobile.user.likeUsers', $data);  //  mobile/user/likeUsers
    }

    //====================================================================================================================================//
    // Ajax Post // Remove user from user block User List.
    //====================================================================================================================================//
    public function MunBlockUser(Request $request){
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

    // public function MunLikeUser(Request $request){
    //     // dd($request);

    //     $user = Auth::user();
    //     $likeUserId = (int)$request->id;
    //     LikeUser::where('like',$likeUserId)->delete();
    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'User unLiked Succesfully'
    //     ]);
    // }


    public function MunLikeUser(Request $request){
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
    // Get // get mutual likes user List.
    //====================================================================================================================================//
    public function MmutualLikes(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Mutual Like Users';
        $data['classes_body'] = 'mutualLikes';

        $whoLikeMe = LikeUser::where('like',$user->id)->pluck('user_id');
        $mutualUser = null;
        if(!empty($whoLikeMe)){
          $mutualUser = LikeUser::with('user')->where('user_id',$user->id)->whereIn('like',$whoLikeMe)->get();
        }

        // dd( $mutualUser );

        $data['likeUsers'] = $mutualUser;
        return view('mobile.user.mutualUsers', $data);
        // site/user/mutualUsers
    }


    //====================================================================================================================================//
    // Save User Personal Setting.
    // Ajax submit request from profile page.
    //====================================================================================================================================//
    public function MupdateUserPersonalSetting(Request $request)
    {
            $user = Auth::user();
            $data['classes_body'] = 'profile';
            $data['user'] = $user;
            $view = view('mobile.user.profile.updateUserPersonalSetting', $data); //    mobile/user/profile/updateUserPersonalSetting
            $html = $view->render();
            return $view;
    }


    // ===================================== Update Email  =================================

        public function MupdateEmail(Request $request)
    {
        $rules = array('email' => 'required|email|unique:users,email');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $valitdaion_message = $validator->getMessageBag()->toArray();
            $mes = $valitdaion_message['email'];
            return response()->json([
                'status' => 0,
                'validator' =>  $mes
            ]);
        }else{
            $user = Auth::user();
            $user->oldEmail = $user->email;
            $user->email = $request->email;
            $user->save();
            return response()->json([
                    'status' => 1,
                    'data' => array(
                        'email_User' => $user->email,
                        'logout_Route' => route('logout')
                    )
            ]);
        }
    }

    // ===================================== Update Phone Function ==============================================================
    public function MupdatePhone(Request $request){
        $user = Auth::user();
        // dd( $user->id);



        $rules = array('phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $valitdaion_message = $validator->getMessageBag()->toArray();
            $mes = $valitdaion_message['phone'];
            return response()->json([
                'status' => 0,
                'validator' =>  $mes
            ]);
        }
        else{
            $user = Auth::user();
            $user->phone = $request->phone;
            $user->save();
            return response()->json([
                    'status' => 1,
                    'data' => $user->phone
            ]);
        }
    }

    // =============================================== Update Phone Function End Here =========================================

    // =========================================== Update Password Function End Here ===========================================
    public function MupdatePassword(Request $request){
        $user = Auth::user();

        // dd($request->current_password);
        // dd($request->new_password);
        // dd($user->password);


        $rules = array('current_password' => 'required|min:6|max:255', 'new_password' => 'required|min:6|max:255');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            // check if user has enter his current password correct.
            if(!Hash::check($request->current_password, $user->password)){
                return response()->json([
                    'status' => 0,
                    'validator' =>  $validator->getMessageBag()->toArray(),
                    'validator' =>  $validator->errors()->add('current_password', 'Current password is wrong')
                ]);
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json([
                    'status' => 1,
                    'data' => route('logout')
            ]);
        }
    }


    // ================================== Update Password Function End Here ========================================================


    // =================================================  Delete job Seeker Function ================================================
    public function Mdeleteuser(Request $request){


        $user = Auth::user();
        $del_data = new fbremacc();

        if(isEmployer($user))
        {
            $del_data->user_id = $user->id;
            $del_data->user_name = $user->username;
            $del_data->user_email = $user->email;
            $del_data->reason = $request->reasonValue;

            $del_data->save();
        }

        else{

            $del_data->user_id = $user->id;
            $del_data->user_name = $user->username;
            $del_data->user_email = $user->email;
            $del_data->recentJob = $user->recentJob;
            $del_data->statusText = $user->statusText;
            $del_data->company = $user->company;
            $del_data->reason = $request->reasonValue;
            $del_data->save();
        }


        // dd( $user->email);

        if(!empty($user)){
        $user->delete();
          return response()->json([
                'status' => 1,
                'message' => 'User Succesfully Deleted',
          ]);
      }
    }

    // ================================================= Delete job Seeker Function End Here ==============================================

    //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    public function Mcredit(){
        $user = Auth::user();
        if(isEmployer($user)){
            $data['title']  = 'Credit';
            $data['user']   =  $user;
            $data['classes_body'] = 'credit';
            return view('mobile.credit.purchase', $data);
        }
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




    //====================================================================================================================================//
    // Get // show job detail page.
    //====================================================================================================================================//
    function MjobDetail(Jobs $id){
        // dd($job);
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Job Detail';
        $data['classes_body'] = 'jobDetail';
        $data['job'] = $id;
        return view('mobile.jobs.jobDetail', $data);  //  mobile/jobs/jobDetail

    }


 // ================================== Ajax For updating Industry Experience. ==============================


    public function MupdateIndustryExperience(Request $request){

        // dump($request->tags);
        $user = Auth::user();
        $rules = array(
                'industry_experience'    => 'required|array',
                'industry_experience.*'  => 'string|max:100'
        );
        $validator = Validator::make($request->all(), $rules);
        // dd( $validator->errors() );
        if (!$validator->fails()) {
            $user->industry_experience = $request->industry_experience;
            $user->save();
            $data['user'] = User::find($user->id);
            $IndustryView = view('site.layout.parts.jobSeekerIndustryList', $data);
            $IndustryHtml = $IndustryView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $IndustryHtml
            ]);
        }
    }

 // ============================= Ajax For updating Industry Experience End here =================================

    // Get // show job detail page.
    //====================================================================================================================================//
    // function MjobDetail(Jobs $id){
    //     // dd($job);
    //     $user = Auth::user();
    //     $data['user'] = $user;
    //     $data['title'] = 'Job Detail';
    //     $data['classes_body'] = 'jobDetail';
    //     $data['job'] = $id;
    //     return view('site.jobs.jobDetail', $data);
    // }

}
