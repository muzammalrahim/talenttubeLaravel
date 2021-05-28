<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use App\Jobs;
use App\ControlSession;
use App\JobsApplication;
use App\OnlineTest;
use App\UserOnlineTest;
use App\UserOnlineTestAnswers;
use App\TestQuestion;
use App\History;




class OnlineTestController extends Controller
{
    
    public $agent;
    public function __construct(){
		$this->middleware('auth');
		$this->agent = new Agent();
    }

    //====================================================================================================================================//
    // Send online Test
    //====================================================================================================================================//
    function sendOnlineTest(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data = $request->toArray();
        $JobsApplication = JobsApplication::where('id' , $data['jobApp_id'])->first();
        // dd($JobsApplication->onlineTest->time);
        if (isset($JobsApplication)) {
        	$user_id = $JobsApplication->user_id;
        	$UserOnlineTestCheck = UserOnlineTest::where('jobApp_id' , $data['jobApp_id'])
        	// ->where('test_id' , $data['test_id'])
        	->first();
        	if (empty($UserOnlineTestCheck)) {
        		$OnlineTest = OnlineTest::where('id' , $data['test_id'])->first();
        		// $OnlineTest->time;
        		$UserOnlineTest = new UserOnlineTest;
        		$UserOnlineTest->user_id = $user_id;
        		$UserOnlineTest->emp_id = $user->id;
        		$UserOnlineTest->jobApp_id = $data['jobApp_id'];
        		$UserOnlineTest->test_id = $data['test_id'];
        		$UserOnlineTest->status = 'pending';
        		$UserOnlineTest->rem_time = $OnlineTest->time;
        		$UserOnlineTest->current_qid = 0;
        		$UserOnlineTest->save();

        		$history = new History;
                $history->user_id = $UserOnlineTest->user_id; 
                $history->type = 'onlineTest_sent'; 
                $history->userOnlineTest_id = $UserOnlineTest->id; 
                $history->save();

        		return response()->json([
        			'status' => 1,
        			'message'=> 'Online test request has been submitted'
        		]);

        	}
        	else{
        		return response()->json([
        			'status' => 0,
        			'message'=> 'you have already booked this test for this user'
        		]);
        	}
        }
        else{
        	return response()->json([
        		'status' => 2,
        		'message'=> 'Error occured try again later'
        	]);
        }
    }

	//====================================================================================================================================//
    // Send online Test
    //====================================================================================================================================//

    public function mTesting(){
		$user = Auth::user();
        // dd($user->id);
        $data['user'] = $user;
        // $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $UserOnlineTest = UserOnlineTest::where('user_id', $user->id)->orderBy('updated_at' , 'desc')->get();
        // $data['controlsession'] = $controlsession;
        $data['UserOnlineTest'] = $UserOnlineTest;
        $data['title'] = 'Jobs';
        $data['classes_body'] = 'tests';
        $data['tests'] = null; //Jobs::with(['applicationCount','jobEmployerLogo'])->orderBy('created_at', 'DESC')->get();
        return view('mobile.online_test.index', $data); // mobile/online_test/index

    }

    //===================================================================================================================================
    // Proceed to online Test 
    //===================================================================================================================================

    public function mProceedTesting($id){
		$user = Auth::user();
		// dd($user->id);
        $data['user'] = $user;
        if (!isEmployer($user)) {
        	// $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
	        $UserOnlineTest = UserOnlineTest::where('id', $id)->first();
	        if ($UserOnlineTest->user_id == $user->id) {
	        	if ($UserOnlineTest->status == 'pending' || $UserOnlineTest->status == 'continue' ) {
	        		// $data['controlsession'] = $controlsession;
			        $data['UserOnlineTest'] = $UserOnlineTest;
			        $data['title'] = 'Jobs';
			        $data['classes_body'] = 'tests';
			        $data['tests'] = null; 

			        // dd($UserOnlineTest->jobApplication->id);

                    if(isMobile()){
                        // dd("Good Morning");
                        return view('mobile.online_test.proceedTest', $data); //  mobile/online_test/proceedTest

                    }
                    else{
                        return view('site.onlineTest.proceedTest', $data); //  site/onlineTest/proceedTest
                    }
	        	}
	        	else{
	        		return redirect(route('testing'));
	        	}

	        }
	        else{
	        	return redirect(route('testing'));
	        }
	        
        }
        else{
        	return false;

        }
    }

    //===================================================================================================================================
    // Proceed to online Test
    //===================================================================================================================================

	public function mSaveandNextQuestion(Request $request, $time){
		$user = Auth::user();
		$data = $request->all();
        // dd($data);
	    $UserOnlineTest = UserOnlineTest::where('id', $data['userOnlineTest_id'])->first();
	    // dd($UserOnlineTest);
	    $UserOnlineTest->rem_time = $time;
	    $UserOnlineTest->status = 'continue';
	    $UserOnlineTest->current_qid = $UserOnlineTest->current_qid+1;
	    $UserOnlineTest->save(); 
	    // if ($UserOnlineTest->job_id != null) {
	    // 	$JobsApplication = JobsApplication::where('id' , $UserOnlineTest->jobApplication->id)->first();
		   //  $JobsApplication->status = 'applied';
		   //  $JobsApplication->save();
	    // }

	    if ($UserOnlineTest->user_id == $user->id) {
			$UserOnlineTestAnswers = new UserOnlineTestAnswers();
	    	$UserOnlineTestAnswers->user_id = $user->id;
	    	$UserOnlineTestAnswers->emp_id = $UserOnlineTest->emp_id;
	    	$UserOnlineTestAnswers->userOnlineTest_id = $UserOnlineTest->id;
			$UserOnlineTestAnswers->question_id = $data['qid'];
			$UserOnlineTestAnswers->users_answer = $data['users_answer'];
			$TestQuestion = TestQuestion::where('id' , $data['qid'])->first();
			$UserOnlineTestAnswers->right_answer = $TestQuestion->answer;
			if ($TestQuestion->answer == $data['users_answer']) {
				$UserOnlineTestAnswers->status = 'right';			
			}
			else{
				$UserOnlineTestAnswers->status = 'wrong';			
			}
			$UserOnlineTestAnswers->save();
			$data['UserOnlineTest'] = $UserOnlineTest;
    		return view('mobile.online_test.oneQuestion' ,$data); // mobile/onlineTest/parts/oneQuestion
	    }
	    else{
	    	dd('User is not authenticated');
	    }
	}

