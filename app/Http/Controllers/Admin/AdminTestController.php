<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\OnlineTest;
use App\TestQuestion;

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


        public function storeOnlineTest(Request $request){
        $data =  $request->toArray();
        // dd($data);
        
        

        $user = Auth::user();
        // dd($user->id);
        // $data['user'] = $user;
        $data = $request->all();
        // dd($data);
         $this->validate($request, [
            'name' => 'required|max:255',
            'time' => 'required|max:255',
            'question' => 'required|max:255',
        ]);
        // dd($data['question']);
        if(in_array(null, $data['question'], true))
            {
                return response()->json([
                    'status' => 0,
                    'error' =>  "please add all questions"
                ]);
            }
        else{

            $name = $data['time'];
            // dd($name);

            $test = new OnlineTest();
            $test->name = $data['name'];
            $test->time = $data['time'];
            $test->save();
            foreach ($data['question'] as $key => $question) {

                // dd($question['question']);
                $testQuestions = new TestQuestion;
                $testQuestions->test_id =  $test->id;
                $testQuestions->question = $question['question']; 
                $testQuestions->option1 =  $question['option1']; 
                $testQuestions->option2 =  $question['option2']; 
                $testQuestions->option3 =  $question['option3']; 
                $testQuestions->option4 =  $question['option4']; 
                $testQuestions->answer =  $question['answer']; 
                $testQuestions->save();

            }
            // $temp->questions = json_encode($request->questions);
            if( $test->save() ){
                return redirect(route('onlinetest'))->withSuccess( __('admin.record_added_successfully'));
            }
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
            $question->delete();
            return response()->json([
                'status' => 1,
                'message'=> 'Question Deleted Successfully'
            ]); 
        }
    }

    // ============================================================ Delete Question ============================================================

     public function addOnlineTestQuestion(Request $request){
        // dd($request->id);
        $data['qId'] = $request->id;
        return view('admin.online_test.addQuestion' ,$data); //admin/online_test/addQuestion
    }

    // ============================================================ Online Test Update ============================================================

     public function onlineTestUpdate(Request $request,$id){
        // dd($id);
        $data = $request->all();
        dd($data);
        foreach($data['question'] as $key =>$value){
                if(in_array(null, $value, true))
                {
                    return response()->json([
                        'status' => 0,
                        'error' =>  "please complete question"
                    ]);
                }
        }
        $onlineTest = OnlineTest::where('id' , $id)->first();
        $onlineTest->name = $data['name'];
        $onlineTest->time = $data['time'];
        $onlineTest->save();
           foreach ($data['question'] as $question) {
            if (isset($question['id'])) {
                $tempQuestion = TestQuestion::where('id' , $question['id'])->get();
                foreach ($tempQuestion as $tempQ) {
                    // dd($tempQ);
                    $tempQ->question = $question['text'];
                    $tempQ->option1 = $question['option1'];
                    $tempQ->option2 = $question['option2'];
                    $tempQ->option3 = $question['option3'];
                    $tempQ->option4 = $question['option4'];
                    $tempQ->answer = $question['answer'];
                    $tempQuestion->test_id = $id;
                    $tempQ->save();
                }
            }

            else{
                
                $tempQuestion = new TestQuestion;
                $tempQuestion->temp_id = $id;
                $tempQuestion->question = $data['new'];
                $tempQuestion->save();
            }
        }

        if (isset($data['newQuestion'])) {
            foreach ($data['newQuestion'] as $newQuest) {
                // dd($newQuest);
            $tempQuestion = new TestQuestion;
            $tempQuestion->question = $newQuest['question'];
            $tempQuestion->option1 = $newQuest['option1'];
            $tempQuestion->option2 = $newQuest['option2'];
            $tempQuestion->option3 = $newQuest['option3'];
            $tempQuestion->option4 = $newQuest['option4'];
            $tempQuestion->answer = $newQuest['answer'];
            $tempQuestion->test_id = $id;
            $tempQuestion->save();
            }

        }

        return redirect(route('onlinetest'))->withSuccess( __('admin.record_aupdated_successfully'));
 
    }





}
