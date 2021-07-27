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
use App\crossreference;
use App\History;
use App\Interviews_booking;
use App\UserInterview;
use App\InterviewTemplate;
use App\UserOnlineTest;
use App\OnlineTest;


use Carbon\Carbon;
use DateTime;

use App\CvData;
use PDFMerger;
use Spatie\PdfToText\Pdf;
use KeywordExtractor\KeywordExtractor;
use PhpOffice\PhpWord\IOFactory;
use NcJoes\OfficeConverter\OfficeConverter;


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
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'User';
        $data['classes_body'] = 'userStep2';
        $tagCategories = TagCategory::get();
        $tags = Tags::orderBy('usage', 'DESC')->limit(30)->get();
        $data['tags'] = $tags;
        $data['tagCategories'] = $tagCategories;
        return view('mobile.register.user_step2', $data);    //		mobile/register/user_step2

    }

    //====================================================================================================================================//
    //Ajax Post from step2 layout  // Add user step2 data.
    //====================================================================================================================================//
    public function Step2(Request $request){
    	// dd($request->all());
    	$requestData = $request->all();
    	$requestData['step'] = my_sanitize_number($request->step);
    	$user = Auth::user();
    	if ($requestData['step'] == 2){
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
			}else{
				$user->questions = $requestData['questions'];
				$user->step2 = $requestData['step'];
				$user->save();
				return response()->json([
					'status' => 1,
					'message' => 'questions saved succesfully'
				]);
			}
		}elseif ($requestData['step'] == 3) {
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
            $user->organHeldTitle        = $requestData['organHeldTitle']; 

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
		elseif ($requestData['step'] == 4){
			$requestData['qualification'] = my_sanitize_array_number(json_decode(stripslashes($request->qualification),true));
			$requestData['qualification_type'] = my_sanitize_string($request->qualification_type);
			/*$rules = array(
				'qualification'  => 'required'
			);
			$validator = Validator::make($requestData, $rules);
			if ($validator->fails()){
				return response()->json([
					'status' => 0,
					'validator' => $validator->getMessageBag()->toArray()
				]);
			}*/

			// dd($request->toArray());

			$data = date('Y');
            $passing_year = $requestData['passing_year'];
            $diff = $data - $passing_year;
            $age = 18 + $diff;

            $user->age = $age;
            $user->passing_year = $passing_year;


			$user->qualification    = $requestData['qualification'];
			$user->qualificationType= $requestData['qualification_type'];
			$user->step2 = $requestData['step'];
			$user->save();
			$user->qualificationRelation()->sync($requestData['qualification']);
			return response()->json([
				'status' => 1,
				'message' => 'qualification saved succesfully',
			]);
		}elseif ($requestData['step'] == 5){
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
		}elseif ($requestData['step'] == 6){
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
		}elseif ($requestData['step'] == 7)
		{
			$user->step2 = $requestData['step'];
			$user->save();
			return response()->json([
							'status' => 1,
							'message' => 'data saved successfully'
			]);
		}elseif($requestData['step'] == 8) {
			$user->step2 = $requestData['step'];
			$user->save();
			return response()->json([
				'status' => 1,
				'message' => 'data saved successfully'
			]);
		}elseif($requestData['step'] == 9) {
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
		}else {
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


    public function MupdateSalaryRange(Request $request){

    	// dd($request->salaryRange);
    	$rules = array('salaryRange' => 'string|max:100');
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $user = Auth::user();
            $user->salaryRange = $request->salaryRange;
            $user->save();
            $history = new History;

            $history->user_id = $user->id; 
            $history->new_salary = $user->salaryRange; 
            $history->type = 'Salary'; 
            $history->save();

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

    //====================================================================================================================================//
    // Ajax For updating Interested In.
    // Called from JobSeeker Profile page.
    //====================================================================================================================================//
    public function MupdateRecentJob(Request $request){

        $user = Auth::user();
        $user->recentJob = $request->recentJob;
        $user->save();

        $history = new History;
        $history->user_id = $user->id; 
        $history->recentJob = $user->recentJob; 
        $history->type = 'Recent job'; 
        $history->save();

        $data['user'] = User::find($user->id);
        return response()->json([
                'status' => 1,
                'data' => $data
        ]);
  
    }


    //====================================================================================================================================//
    // Ajax For updating Interested In.
    // Called from JobSeeker Profile page.
    //====================================================================================================================================//
    public function MupdateOrganization(Request $request){
    	// dd($request->toArray());
        $user = Auth::user();
        $user->organHeldTitle = $request->organHeldTitle;
        $user->save();

        // $history = new History;
        // $history->user_id = $user->id; 
        // $history->recentJob = $user->recentJob; 
        // $history->type = 'Recent job'; 
        // $history->save();

        $data['user'] = User::find($user->id);
        return response()->json([
                'status' => 1,
                'data' => $data
        ]);
  
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

            $history = new History;
            $history->user_id = $user->id; 
            $history->type = 'Qualification Updated'; 
            $history->save();

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
            $data['user'] = User::find($user->id);
            $data['userquestion'] = getUserRegisterQuestions();
            $questionsView = view('mobile.layout.parts.jobSeekerQuestions', $data);
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


        $html = '<div id="'.$userGallery->id.'" class="float-left mt-1 item profile_photo_frame gallery_'.$userGallery->id.' public">';
        $html .= '<a  data-offset-id="'.$userGallery->id.'" class="show_photo_gallery js-smartPhoto2" data-group="no-gravity"';
        $html .= 'href="'.assetGallery($userGallery->access,$user->id,'',$userGallery->image).'"';
        $html .= 'data-lcl-thumb="'.assetGallery($userGallery->access,$user->id,'small',$userGallery->image).'">';
        $html .= '<img data-photo-id="'.$userGallery->id.'"  id="photo_'.$userGallery->id.'"   class="photo m-1 uploadedPhotos"';
        $html .= 'data-src="'.assetGallery($userGallery->access,$user->id,'',$userGallery->image).'"';
        $html .=  'src="'.assetGallery($userGallery->access,$user->id,'small',$userGallery->image).'">';
        $html .=  '</a>';
        $html .=  '<div class="gallery_action float-right">';

        $html .=  '<span onclick="UProfile.confirmPhotoDelete('.$userGallery->id.');" title="Delete photo" class="icon_delete">';

        $html .=  '<div class="iconPosition"><i class="fas fa-trash"></i></div>';
        $html .=  '<span class="icon_delete_photo_hover"></span>';
        $html .=  '</span>';
        $html .=  '<span onclick="UProfile.setPrivateAccess('.$userGallery->id.')"  title="Make private" class="icon_private">';
        $html .=  '<div class="iconPosition"><i class="fas fa-lock"></i></div>';

        $html .=  '<span class="icon_private_photo_hover"></span>';
        $html .=  '</span>';
        $html .=  '<span onclick="UProfile.setAsProfile('.$userGallery->id.')" title="Make Profile" class="icon_image_profile">';
        $html .=  '<div class="iconPosition"><i class="fas fa-user"></i></div>';
        $html .=  '</span>';
        $html .=  '</div>';
        $html .=  '</div>';

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
            if ($gallery_image->user_id != $user->id) {
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
    	$rules = array('resume' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:204800');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => '0',
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        } else {
            $user = Auth::user();
            $resume = $request->file('resume');
        $pdf = new PDFMerger();

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

                if ($attachment->type == "pdf") {
                    $text = Pdf::getText('/var/www/html/talenttube/storage/images/user/'. $user->id. '/private/'. $attachment->name); 
                    $keywordExtractor = new KeywordExtractor();
                    $result = $keywordExtractor->run($text);
                    $arrayObj = array();
                    // dd($arrayObj);
                    $varObj = '';
                    foreach ($result as $key => $results) {
                        $varObj = mb_convert_encoding($key, 'UTF-8', 'UTF-8');
                        array_push($arrayObj, $varObj);
                    }
                    $test_var = '';
                    foreach ($arrayObj as $array) {
                        $test_var .= $array." ";
                    }
                    $cvdata = new CvData();
                    $cvdata->user_id = $user->id;
                    $cvdata->jsname = $user->name;
                    $cvdata->data_text = $test_var;
                    $cvdata->save();
                }



                elseif($attachment->type == "docx" || $attachment->type == "doc" ){

                    $str = str_replace('/', '//', $attachment->file);
                    $copystr = str_replace(".docx",".pdf",$attachment->name);
                    $copystr = str_replace(".doc",".pdf",$copystr);
                    $converter = new OfficeConverter('/var/www/html/talenttube/storage/images/user/' .$str);
                    $convertedFile = $converter->convertTo($copystr);
                    $text = Pdf::getText($convertedFile);
                    $keywordExtractor = new KeywordExtractor();
                    $result = $keywordExtractor->run($text);
                    $arrayObj = array();
                    $varObj = '';
                    foreach ($result as $key => $results) {
                        $varObj = mb_convert_encoding($key, 'UTF-8', 'UTF-8');
                        array_push($arrayObj, $varObj);
                    }
                    $test_var = '';
                    foreach ($arrayObj as $array) {
                        $test_var .= $array." ";
                    }
                    $cvdata = new CvData();
                    $cvdata->user_id = $user->id;
                    $cvdata->jsname = $user->name;
                    $cvdata->data_text = $test_var;
                    $cvdata->save();
                }
                else{
                    // return response()->json([
                    //     'status' => 0,
                    //     'message' => 'Your resume tags could not extracted',
                    // ]);
                }

                $user->step2 = 8;
                $user->save();

                $userAttachments = Attachment::where('user_id', $user->id)->get();
                $output = array(
                    'status' => '1',
                    'message' => 'Resume successfully uploaded',
                    'file' => asset('images/user/' . $user->id . '/private/' . $fileName),
                    'attachments' => $attachment,
                );
                return response()->json($output);
            } 
            else {
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
    public function MremoveAttachment(Request $request)
    {
         // dd($request->attachment_id);
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


            $html  =  '<div id="v_'.$video->id.'" class="video_box mb-2">';
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
            $html .= ' <a>'.generateVideoThumbsm($video).'</a>';
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
    // Delete user video.
    // POST Ajax request submitted from profile video area.
    //====================================================================================================================================//
    public function mdeleteVideo(Request $request){
        $user = Auth::user();
        $video_id = $request->video_id;
        // dd($video_id);
        if (!empty($video_id)) {
            $video = Video::find($video_id);
            if ($video->user_id == $user->id) {

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


	//====================================================================================================================================//
    // GET // Job Search/Listing layout.
    //====================================================================================================================================//

	public function step2Jobs(){
		$user = Auth::user();
		//        $data = array();
		if (!isEmployer($user)){
			$jobs = Jobs::take(10)->get();
			return view('mobile.jobs.jobsListstep2', compact('jobs'));  // mobile/jobs/jobsListstep2
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
			return view('mobile.jobs.jobsList', $data); // mobile/jobs/list
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
        $data['salaryRange'] = getSalariesRange();

        $onlineTest = OnlineTest::get();
        $data['onlineTest'] = $onlineTest;

        // $jobs =  Jobs::find(12);
        // dd( json_decode($jobs->questions()->first()->options, true) );
        // dd( $jobs->questions()->first()->options );
        $data['industriesList'] = getIndustries();
        $data['geo_country'] = get_Geo_Country();
        return view('mobile.jobs.new', $data); // mobile/jobs/new
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

	// ========================================== Employers Filter ==========================================

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

		$requestData['type']          =  my_sanitize_string($request->type);
		// $requestData['location_country']   =  my_sanitize_number($request->location_country);
		// $requestData['location_state']   =  my_sanitize_number($request->location_state);
		// $requestData['location_city']   =  my_sanitize_number($request->location_city);
		$requestData['vacancies']   =  my_sanitize_number($request->vacancies);
		$requestData['salary']   =  my_sanitize_string($request->salary);
		$requestData['expiration']   =  my_sanitize_string($request->expiration);
		// $requestData['gender']   =  my_sanitize_string($request->gender);
		// $requestData['age']   =  my_sanitize_string($request->age);


        // sanitize all questions data.
        if(!empty($requestData['jq'])){
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
    	}
		// Jobs::find(12)->addJobQuestions($requestData['jq']);


		// $requestData['questions']       =  json_encode( $requestData['questions']);
		$rules = array(
			"title" => "required|string|max:255",
			"description" => "required|string",
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
                if(!empty($request->industry_experience)){
                    $job->experience = json_encode(array_unique($request->industry_experience));
                }
                $job->type =  $requestData['type'];
                $job->country =  $requestData['location_country'];
                $job->state =  $requestData['location_state'];
                $job->city =  $requestData['location_city'];
                $job->location_lat =  $requestData['location_lat'];
                $job->location_long =  $requestData['location_long'];
                $job->vacancies =  $requestData['vacancies'];
                $job->salary =  $requestData['salary'];
				// $job->gender =  $requestData['gender'];
				// $job->age =  $requestData['age'];
				$job->user_id =  $user->id;
				$job->expiration =  $requestData['expiration'].' 00:00:00';


                // dd($requestData['test_id']);

                if ($requestData['test_id'] != 0) {
                    $test = $requestData['test_id'];
                    $onlineTest = OnlineTest::get()->pluck('id')->toArray();
                    if (in_array($test, $onlineTest)) {
                        // dd('Hi how are you');
                        $job->onlineTest_id = $test;
                    }
                }

				// $job->questions =  $requestData['questions'];
				$job->code =  Jobs::generateCode(); //
                $job->save();
                if(!empty($requestData['jq'])){
                    $job->addJobQuestions($requestData['jq']);
                }

				return response()->json([
					'status' => 1,
					'message' => '<h5 class="mt-2 ml-2">Job Succesfully Created.</h5>'
					// <a href='.$job->id.'><p class="jobdetailLink ml-2">Click here to view job detail</p></a>,
					// 'redirect' => route('MjobDetail', ['id' => $job->id])
					// redirect()->route('MjobDetail', ['id' => $job->id])
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

	//====================================================================================================================================//
    // Jobseeker's Filter on mobile
    //====================================================================================================================================//

	public function jobSeekersFilter(Request $request){

        // dd($request->toArray());
		$user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to access this information',
            ]);
        }

         $data['user']           = $user;

        // $userJS = User::find(140);

        // DB::enableQueryLog();
        // // $cvDataTest = $userJS->cvDataTagsRelation()->get(); 

        // dd(DB::getQueryLog());

        // dd( $user->cvDataTagsRelation()->toSql()  );
        // dd( $userJS->cvDataTagsRelation()->get() );

        // $jobSeekersObj          = new User();
        // $jobSeekers             = $jobSeekersObj->getJobSeekers($request, $user);
        
        // ================================================ Filter by Industry. ================================================

        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;
        $qualification_type = $request->filter_qualification_type;
        $qualifications = $request->ja_filter_qualification;

        $likeUsers = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        $query = User::with('profileImage','user_tags')->where('type','user')->Where('step2' , '>=' , '7');
        // $tagsQuery = Tags::get();
        if(!empty($block)){
            $query = $query->whereNotIn('id', $block);
        }

        

        // ================================================ Filter by salaryRange. ================================================

        if (isset($request->filter_salary) && !empty($request->filter_salary)){
            $query = $query->where('salaryRange', '=', $request->filter_salary);
        }

        // ================================================ Filter by google map location radius.================================================

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

        // ================================================ Filter by Age brackets.================================================

        if (isset($request->filter_by_age)) {
        	// dd(' Value  ');
            $age = $request->filter_by_age;
        	if ($age == '18-25') {
                $query = $query->whereBetween('age',  [18,25]);
                // dd($query->toSql());
            }
            elseif($age == '25-30'){
                $query = $query->whereBetween('age',  [25,30]);
            }
            elseif($age == '30-40'){
                $query = $query->whereBetween('age',  [30,40]);
            }
            elseif($age == '40-54'){
                $query = $query->whereBetween('age',  [40,54]);
            }
            elseif($age == '55+'){
                $query = $query->where('age', '>=', '55');
            }
        	// code...
        }

        // ================================================ Filter by Age gender.================================================


        if (isset($request->filter_by_gender)) {
        	$gender = $request->filter_by_gender;
            if ($gender == 'male') {
                $query = $query->where('title' , '=', 'Mr');
            }
            else{
                $query = $query->whereIn('title' , array("Mrs","Miss","Ms"));

                // $query = $query->where('title' , '=', 'Mrs')->orWhere('title' , '=', 'Miss')->orWhere('title' , '=', 'Ms');
            }
        }

        // ================================================ Filter by Keyword filter_keyword ================================================

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

        // ================================================ Filter by Questions ================================================

        if(varExist('filter_qualification_type', $request)){
            $query = $query->where('qualificationType', '=', $request->filter_qualification_type);
        }

        // ================================================ Filter by Question ================================================

        if(varExist('filter_question', $request) &&varExist('filter_by_questions', $request)&& varExist('filter_question_value', $request) ){
            // SELECT * FROM `users` WHERE `questions` LIKE '%\"relocation\":\"yes\"%' ORDER BY `id` DESC
            $question_like =  '%\"'. $request->filter_question.'\":\"'. $request->filter_question_value.'\"%';
            $query = $query->where('questions', 'LIKE', $question_like);
        }


        // ================================================ Filter by industry status. ================================================

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


        // ================================================ Filter by qualification. ================================================

        if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
        if(!empty($qualifications)){
            $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                $query2->whereIn('qualifications.id', $qualifications);
                // $query->where('jobseeker.id', 1);
                // dd($query->toSql());
                return $query2;
            });
        }

        // ================================================ Filter by Tags. ================================================

        $tags = $request->filter_tags;
        if(!empty($tags)){
            $query->whereHas('user_tags', function($query2) use($tags) {
                $query2->whereIn('tags.id', $tags);
                return $query2;
            });
        }

        // ================================================ filter by cv keyword ================================================

        $resume_filter = $request->filter_by_resume_value;
        if(!empty($resume_filter)){
            $query->whereHas('cvDataTagsRelation', function($query3) use($resume_filter) {
                $query3->where('cv_data.data_text','like', '%'.$resume_filter.'%');
                return $query3;
            });
        }

        // ================================================ Filter by Tags ================================================

        // $filter_tags = $request->filter_tags;
        // // dd($filter_tags);
        // if(!empty($filter_tags)){
        //     $query->whereHas('tags', function($query3) use($filter_tags) {
        //         $abcd = $query3->where('tags.id','like', '%'.$filter_tags.'%');
        //         dd($abcd);
        //         return $query3;
        //     });
        // }

                

        // DB::enableQueryLog();
        // print_r( $query->toSql() );exit;
        $jobSeekers =  $query->paginate(10);
        // $jobSeekers =  $query->get();


         // dd(DB::getQueryLog());
         
        // dd(DB::getQueryLog());

        // return $data;



        $data['likeUsers'] = $likeUsers;
        $data['jobSeekers'] = $jobSeekers;
		return view('mobile.employer.jobSeekers.list', $data); // mobile/employer/jobSeekers/list
	}


	//====================================================================================================================================//
    // Get // layout for swiping of jobSeekers on mobile.
    //====================================================================================================================================//

    public function mSwipeJobseekers(Request $request){

		$user = Auth::user();
		if (!isEmployer($user)){ return redirect(route('jobs')); }

		if ($user->employerStatus != 'paid') {
			return redirect(route('MjobSeekers'));
		}

        // // =========================================== Paid employer viewing jobseeker ===========================================
        // $isallowed = False;
        // if ($user->employerStatus == 'paid') {
        //     $empExpDate = $user->emp_status_exp;
        //     $currentDate = Carbon::now();
        //     $datetime1 = new DateTime($empExpDate);
        //     $datetime2 = new DateTime($currentDate);
        //     // $interval = $datetime1->diff($datetime2);
        //     // dd($interval);
        //     if ($datetime1 >= $datetime2) {
        //         $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
        //         $isallowed = True;
        //         $data['attachments'] = $attachments;
        //     }
        //     else{
        //         $isallowed = False;
        //         $user->employerStatus = 'unpaid';
        //         $user->save();
        //     }

        // }

        // // =========================================== Paid employer viewing jobseeker ===========================================
        // $data['isallowed'] = $isallowed;
		$data['user']           = $user;
		$data['title']          = 'Job Seekers';
		$data['classes_body']   = 'jobSeekers';
		$jobSeekersObj          = new User();
		$jobSeekers             = $jobSeekersObj->swipeJobseeker($request, $user);
		$likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
		$data['likeUsers'] = $likeUsers;
		return view('mobile.employer.jobSeekers.swipe_jobseeker', $data);
	 	// mobile/employer/jobSeekers/swipe_jobseeker
	}

 	



	//====================================================================================================================================//
    // Swiping Jobseeker's Filter on mobile
    //====================================================================================================================================//

	public function swipeJobSeekersFilter(Request $request){

        // dd($request->toArray());

		$user = Auth::user();
        if (!isEmployer($user)){
            return response()->json([
                'status' => 0,
                'error' => 'You are not allwoed to access this information',
            ]);
        }

         $data['user']           = $user;
    
        // ================================================ Filter by Industry. ================================================

        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;
        $qualification_type = $request->filter_qualification_type; 
        $qualifications = $request->ja_filter_qualification;

        $likeUsers = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        $query = User::with('profileImage','user_tags')->where('type','user')->Where('step2' , '>=' , '7');
        // $tagsQuery = Tags::get();
        if(!empty($block)){
            $query = $query->whereNotIn('id', $block);
        }


        // ================================================ Filter by salaryRange. ================================================

        // dd($request->filter_salary);
        if (isset($request->filter_salary) && !empty($request->filter_salary)){
            $query = $query->where('salaryRange', $request->filter_salary);
        }

        // ================================================ Filter by google map location radius.================================================

        if (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on')){
            if( isset($request->location_lat) && isset($request->location_long)){
                // $query =  $query->findByLatLongRadius($data, $request->location_lat, $request->location_long, $request->filter_location_radius);

            	// dd($request->location_lat);
        		$latitude = $request->location_lat;
	            $longitude = $request->location_long;
            	if (isset($request->filter_location_radius)) {
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
            		// code...
            	}

            	else{
            		
            		$query = $query->selectRaw("*,
	                     ( 6371 * acos( cos(radians('".$latitude."'))
	                     * cos( radians(location_lat))
	                     * cos( radians(location_long) - radians('".$longitude."'))
	                     + sin( radians('".$latitude."'))
	                     * sin( radians( location_lat )))
	                     ) AS distance")
	                ->orderBy("distance",'desc');
            	}
                



            }
        }


        // ================================================ Filter by Age brackets.================================================

        if (isset($request->filter_by_age)) {
        	// dd(' Value  ');
            $age = $request->filter_by_age;
            // dd($age);
        	if ($age == '18-25') {
                $query = $query->whereBetween('age',  [18,25]);
                // dd($query->toSql());
            }
            elseif($age == '25-30'){
                $query = $query->whereBetween('age',  [25,30]);
            }
            elseif($age == '30-40'){
                $query = $query->whereBetween('age',  [30,40]);
            }
            elseif($age == '40-54'){
                $query = $query->whereBetween('age',  [40,54]);
            }
            else{
                $query = $query->where('age', '>=', '55');
            }
        	// code...
        }

        // ================================================ Filter by Age gender.================================================


        if (isset($request->filter_by_gender)) {
        	$gender = $request->filter_by_gender;
        	// dd($gender);
            if ($gender == 'male') {
                $query = $query->where('title','Mr');
            }
            else{
                $query = $query->whereIn('title' , array("Mrs","Miss","Ms"));
            }
        }

        // ================================================ Filter by Keyword filter_keyword ================================================

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

        // ================================================ Filter by Questions ================================================

        if(varExist('filter_qualification_type', $request)){
            $query = $query->where('qualificationType', '=', $request->filter_qualification_type);
        }

        // ================================================ Filter by Question ================================================

        if(varExist('filter_question', $request) &&varExist('filter_by_questions', $request)&& varExist('filter_question_value', $request) ){
            // SELECT * FROM `users` WHERE `questions` LIKE '%\"relocation\":\"yes\"%' ORDER BY `id` DESC
            $question_like =  '%\"'. $request->filter_question.'\":\"'. $request->filter_question_value.'\"%';
            $query = $query->where('questions', 'LIKE', $question_like);
        }


        // ================================================ Filter by industry status. ================================================

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


        // ================================================ Filter by qualification. ================================================

        if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
        // dd($qualifications);
        if(!empty($qualifications)){
            $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                $query2->whereIn('qualifications.id', $qualifications);
                // $query->where('jobseeker.id', 1);
                // dd($query->toSql());
                return $query2;
            });
        }

            
        // DB::enableQueryLog();
        // print_r( $query->toSql() );exit;
        $jobSeekers =  $query->get();
        $data['likeUsers'] = $likeUsers;
        $data['jobSeekers'] = $jobSeekers;
		return view('mobile.employer.jobSeekers.swipe_jobseekerList', $data); // mobile/employer/jobSeekers/swipe_jobseekerList
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
    // Employer jobs edit on mobile
    //====================================================================================================================================//
    
    public function MemployerJobsedit($id){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Job Edit';
        $data['salaryRange'] = getSalariesRange();
        $onlineTest = OnlineTest::get();

        $data['classes_body'] = 'edit';
        $job = Jobs::where('id',$id)->first();
        $data['job'] = $job;
        $data['location'] = $job->city.' '.$job->state.' ,'.$job->country;
        $data['industriesList'] = getIndustries();


        $data['onlineTest'] = $onlineTest;

        return view('mobile.jobs.edit', $data);   //  mobile
        // mobile/jobs/edit
    }

    public function updateJob($job_id, Request $request){
        $user = Auth::user();
        $requestData = $request->all();
        //foreach ($requestData as $rk => $rv) { $requestData[$rk] = my_sanitize_string($rv); }
        if(!empty($requestData['jq'])){
            foreach ($requestData['jq'] as $jqk => $jqv) {
                $requestData['jq'][$jqk]['title'] = my_sanitize_string($jqv['title']);
                if(!empty($jqv['option'])){
                    foreach ($jqv['option'] as $jqok => $jqov) {
                        $requestData['jq'][$jqk]['option'][$jqok]['text'] = my_sanitize_string($requestData['jq'][$jqk]['option'][$jqok]['text']);
                    }
                }
            }
        }	
        $rules = array(
            "title" => "required|string|max:255",
            "description" => "required|string",
            "type"  => "required|string|max:10",
            "vacancies"  => "integer",
            "salary"  => "string|max:255",
        );
        $validator = Validator::make( $requestData , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }else{
            // dd(' all valiation correct ');
            $job = Jobs::where('id',$job_id)->first();
            if ($job->user_id != $user->id){
                return response()->json([
                    'status' => 0,
                    'error' => 'You are not allowed to edit this job'
                ]);
            }else{
                $job->title =  $requestData['title'];
                $job->description =  $requestData['description'];
                if(!empty($request->industry_experience)){
                    $job->experience = json_encode(array_unique($request->industry_experience));
                }
                $job->type =  $requestData['type'];
                $job->country =  $requestData['location_country'];
                $job->state =  $requestData['location_state'];
                $job->city =  $requestData['location_city'];
                $job->location_lat =  $requestData['location_lat'];
                $job->location_long =  $requestData['location_long'];
                $job->vacancies =  $requestData['vacancies'];
                $job->salary =  $requestData['salary'];
                $job->user_id =  $user->id;
                // $expiration =

                $job->expiration =  $requestData['expiration'].' 00:00:00';
                $job->questions()->delete();
                if(!empty($requestData['jq'])){
                $job->addJobQuestions($requestData['jq']);
                }

                if ($requestData['test_id'] != 0) {
                    $test = $requestData['test_id'];
                    $onlineTest = OnlineTest::get()->pluck('id')->toArray();
                    if (in_array($test, $onlineTest)) {
                        // dd('Hi how are you');
                        $job->onlineTest_id = $test;

                    }
                }
                
                $job->save();
                return response()->json([
                    'status' => 1,
                    'message' => '<h3>Job Succesfully Created.</h3><p>Click here to view job detail</p>',
                    'redirect' => route('MemployerJobs')
                ]);
            }
        }

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
    public function MjobSeekersInfo($jobSeekerId){
    	$user = Auth::user();
        if (!isEmployer($user)){ return redirect(route('jobSeekers')); }
       	$userquestion = getUserRegisterQuestions();
       	$data['userquestion'] = $userquestion;
        $data['user'] = $user;
        $jobSeeker = User::JobSeeker()->where('id',$jobSeekerId)->first();
        $isallowed = False;


        // =========================================== Paid employer viewing jobseeker ===========================================

        if ($user->employerStatus == 'paid') {
            $empExpDate = $user->emp_status_exp;
            $currentDate = Carbon::now();
            $datetime1 = new DateTime($empExpDate);
            $datetime2 = new DateTime($currentDate);
            // $interval = $datetime1->diff($datetime2);
            // dd($interval);
            if ($datetime1 >= $datetime2) {
                $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
                $isallowed = True;
                $data['attachments'] = $attachments;
            }
            else{
                $isallowed = False;
                $user->employerStatus = 'unpaid';
                $user->save();
            }

        }
        
        // foreach($user->users as $us){
        //     if($us->id == $jobSeeker->id){
        //         $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
        //         $isallowed = True;
        //         $data['attachments'] = $attachments;
        //     }
        // }

        // check if jobseeker not exist then redirect to jobseeker list.
        if(empty($jobSeeker) || isEmployer($jobSeeker) ){ return redirect(route('jobSeekers')); }
       	if(hasBlockYou($user, $jobSeeker)){ return view('unauthorized', $data); }

        // $jobs                = Jobs::where('user_id',$employerId)->get();
        $galleries    = UserGallery::Public()->Active()->where('user_id',$jobSeekerId)->get();
        $videos      = Video::where('user_id', $jobSeekerId)->get();
        $interview_booking = Interviews_booking::where('email',$jobSeeker->email)->get();
        $UserInterview = UserInterview::where('user_id', $jobSeeker->id)->get(); 
        $interviewTemplate = InterviewTemplate::get();

        $data['title']          = 'JobSeeker Info';
        $data['classes_body']   = 'jobSeekerInfo';
        $data['jobSeeker']       = $jobSeeker;
        $data['likeUsers']       = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['isallowed'] = $isallowed;
        $data['galleries']        = $galleries;
        $data['videos']          = $videos;
        $data['qualificationList'] = getQualificationsList();
        $data['crossreference'] = crossreference::where('jobseekerId', $jobSeekerId)->where('refStatus','Reference Completed')->get();
        $data['UserInterview'] = $UserInterview;
        $data['interviewTemplate'] = $interviewTemplate;
        $data['interview_booking'] = $interview_booking;

        return view('mobile.employer.jobSeekers.jobseekersInfo', $data);

        // mobile/employer/jobSeekers/jobseekersInfo

    }


    public function purchaseUserInfo(Request $request)
    {
        //  dd($request->toArray());
        $user = Auth::user();
        $user_id = $request->user_id;

        if (!empty($user_id)) {

            if($user->credit-10 >= 0){
                $user->users()->attach($user_id, ['type'=> 'User info purchased', 'status'=> 1]);
                $user->credit = $user->credit-10;
                $user->save();
                $output = array(
                    'status' => '1',
                    'message' => 'User info purchased.'
                );
            }
            else{
                $output = array(
                    'status' => '2',
                    'message' => 'Not Enough credit'
                );

            }

            return response()->json($output);
        }
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
        $job = Jobs::with('questions')->find($job_id);
        $data['job'] = $job;

        if ($job->onlineTest_id != null) {
            $onlineTest = $job->onlineTest;
            $data['onlineTest'] = $onlineTest;
            $duration = $onlineTest->time;
            $data['duration'] = $duration;
            $UserOnlineTest = UserOnlineTest::where('test_id' ,$job->onlineTest_id )->where('user_id' , $user->id)->where('status','complete' )->first();
            // dd($UserOnlineTest);
            $data['UserOnlineTest'] = $UserOnlineTest;

        }

        return view('mobile.jobs.applyInfo', $data); // mobile/jobs/applyInfo

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
            $newJobApplication->save();

            $history = new History;
            $history->user_id = $user->id; 
            $history->type = 'Job Applied'; 
            $history->job_id = $job->id; 
            $history->save();

            // if jobApplication is succesfully added then add job answers.
            if( $newJobApplication->id > 0 ){

                if(isset($requestData['answer']) && !empty($requestData['answer'])){
                    foreach ($requestData['answer'] as $ansK => $ansV) {
                        // $requestData['answer'][$ansK]['question_id'] = my_sanitize_number($ansV['question_id']);
                        // $requestData['answer'][$ansK]['option'] = my_sanitize_string($ansV['option']);

                        $jobQuestion = JobsQuestions::find($ansV['question_id']);
                        $goldstar = 0;
                        $preffer = 0;

                        // check if jqb question exist
                        if(!empty($jobQuestion)){
                            // get the goldstar and preffer option
                            // $goldstar = !empty($jobQuestion->goldstar)?(json_decode($jobQuestion->goldstar, true)):(array());
                            // $preffer  = !empty($jobQuestion->preffer)?(json_decode($jobQuestion->preffer, true)):(array());
                        $key = array_search($ansV['option'], $jobQuestion->options);

                        foreach ($jobQuestion->preffer as $preferQ) {
                            if($preferQ == $key){
                                $preffer +=1;
                            }
                        }

                        foreach ($jobQuestion->goldstar as $goldstarQ) {
                            if($goldstarQ == $key){
                                $goldstar +=1;
                            }
                        }

                            // $goldstar = array();
                            // if(!empty($jobQuestion->goldstar)){
                            //     if(!is_array($jobQuestion->goldstar)){
                            //        $goldstar = json_decode($jobQuestion->goldstar, true);
                            //     }else{
                            //        $goldstar =  $jobQuestion->goldstar;
                            //     }
                            // }

                            // $preffer = array();
                            // if(!empty($jobQuestion->preffer)){
                            //     if(!is_array($jobQuestion->preffer)){
                            //        $preffer = json_decode($jobQuestion->preffer, true);
                            //     }else{
                            //          $preffer = $jobQuestion->preffer;
                            //     }
                            // }

                            // dump('goldstar', $goldstar);
                            // dump('preffer', $preffer);
                            // dump('ansV', $ansV);
                            $jobAnswer              = new JobsAnswers();
                            $jobAnswer->question_id = $ansV['question_id'];
                            $jobAnswer->user_id     = $user->id;
                            $jobAnswer->answer      = $ansV['option'];

                            $newJobApplication->goldstar += $goldstar;
                            $newJobApplication->preffer += $preffer;
                            $goldstar = 0;
                            $preffer = 0;
                            $newJobApplication->save();
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

    public function updateNewJobIndustryExperience(Request $request){

        // dump($request->tags);
        $user = Auth::user();
        $rules = array(
                'industry_experience'    => 'required|array',
                'industry_experience.*'  => 'string|max:100'
        );
        $validator = Validator::make($request->all(), $rules);
        // dd( $validator->errors() );
        if (!$validator->fails()) {
            //$user->industry_experience = $request->industry_experience;
            // $array = array_unique (array_merge ($user->industry_experience, $request->industry_experience));
            $industry_experience = array_unique($request->industry_experience);
            $data['industry_experience'] =  $industry_experience;
            $IndustryView = view('site.layout.parts.newJobIndustryList', $data);
            $IndustryHtml = $IndustryView->render();
            return response()->json([
                    'status' => 1,
                    'data' => $IndustryHtml
            ]);
        }

        return response()->json([
            'status' => 2,

    ]);
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

        $history = new History;
        $history->user_id = $user->id; 
        $history->type = 'Deleted Job Application'; 
        $history->job_id = $jobApplication->job_id; 
        $history->save();

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

    // =================================================  Delete job Seeker Function ===============================================

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

    //====================================================================================================================================//
    // Get // layout for purchasing Credits.
    //====================================================================================================================================//
    public function Mcredit(){
        $user = Auth::user();
        if(isEmployer($user)){
            $data['title']  = 'Credit';
            $data['user']   =  $user;
            $data['classes_body'] = 'credit';
            return view('mobile.credit.purchase', $data); // mobile/credit/purchase
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
        $user = Auth::user();
        $rules = array(
                'industry_experience'    => 'required|array',
                'industry_experience.*'  => 'string|max:100'
        );
        $validator = Validator::make($request->all(), $rules);
        // dd( $validator->errors() );
        if (!$validator->fails()) {
            $user->industry_experience = array_unique($request->industry_experience);
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

        function MempJobApplications($id){
        $user = Auth::user();
        if(isEmployer($user)){

            $job =  Jobs::find($id);
            $applications    = JobsApplication::with(['job','jobseeker'])->where('job_id',$id)->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
           // $data['applications'] = $applications;

            $UserOnlineTest = UserOnlineTest::where('user_id',$id)->orderBy('created_at', 'desc')->get();
            $data['UserOnlineTest'] = $UserOnlineTest;
            // dump($UserOnlineTest);

            $data['job']   = $job;
            $data['user']   = $user;
            $data['title']  = 'Job Detail';
            $data['classes_body'] = 'jobdetail';
            return view('mobile.employer.jobApplication', $data); // mobile/employer/jobApplication
        }
    }


    function MempJobApplicationsFilter(Request $request){
        $user = Auth::user();
        // dd($request->toArray());

        if(isEmployer($user)){
        
        $applications = new JobsApplication();
            // $applications = $applications->getFilterApplication($request);

        $job_id = $request->job_id;
        $keyword = my_sanitize_string($request->ja_filter_keyword);
        $qualification_type = $request->ja_filter_qualification_type;
        $qualifications = $request->ja_filter_qualification;
        $salaryRange = $request->ja_filter_salary;
        $filter_location =  (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on'))?true:false;
        $filter_location =  (isset($request->filter_location_status) && !empty($request->filter_location_status == 'on'))?true:false;
        $latitude = $request->location_lat;
        $longitude = $request->location_long;
        $radius = $request->filter_location_radius;
        $industry_status = (isset($request->filter_industry_status) && !empty($request->filter_industry_status == 'on'))?true:false;
        $industries = $request->filter_industry;

        $filer_testing = $request->filter_by_test;
        // dd($filer_testing);
        $applications    = $applications->with(['job','jobseeker']);

         if(varExist('job_id', $request)){
            $applications  = $applications->where('jobs_applications.job_id','=',$job_id);
            // dd($applications);
         }


         if( $filter_location ||  !empty($qualification_type) || !empty($salaryRange) || !empty($keyword) || $industry_status ){
                $applications = $applications->whereHas('jobseeker', function ($query) use($filter_location,$latitude,$longitude,$radius,$qualification_type,$salaryRange,$keyword, $qualifications, $industry_status, $industries){
                    // if(!empty($country)){ $query->where('country', '=', $country);  }

                    if(!empty($salaryRange)){ $query->where('salaryRange', '>=', $salaryRange); }
                    if(!empty($qualification_type)){ $query->where('qualificationType', '=', $qualification_type); }
                    if(!empty($keyword)){  $query->where('username', 'LIKE', "%{$keyword}%"); }
                    // Filter by google map location radius.
                    if($filter_location){
                        if(isset($latitude) && isset($longitude)  && isset($radius)){
                            $radius_sign = ($radius <= 50)?'<':'>';
                            // $query = $query->selectRaw("*,
                            $query = $query->selectRaw("
                     ( 6371 * acos( cos(radians('".$latitude."'))
                     * cos( radians(location_lat))
                     * cos( radians(location_long) - radians('".$longitude."'))
                     + sin( radians('".$latitude."'))
                     * sin( radians( location_lat )))
                     ) AS distance")
                        ->having("distance", "<", $radius)
                        ->orderBy("distance",'asc');
                            //->orderBy("distance",'asc');
                        }
                    }

                    // check if specific qualificaton is selected.
                    if(!empty($qualifications)){
                        $query->whereHas('qualificationRelation', function($query2) use($qualifications) {
                            $query2->whereIn('qualifications.id', $qualifications);
                            // $query->where('jobseeker.id', 1);
                            // dd($query->toSql());
                            return $query2;
                        });
                    }


                    // check if industry filter is enabled.
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


                    // dd($query->toSql());
                    return $query;
                });
            }

            //Filter by Question
            if(varExist('filter_by_questions', $request) && ( $request->filter_by_questions == 'on')){
              // dd( $request->filter_question );
              foreach ($request->filter_question as $fqKey => $fqValue) {
                    if(!empty($fqValue)){
                         // dump($fqKey, $fqValue  );
                        $applications = $applications->whereHas('answers', function($q) use($fqKey,$fqValue) {
                            $q->where('question_id', '=',  $fqKey)->where('answer', '=',  $fqValue);
                            return $q;
                        });
                    }
                }
            }


            // $jobs_application = new JobsApplication;

            
            if(varExist('ja_filter_sortBy', $request)){
                // dd($request->ja_filter_sortBy);
                $filter_column = 'goldstar';
                if($request->ja_filter_sortBy == 'all_candidates'){
                    $applications = $applications->orderBy('created_at', 'DESC');
                }else if($request->ja_filter_sortBy == 'goldstars'){
                    $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
                }else if($request->ja_filter_sortBy == 'applied'){
                    $applications  = $applications->where('status','=','applied');
                }else if($request->ja_filter_sortBy == 'inreview'){
                    $applications  = $applications->where('status','=','inreview');
                }else if($request->ja_filter_sortBy == 'interview'){
                    $applications  = $applications->where('status','=','interview');
                }else if($request->ja_filter_sortBy == 'unsuccessful'){
                    $applications  = $applications->where('status','=','unsuccessful');
                }else if($request->ja_filter_sortBy == 'pending'){
                    $applications  = $applications->where('status','=','pending');
                }
            }else{
                $applications = $applications->orderBy('goldstar', 'DESC')->orderBy('preffer', 'DESC');
            }


            // if($filer_testing && !empty($filer_testing)) {
            //     $applications = $applications
            //                     ->join('user_online_tests', 'user_online_tests.id', '=', 'jobs_applications.userOnlineTest_id'); 
            //     $applications->orderBy('user_online_tests.test_result', 'DESC');
            // }

            if($filer_testing && !empty($filer_testing)) {
                $applications = $applications->orderBy('test_result', 'DESC');
            }


            // dd($applications->toSql());
            
            $applications = $applications->get();


    
            $likeUsers              = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
            $data['applications'] = $applications;
            $data['user']       = $user;
            $data['title']      = 'Job Detail';
            $data['likeUsers']  =  $likeUsers;
            $data['classes_body'] = 'jobdetail';

            return view('mobile.employer.jobApplicationList', $data);
            // mobile/employer/jobApplicationList
        }
    }

        //====================================================================================================================================//
    // Get // layout for job application question answer.
    //====================================================================================================================================//
    public function MchangeJobApplicationStatus(Request $request){
        $user = Auth::user();
        if(isEmployer($user)){

            $status         =  $request->status;
            $application_id = (int) $request->application_id;

            if(!empty($status) && !empty($application_id)){
                // check if job application belong to this employer job.
                $jobsApplication = JobsApplication::find($application_id );
                // dd($jobsApplication->job);
                if($jobsApplication){
                    if(!empty($jobsApplication->job) && !empty($jobsApplication->job->user_id) && ($jobsApplication->job->user_id == $user->id)){
                        // check if status is valide.
                        $jobAppStatusArray = jobStatusArray();
                        if(isset($jobAppStatusArray[$status])){
                            $jobsApplication->status =  $status;
                            $jobsApplication->save();

                            // $history = new History;
                            // $history->user_id = $jobsApplication->jobseeker->id; 
                            // $history->job_status = $request->status; 
                            // $history->job_id = $jobsApplication->job->id; 
                            // $history->old_job_status = $oldjobstatus;
                            // $history->type = 'job_Status';
                            // $history->save();

                             return response()->json([
                                'status' => 1,
                                'message' => 'Job Application Status Updated',
                            ]);
                        }
                    }
                }
            }
        }
    }



    public function MjobSeekerInfo($jobSeekerId){
        $user = Auth::user();
        // if not employer then do not allowed him.
        // if (!isEmployer($user)){ return redirect(route('jobSeekers')); }
        $data['user'] = $user;
        $jobSeeker = User::JobSeeker()->where('id',$jobSeekerId)->first();
        $isallowed = False;
        foreach($user->users as $us){
            if($us->id == $jobSeeker->id){
                $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
                $isallowed = True;
                $data['attachments'] = $attachments;

            }

        }

        // check if jobseeker not exist then redirect to jobseeker list.
        if(empty($jobSeeker) || isEmployer($jobSeeker) ){ return redirect(route('jobSeekers')); }
        // check if this employer has not block you.
       if(hasBlockYou($user, $jobSeeker)){ return view('unauthorized', $data); }
        // $jobs                = Jobs::where('user_id',$employerId)->get();
        $galleries    = UserGallery::Public()->Active()->where('user_id',$jobSeekerId)->get();
        $videos      = Video::where('user_id', $jobSeekerId)->get();
        $interview_booking = Interviews_booking::where('email',$jobSeeker->email)->get();
        $data['jobsApplication'] = JobsApplication::with('job')->where('user_id',$jobSeekerId)->get();
        $UserOnlineTest = UserOnlineTest::where('user_id',$jobSeekerId)->orderBy('created_at', 'desc')->get();
        $data['UserOnlineTest'] = $UserOnlineTest;
        $data['title']          = 'JobSeeker Info';
        $data['classes_body']   = 'jobSeekerInfo';
        $data['jobSeeker']       = $jobSeeker;
        $data['likeUsers']       = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $data['isallowed'] = $isallowed;
        $data['galleries']        = $galleries;
        $data['videos']          = $videos;
        $data['qualificationList'] = getQualificationsList();
        $data['interview_booking'] = $interview_booking;
        return view('mobile.employer.jobSeekers.jobseekersInfo', $data);      //  mobile/employer/jobSeekers/jobseekersInfo

    }


    // =============================================== View CS while swiping jobseeker ===============================================

	public function ViewCv(Request $request){
        // dd( $request->toArray() );
        $user = Auth::user();
        $js = (int) $request->id;
        $attachment = Attachment::where('user_id', $js)->first();

        // dd($attachment[1]);
        $data['attachment'] = $attachment;
        // dd($data['attachment']) ;
        $filename = $data['attachment']->name;
        // dd($filename);
        $path = asset('images/user/'.$data['attachment']->file);

        return $path;

        // return view('mobile.employer.jobSeekers.viewCv', $data);
       
    }


	// =============================================== Change Application's Status inreview ===============================================

    public function changeToInReview(Request $request){
        $data = $request->toArray();
        // dd($data);
        $user = Auth::user();
        // $js = (int) $request->id;
        $JobsApplication = JobsApplication::where('id', $data['id'])->first();
        if ($JobsApplication) {
        	if ($JobsApplication->job->jobEmployer->id == $user->id) {
        		$JobsApplication->status = $data['status'];
		        $JobsApplication->save();
		        return response()->json([
		        	'status' => 1,
		        	'message' => 'Status saved successfully',
		        	'jobStatus' => 'In Review'
		        ]);
        	}
        	else{
        		return response()->json([
		        	'status' => 0,
		        	'message' => 'User is not authenticated',

	        	]);
        	}
        	
        }

        else{
        	return response()->json([
	        	'status' => 0,
	        	'message' => 'Job Application does not exist',

        	]);
        }
        
       
    }

	// =============================================== Change Application's Status interview ===============================================

    public function changeToInInterview(Request $request){
        $data = $request->toArray();
        $user = Auth::user();
        $JobsApplication = JobsApplication::where('id', $data['id'])->first();
        if ($JobsApplication) {
        	if ($JobsApplication->job->jobEmployer->id == $user->id) {
        		$JobsApplication->status = $data['status'];
		        $JobsApplication->save();
		        $js_id = $JobsApplication->user_id;
		        $record = LikeUser::where('user_id', $user->id)->where('like',$js_id)->first();
		        if ($record == null) {
		        	$LikeUser = new LikeUser();
		        	$LikeUser->user_id = $user->id;
		        	$LikeUser->like = $js_id;
		        	$LikeUser->save();
		        }
		        return response()->json([
		        	'status' => 1,
		        	'message' => 'Status saved successfully',
		        	'jobStatus' => 'Interview'
		        ]);
        	}
        	else{
        		return response()->json([
		        	'status' => 0,
		        	'message' => 'User is not authenticated',

	        	]);
        	}
        	
        }

        return response()->json([
        	'status' => 0,
        	'message' => 'Job Application does not exist',

        ]);
        
       
    }

	// =============================================== Change Application's Status unsuccessful ===============================================

    public function changeToInUnsuccessfull(Request $request){
        $data = $request->toArray();
        $user = Auth::user();
        $JobsApplication = JobsApplication::where('id', $data['id'])->first();
        // dd($JobsApplication);
        if ($JobsApplication) {
        	if($JobsApplication->job->jobEmployer->id == $user->id){
	        	$JobsApplication->status = $data['status'];
		        $JobsApplication->save();
		        return response()->json([
		        	'status' => 1,
		        	'message' => 'Status saved successfully',
		        	'jobStatus' => 'Unsuccessful'

		        ]);
	        }
	        else{

	        	return response()->json([
		        	'status' => 0,
		        	'message' => 'User is not authenticated',

	        	]);
	        }
        }
        else{
        	return response()->json([
	        	'status' => 0,
	        	'message' => 'Job Application does not exist',

	        ]);
        } 
    }


    // =============================================== Change Application's Status unsuccessful ===============================================

    public function change_status(Request $request, $id){
        $data = $request->toArray();
        // dd($data);
        $user = Auth::user();

        // if ($data['status'] == 'inreview') {
        // 	return response()->json([
	       //  	'status' => 0,
	       //  	'message' => 'Aisy tu ni hota',

	       //  ]);
        // }

        $JobsApplication = JobsApplication::where('id', $id)->first();
        // dd($JobsApplication);
        if ($JobsApplication) {
        	if($JobsApplication->job->jobEmployer->id == $user->id){
	        	$JobsApplication->status = $data['status'];
		        $JobsApplication->save();
		        return response()->json([
		        	'status' => 1,
		        	'message' => 'Status saved successfully',
		        	'jobStatus' => $JobsApplication->status

		        ]);
	        }
	        else{

	        	return response()->json([
		        	'status' => 0,
		        	'message' => 'User is not authenticated',

	        	]);
	        }
        }
        else{
        	return response()->json([
	        	'status' => 0,
	        	'message' => 'Job Application does not exist',

	        ]);
        } 
    }


    //====================================================================================================================================//
    // Ajax POST // Job Apply Submitted with reject test .
    //====================================================================================================================================//
    public function mUserPreviousResult(Request $request){ 
        $user = Auth::user();
        $requestData = $request->all();
        // dd($requestData);
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
            $newJobApplication->save();


            // dd($job->onlineTest->time);
            // =============================================== For useronlineTest  ===============================================

            $UserOnlineTestPrevios = UserOnlineTest::where('test_id' , $request->test_id)->where('user_id' , $user->id)->first();
            // dd($UserOnlineTest);

            $UserOnlineTest = new UserOnlineTest;
            $UserOnlineTest->user_id = $user->id;
            $UserOnlineTest->emp_id = $job->jobEmployer->id;
            $UserOnlineTest->jobApp_id = $newJobApplication->id;
            $UserOnlineTest->test_id = $UserOnlineTestPrevios->test_id;
            $UserOnlineTest->status = 'complete';
            $UserOnlineTest->rem_time = $UserOnlineTestPrevios->rem_time;
            $UserOnlineTest->current_qid = $UserOnlineTestPrevios->current_qid;
            $UserOnlineTest->test_result = $UserOnlineTestPrevios->test_result;
            $UserOnlineTest->save();
            $JobsApplication = JobsApplication::where('id', $newJobApplication->id)->first();
            $JobsApplication->userOnlineTest_id = $UserOnlineTest->id;
            $JobsApplication->save();


            if ($UserOnlineTest->jobApp_id != null) {
                $JobsApplication = JobsApplication::where('id' , $UserOnlineTest->jobApplication->id)->first();
                $JobsApplication->status = 'applied';
                $JobsApplication->test_result = $UserOnlineTest->test_result;
                $JobsApplication->save();
            }

            // =============================================== For useronlineTest end here  ===============================================

            $history = new History;
            $history->user_id = $user->id; 
            $history->type = 'Job Applied'; 
            $history->job_id = $job->id; 
            $history->save();

            // if jobApplication is succesfully added then add job answers.
            if( $newJobApplication->id > 0 ){
                if(isset($requestData['answer']) && !empty($requestData['answer'])){
                    foreach ($requestData['answer'] as $ansK => $ansV) {
                        $jobQuestion = JobsQuestions::find($ansV['question_id']);
                        $goldstar = 0;
                        $preffer = 0;
                        // check if jqb question exist
                        if(!empty($jobQuestion)){
                        $key = array_search($ansV['option'], $jobQuestion->options);
                        foreach ($jobQuestion->preffer as $preferQ) {
                            if($preferQ == $key){
                                $preffer +=1;
                            }
                        }
                        foreach ($jobQuestion->goldstar as $goldstarQ) {
                            if($goldstarQ == $key){
                                $goldstar +=1;
                            }
                        }
                            $jobAnswer              = new JobsAnswers();
                            $jobAnswer->question_id = $ansV['question_id'];
                            $jobAnswer->user_id     = $user->id;
                            $jobAnswer->answer      = $ansV['option'];

                            $newJobApplication->goldstar += $goldstar;
                            $newJobApplication->preffer += $preffer;
                            $goldstar = 0;
                            $preffer = 0;
                            $newJobApplication->save();
                            $newJobApplication->answers()->save($jobAnswer);

                        }

                    }
                }

            }
            $jobQuestion = JobsQuestions::find(164);
            
            $UserOnlineTest = $UserOnlineTest->id;

            if ($newJobApplication) {
                return response()->json([
                    'status' => 1,
                    'message' => 'You Job Application has been submitted succesfully',
                    'userTest_id' => $UserOnlineTest
                ]);
            }
        }

    }


    //====================================================================================================================================//
    // Ajax POST // Job Apply Submitted with reject test .
    //====================================================================================================================================//
    public function mRejectTest(Request $request){ 
        $user = Auth::user();
        $requestData = $request->all();
        // dd($requestData);
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
            if(empty($request->application_description)){
                 return response()->json([
                    'status' => 0,
                    'error' => 'Please answer all mandatory question.'
                ]);
            }

            $newJobApplication = new JobsApplication();
            $newJobApplication->user_id = $user->id;
            $newJobApplication->job_id = $job->id;
            $newJobApplication->status = 'pending';
            $newJobApplication->description = $request->application_description;
            $newJobApplication->save();


            // dd($job->onlineTest->time);
            // =============================================== For useronlineTest  ===============================================


            $UserOnlineTest = new UserOnlineTest;
            $UserOnlineTest->user_id = $user->id;
            $UserOnlineTest->emp_id = $job->jobEmployer->id;
            $UserOnlineTest->jobApp_id = $newJobApplication->id;
            $UserOnlineTest->test_id = $job->onlineTest_id;
            $UserOnlineTest->status = 'pending';
            $UserOnlineTest->rem_time = $job->onlineTest->time;
            $UserOnlineTest->current_qid = 0;
            $UserOnlineTest->test_result = 0;

            $UserOnlineTest->save();

            $JobsApplication = JobsApplication::where('id', $newJobApplication->id)->first();
            
            $JobsApplication->userOnlineTest_id = $UserOnlineTest->id;
            $JobsApplication->save();


            // =============================================== For useronlineTest end here  ===============================================

            $history = new History;
            $history->user_id = $user->id; 
            $history->type = 'Job Applied'; 
            $history->job_id = $job->id; 
            $history->save();

            // if jobApplication is succesfully added then add job answers.
            if( $newJobApplication->id > 0 ){
                if(isset($requestData['answer']) && !empty($requestData['answer'])){
                    foreach ($requestData['answer'] as $ansK => $ansV) {
                        $jobQuestion = JobsQuestions::find($ansV['question_id']);
                        $goldstar = 0;
                        $preffer = 0;
                        // check if jqb question exist
                        if(!empty($jobQuestion)){
                        $key = array_search($ansV['option'], $jobQuestion->options);
                        foreach ($jobQuestion->preffer as $preferQ) {
                            if($preferQ == $key){
                                $preffer +=1;
                            }
                        }
                        foreach ($jobQuestion->goldstar as $goldstarQ) {
                            if($goldstarQ == $key){
                                $goldstar +=1;
                            }
                        }
                            $jobAnswer              = new JobsAnswers();
                            $jobAnswer->question_id = $ansV['question_id'];
                            $jobAnswer->user_id     = $user->id;
                            $jobAnswer->answer      = $ansV['option'];

                            $newJobApplication->goldstar += $goldstar;
                            $newJobApplication->preffer += $preffer;
                            $goldstar = 0;
                            $preffer = 0;
                            $newJobApplication->save();
                            $newJobApplication->answers()->save($jobAnswer);

                        }

                    }
                }

            }
            $jobQuestion = JobsQuestions::find(164);
            
            $UserOnlineTest = $UserOnlineTest->id;

            if ($newJobApplication) {
                return response()->json([
                    'status' => 1,
                    'message' => 'You Job Application has been submitted succesfully',
                    'userTest_id' => $UserOnlineTest
                ]);
            }
        }

    }


    //====================================================================================================================================//
    // Making employer paid.
    //====================================================================================================================================//
    public function mPremiumAccount(){
        $user = Auth::user();
        if(isEmployer($user)){

            $data['title']  = 'Premium Account';
            $data['user']   =  $user;
            // $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();

            $data['classes_body'] = 'credit';
            // $data['controlsession'] = $controlsession;
            return view('mobile.credit.premium_account', $data); // premium_account/credit/premium_account
        }
    }

    public function addNewLoaction(Request $request) {
        $rules = array(
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

            $user = Auth::user();
            $user->location_lat     = $request->location_lat;
            $user->location_long    = $request->location_long;
            if($request->location_name == $request->location_city){
                $user->location = '';
            }
            else{
                $user->location         = $request->location_name;
            }
            $user->country = $request->location_country;
            $user->state = $request->location_state;
            $user->city = $request->location_city;


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


   







}
