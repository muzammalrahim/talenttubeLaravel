<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\OnlineTest;
use App\TestQuestion;
use App\UserOnlineTestAnswers;
use App\InterviewTemplate;
use App\UserOnlineTest;
use App\JobsApplication;
use App\History;

class AdminTestController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    // use AuthenticatesUsers;

    // ========================================= Iteration-9 Online Test =========================================

    public function onlinetest(Request $request) {
    	// dd($request);
        $data['title'] = 'Online Test';
        $data['content_header'] = 'Online Test';
        // $data['content_header'] = 'Test';
        // $data['jobStatusArray'] = jobStatusArray();
        return view('admin.online_test.index', $data); // admin/online_test/index
    }

    // =================================================== Talent Pool Data table iteration-8 ===================================================
    
    public function onlineTestDataTable(Request $request){
      $records = array();
      $records = OnlineTest::select(['id', 'name','time','created_at'])
        // ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      // ->editColumn('created_at', function ($request) {
      //   return $request->created_at->format('Y-m-d'); // human readable format
      // })

      ->addColumn('action', function ($records) {
        if (isAdmin()){
                $rhtml = ' <a  href = " '.route('onlineTestEdit',['id'=>$records->id]).'" value = "'.$records->id.'" class="btn btn-primary ViewPool" > View Test</a>';

                $rhtml .= ' <i value = "'.$records->id.'" class="fas fa-trash text-danger pointer ml-3 test_id" data-toggle="modal" data-target="#deletTestModal"></i>';
            return $rhtml;
        }
      })
      
      ->rawColumns(['action'])
      ->toJson();

    }

    // ========================================= Iteration-9 create Online Test =========================================

    public function onlineTestCreate(Request $request) {
    	// dd($request);
        $data['title'] = 'Online Test';
        $data['record']   = FALSE;
        $data['content_header'] = 'Online Test';
        return view('admin.online_test.create', $data); 
        // admin/online_test/create  

    }

    // ========================================= Iteration-9 Store Online Test =========================================


    public function storeOnlineTest(Request $request){
        $data =  $request->toArray();
        $user = Auth::user();
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required|max:255',
            'time' => 'digits_between:2,5',
            'question.*.question' => 'required|max:255',
            'question.*.option1' => 'required|max:255',
            'question.*.option2' => 'required|max:255',
            'question.*.option3' => 'required|max:255',
            'question.*.option4' => 'required|max:255',
            'question.*.questionImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name = $data['time'];
        $test = new OnlineTest();
        $test->name = $data['name'];
        $test->time = $data['time'] . ':00';
        $test->save();
        foreach ($data['question'] as $key => $question) {
            $testQuestions = new TestQuestion;
            $testQuestions->test_id =  $test->id;
            $testQuestions->question = $question['question']; 
            $testQuestions->option1 =  $question['option1']; 
            $testQuestions->option2 =  $question['option2']; 
            $testQuestions->option3 =  $question['option3']; 
            $testQuestions->option4 =  $question['option4']; 
            $testQuestions->answer =  $question['answer']; 
            if (isset($question['questionImage'])) {
                // =========================================================== For uploading image ===========================================================
                $user = Auth::user();
                $image = $question['questionImage'];
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $file_path   = '/onlineTest/'.$fileName;
                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                $img = Image::make($image->getRealPath());
                $img->stream();
                Storage::disk('publicMedia')->put($file_path, $img, 'public');
                $testQuestions->image_name = $fileName;
                $testQuestions->image_path = $file_path;
                // =========================================================== For uploading image ===========================================================
            }
            $testQuestions->save();
        }
        if( $test->save() ){
            return redirect(route('onlinetest'))->withSuccess( __('admin.record_added_successfully'));
        }
    }

    // =================================================== Online test Edit layout iteration-9 ===================================================


    public function onlineTestEdit($id) {
        $UserPool = OnlineTest::where('id' , $id)->first();
        if ($UserPool) {
            $data['record'] = $UserPool;
            $data['id'] = $id;
            $data['title'] = $UserPool->name;
            $data['content_header'] = $UserPool->name;
            return view('admin.online_test.edit', $data); // admin/online_test/edit
        }

        
    }

    // ============================================================ Delete Question ============================================================

     public function testQuestionDelete(Request $request){
        // dd($request->id);
        $question = TestQuestion::where('id' , $request->id)->where('test_id' , $request->test_id)->first();
        // dd($question);
        if ($question) {
            if (isset($question->image_path)) {
                $imgPath = ('/public').'/onlineTest/'.$question->image_name;
                // dd($imgPath);
                Storage::disk('media')->delete($imgPath);
                // Storage::disk('media')->delete($imgPath);
            }
            $question->delete();

            return response()->json([
                'status' => 1,
                'message'=> 'Question Deleted Successfully'
            ]); 
        }
    }

    // ============================================================ Add Onlien test question ============================================================

     public function addOnlineTestQuestion(Request $request){
        // dd($request->id);
        $data['qId'] = $request->id;
        return view('admin.online_test.addQuestion' ,$data); //admin/online_test/addQuestion
    }

    // ============================================================ Online Test Update ============================================================

     public function onlineTestUpdate(Request $request,$id){
        // dd($id);
        $data = $request->all();
        // dd($data);

        // ========================================== Validation =============================

        $user = Auth::user();
     
        $this->validate($request, [
            'name' => 'required|max:255',
            'time' => 'digits_between:2,5',
            'question.*.question' => 'required|max:255',
            'question.*.option1' => 'required|max:255',
            'question.*.option2' => 'required|max:255',
            'question.*.option3' => 'required|max:255',
            'question.*.option4' => 'required|max:255',
            // 'newQuestion.*.questionImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (isset($data['newQuestion'])) {

            $this->validate($request, [
            'name' => 'required|max:255',
            'time' => 'digits_between:2,5',
            'newQuestion.*.question' => 'required|max:255',
            'newQuestion.*.option1' => 'required|max:255',
            'newQuestion.*.option2' => 'required|max:255',
            'newQuestion.*.option3' => 'required|max:255',
            'newQuestion.*.option4' => 'required|max:255',
            'newQuestion.*.questionImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

             
        }

        // ========================================== Validation =============================

        
        $onlineTest = OnlineTest::where('id' , $id)->first();
        $onlineTest->name = $data['name'];
        $onlineTest->time = $data['time'];
        $onlineTest->save();

        if (isset($data['question'])) {
            
            foreach ($data['question'] as $question) {
            // if (isset($question['id'])) {
                $testQuestion = TestQuestion::where('id' , $question['id'])->get();
                foreach ($testQuestion as $testQues) {
                    // dd($testQues);
                    $testQues->question = $question['question'];
                    $testQues->option1 = $question['option1'];
                    $testQues->option2 = $question['option2'];
                    $testQues->option3 = $question['option3'];
                    $testQues->option4 = $question['option4'];
                    $testQues->answer = $question['answer'];
                    $testQuestion->test_id = $id;

                    // =========================================================== For uploading image ===========================================================
                    if (isset($question['questionImage'])) {

                    $image = $question['questionImage'];
                    $fileName   = time() . '.' . $image->getClientOriginalExtension();
                    // $file_thumb  = '/onlineTest/images/'.$fileName;
                    $file_path   = '/onlineTest/'.$fileName;
                    $img = Image::make($image->getRealPath());
                    $img->resize(120, 120, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream();
                    // Storage::disk('publicMedia')->put( $file_thumb , $img);
                    $img = Image::make($image->getRealPath());
                    $img->stream();
                    Storage::disk('publicMedia')->put($file_path, $img, 'public');
                    // dd($fileName);

                    $testQues->image_name = $fileName;
                    $testQues->image_path = $file_path;
        
                    }

                    // =========================================================== For uploading image ===========================================================
                    

                    $testQues->save();
                }
            }
        }
           

        if (isset($data['newQuestion'])) {
            foreach ($data['newQuestion'] as $newQuest) {
            $testQuestion = new TestQuestion;
            $testQuestion->question = $newQuest['question'];
            $testQuestion->option1 = $newQuest['option1'];
            $testQuestion->option2 = $newQuest['option2'];
            $testQuestion->option3 = $newQuest['option3'];
            $testQuestion->option4 = $newQuest['option4'];
            $testQuestion->answer = $newQuest['answer'];
            $testQuestion->test_id = $id;


            if (isset($newQuest['questionImage'])) {
                // =========================================================== For uploading image ===========================================================

                // $user = Auth::user();
                $image = $newQuest['questionImage'];
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                // $file_thumb  = '/onlineTest/images/'.$fileName;
                $file_path   = '/onlineTest/'.$fileName;
                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                // Storage::disk('publicMedia')->put( $file_thumb , $img);
                $img = Image::make($image->getRealPath());
                $img->stream();
                Storage::disk('publicMedia')->put($file_path, $img, 'public');
                // dd($fileName);
                $testQuestion->image_name = $fileName;
                $testQuestion->image_path = $file_path;

                // =========================================================== For uploading image ===========================================================
            }

            $testQuestion->save();
            }

        }
                
                      
        return redirect(route('onlinetest'))->withSuccess( __('admin.record_updated_successfully'));
 
    }


    // ============================================================ Bulk testing ============================================================

    public function bulkTesting(Request $request){
        $data = $request->toArray();
        $user_ids = array();
        foreach ($data['cbx'] as $key => $value) {
            array_push($user_ids, $value);
        }
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Testing';
        $data['content_header'] = 'Bulk Testing';
        $data['classes_body'] = 'Bulk Testing';
        $data['record'] = null;
        $data['user_ids'] = $user_ids;
        $onlineTestTemplate = OnlineTest::get();
        $data['onlineTestTemplate'] = $onlineTestTemplate;
        $data['jobSeekers'] = User::whereIn('id',$user_ids)->get();
        return view('admin.candidate_tracking.bulkTesting.bulk_Testing', $data);
        // admin/candidate_tracking/bulkTesting/bulk_Testing

    }

    // ============================================================ Bulk testing ============================================================

    public function bulkTestingJobApp(Request $request){
        
      // dd($request->cbx);


        if(!empty($request->cbx)){

        $userIDs = array();
        $jobApp_id = array();
        $jobApplications = JobsApplication::whereIn('id',$request->cbx)->get();
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Testing';
        $data['content_header'] = 'Bulk Testing';
        $data['classes_body'] = 'bulkTesting';
        $data['record'] = null;
        $data['user_ids'] = $userIDs;
        $data['jobApplications'] = $jobApplications;
        $onlineTestTemplate = OnlineTest::get();
        $data['onlineTestTemplate'] = $onlineTestTemplate;
        $data['jobSeekers'] = User::whereIn('id',$userIDs)->get();
        return view('admin.candidate_tracking.bulkTesting.bulk_TestJobAppTemplate', $data);


        }


        // admin/candidate_tracking/bulkTesting/bulk_Testing

    }


    // ============================================================ Bulk Interview Template ============================================================

    public function bulkTestView(Request $request){
    // dd($request->toArray());
    $user = Auth::user();
    if (!isEmployer($user) && (!isAdmin())){ return redirect(route('profile')); }
    if ($request->templateSelect != 0) {
        $onlineTestTemplate = OnlineTest::where('id',$request->templateSelect)->first();
        if (!empty($onlineTestTemplate)) {
        // dd($onlineTestTemplate->id);
        $data['onlineTestTemplate'] = $onlineTestTemplate;
        // $data['InterviewTempQuestion'] = $InterviewTempQuestion;
            if (isAdmin()) {
                return view('admin.candidate_tracking.bulkTesting.bulk_TestingTemplate' , $data); 
                // admin/candidate_tracking/bulkTesting/bulk_TestingTemplate

            }
            else{

                return false;

            }
        }
    }
    else{
        return false;
    }
    

}


// ============================================================ Bulk interview send ============================================================

    public function bulkTestSend(Request $request){

        $user = Auth::user();

        $data = $request->toArray();
        // dd($data);
        foreach ($data['user'] as $key => $value) {
            $OnlineTest = OnlineTest::where('id' , $data['test_id'])->first();
            $UserOnlineTest = new UserOnlineTest;
            $UserOnlineTest->user_id = $value;
            $UserOnlineTest->emp_id = $user->id;
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
        }

        return response()->json([
            'status' => 1,
            'message' => 'Online Test Sent Successfully'
        ]); 

    }

    // ============================================================ Bulk interview send ============================================================

    public function bulkTestJobAppSend(Request $request){

        $user = Auth::user();

        $data = $request->toArray();
        // dd($data);
        foreach ($data['jobApp_id'] as $key => $value) {
            $OnlineTest = OnlineTest::where('id' , $data['test_id'])->first();
            $UserOnlineTest = new UserOnlineTest;
            $UserOnlineTest->user_id = $key;
            $UserOnlineTest->emp_id = $user->id;
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
        }

        return response()->json([
            'status' => 1,
            'message' => 'Online Test Sent Successfully'
        ]); 

    }


     // ===================================================== Get Job Application for admin iteration-8 =====================================================

    public function getOnlineTestJobApplications(Request $request){
        // dd($request->id);
        if (isAdmin()) {

            $JobsApplication = JobsApplication::where('id' , $request->id)->first();
            // dd($JobsApplication->user_id);
            $UserOnlineTest = UserOnlineTest::where('user_id' , $JobsApplication->user_id)->where('status' , 'complete')->get();
            $data['UserOnlineTest'] = $UserOnlineTest; 
            return view('admin.job_applications.onlineTests.selectOnlineTest' , $data);  
            /* admin/job_applications/onlineTests/selectOnlineTest */
        }

    }


    // ===================================================== Delete Online Test iteration-11 =====================================================

    public function deleteOnlineTest(Request $request){
        // dd($request->id);
        if (isAdmin()) {
            $OnlineTest = OnlineTest::where('id' , $request->id)->first();
            $OnlineTest->delete();
            $testQuestion = TestQuestion::where('test_id', $request->id)->get();
            foreach ($testQuestion as $testQuest) {
                $userOnlineTestAnswers = UserOnlineTestAnswers::where('question_id', $testQuest->id)->first();
                if ($userOnlineTestAnswers != null) {
                    $userOnlineTestAnswers->delete();
                }

                $testQuest->delete();
            }
            $UserOnlineTest = UserOnlineTest::where('test_id',$OnlineTest->id)->get();
            foreach ($UserOnlineTest as $test) {
                $test->delete();
            }
        }


        
    

    }












}