	//===================================================================================================================================
    // Proceed to online Test
    //===================================================================================================================================

	public function mSaveTestAndResult(Request $request, $time){
		$user = Auth::user();
		$data = $request->all();
        // dd($data);
	    $UserOnlineTest = UserOnlineTest::where('id', $data['userOnlineTest_id'])->first();
	    $UserOnlineTest->rem_time = $time;
	    $UserOnlineTest->status = 'complete';
	    $UserOnlineTest->current_qid = $UserOnlineTest->current_qid+1;
	    if ($UserOnlineTest->user_id == $user->id) {
			$UserOnlineTestAnswers = new UserOnlineTestAnswers();
	    	$UserOnlineTestAnswers->user_id = $user->id;
	    	$UserOnlineTestAnswers->emp_id = $UserOnlineTest->emp_id;
	    	$UserOnlineTestAnswers->userOnlineTest_id = $UserOnlineTest->id;
			$UserOnlineTestAnswers->question_id = $data['qid'];
			$UserOnlineTestAnswers->users_answer = $data['users_answer'];
			$TestQuestion = TestQuestion::where('id' , $data['qid'])->first();
			$UserOnlineTestAnswers->right_answer = $TestQuestion->answer;
			if ($TestQuestion->answer == $data['users_answer']) {
				$UserOnlineTestAnswers->status = 'right';			
			}
			else{
				$UserOnlineTestAnswers->status = 'wrong';			
			}
			$UserOnlineTestAnswers->save();


	    }
	    else{
	    	dd('User is not authenticated');
	    }

	    $totalAnswers = TestQuestion::where('test_id' , $UserOnlineTest->test_id)->get();
		$count = $totalAnswers->count();
		$rightAnswers = UserOnlineTestAnswers::where('userOnlineTest_id' , $UserOnlineTest->id)->where('status' , 'right')->get();
		$right_count = $rightAnswers->count();
		$persetnages = ceil($right_count *100 / $count);
	    $UserOnlineTest->test_result = $persetnages; 
	    $UserOnlineTest->save();

        if ($UserOnlineTest->jobApp_id != null) {
            $JobsApplication = JobsApplication::where('id' , $UserOnlineTest->jobApplication->id)->first();
            $JobsApplication->status = 'applied';
            $JobsApplication->test_result = $UserOnlineTest->test_result;
            $JobsApplication->save();
        }

	    $history = new History;
        $history->user_id = $UserOnlineTest->user_id; 
        $history->type = 'onlineTest_comp'; 
        $history->userOnlineTest_id = $UserOnlineTest->id; 
        $history->save();


	    return response()->json([
	    	'status' => 1,
	    	'message' => 'Success'
	    ]);
	}

	//===================================================================================================================================
    // Proceed to online Test while applying to job
    //===================================================================================================================================

    public function mJobAppProceedTest($id){
		$user = Auth::user();
        $data['user'] = $user;
        $job = Jobs::find($id);
        $data['job'] = $job;
        $UserOnlineTestCheck = UserOnlineTest::where('user_id' , $user->id)->where('job_id' , $id)->first();
        if (!empty($UserOnlineTestCheck)) {
        	$data['UserOnlineTest'] = $UserOnlineTestCheck;
	        return view('site.jobs.onlineTest.proceedTest' , $data);

        }else{

        	$UserOnlineTest = new UserOnlineTest;
	        $UserOnlineTest->user_id = $user->id;
	        $UserOnlineTest->emp_id = $job->user_id;
	        $UserOnlineTest->test_id = $job->onlineTest_id;
	        $UserOnlineTest->status = 'pending';
	        $UserOnlineTest->rem_time = $job->onlineTest->time .':00';
	        $UserOnlineTest->current_qid = 0;
	        $UserOnlineTest->test_result = 0;
	        $UserOnlineTest->job_id = $job->id;
	        $UserOnlineTest->save();

	        $data['UserOnlineTest'] = $UserOnlineTest;
	        return view('site.jobs.onlineTest.proceedTest' , $data);

        } 

    }


    // ======================================================= completedInterviews =======================================================

    public function mCompletedOnlineTests($id){

        $user = Auth::user();
    	
        if (isAdmin($user)) {
            $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        	$UserOnlineTest = UserOnlineTest::where('user_id',$id)->where('status' , 'complete')->get();
        	$data['UserOnlineTest'] = $UserOnlineTest;
            $data['controlsession'] = $controlsession;
            $data['title'] = 'Online Tests';
            $data['classes_body'] = 'Online Tests';
            $data['user'] = $user;
            $data['id'] = $id;
            return view('site.onlineTest.completedTest', $data);
            // site/onlineTest/completedTest
        }

    }




}
