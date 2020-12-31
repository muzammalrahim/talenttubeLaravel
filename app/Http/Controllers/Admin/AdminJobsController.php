<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Jobs;
use App\JobsApplication;
use App\User;
use App\JobsAnswers;
use App\JobsQuestions;
use App\Exports\JobApplicationExport;
use App\Exports\JobAllApplicationExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\UserGallery;
use Yajra\Datatables\Datatables;
// use Illuminate\Support\Facades\Hash;
use PDF;

class AdminJobsController extends Controller
{

    use AuthenticatesUsers;

    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function index() {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin() ) {
                return redirect()->route('adminDashboard');
            }else{
                return redirect()->route('homepage');
            }
        }

        $data['title'] = 'Page Title';
        $data['content_header'] = 'Content Header';
        $data['content'] = 'this is page content';
        $view_name = 'admin.login';
        return view($view_name, $data);
    }

    protected function authenticated(Request $request, $user) {
        if ( $user->isAdmin() ) {
            return redirect()->route('adminDashboard');
        }else{
            return redirect()->route('homePage');
        }
    }

    //============================================================================================================//
    public function jobs(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Jobs';
        $data['content_header'] = 'Jobs';
        $data['classes_body'] = 'jobs';
        $data['jobs'] = Jobs::with('applicationCount')->get();

        // dd($data);

       return view('admin.jobs.list', $data);  // admin/jobs/list
    }


    //===============================================================================================================//
    // Ajax GET // Jobs list for dataTable
    //===============================================================================================================//
    function getDatatable(){
         $records = Jobs::select(['id', 'title','country','state','city','salary','created_at'])
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('jobs.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';

            $rhtml .= '<button type="button" class="btn btn-danger btn-sm btnJobDelete" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';

            $rhtml .= '<a href="'.route('job.exportApplicationCSV',['id' => $records->id]).'" type="button" class="btn btn-success btn-sm" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" >CSV Export</a>';

             $rhtml .= '<a href="'.route('job_applications').'?job_id='.$records->id.'" type="button" class="btn btn-success btn-sm" data-id='.$records->id.'>Applications</a>';
             $rhtml .= '<a href="'.route('jobs.pdfExport',['id' => $records->id]).'" type="button" class="btn btn-success btn-sm" data-id='.$records->id.'>PDF</a>';

            return $rhtml;
        }

      })
      ->editColumn('country', function ($records) {
          return ($records->country);
      })
      ->editColumn('state', function ($records) {
         return  ($records->state);
      })
      ->editColumn('city', function ($records) {
         return  ($records->city);
      })
      ->toJson();
    }

    function getDatatablejob(){
        $records = Jobs::select(['id', 'title','country','state','city','salary','created_at'])
       ->orderBy('created_at', 'desc');
     return datatables($records)
     ->addColumn('action', function ($records) {
       if (isAdmin()){
           $rhtml = '<a href="javascript:void(0);" onclick="nextTabQuestion('.$records->id.');"><button type="button" class="btn btn-primary btn-sm" style = "margin-bottom:2px; "><i class="far fa-check-circle"></i> Choose this</button></a>';
           return $rhtml;
       }

     })
     ->toJson();
   }



   public function jobApplyInfo($job_id){
    // dd($job_id);
    $user = Auth::user();
    $data['user'] = $user;
    $data['job'] = Jobs::with('questions')->find($job_id);
    return view('admin.user.applyInfo', $data);

    }


    public function massJobApplySubmit(Request $request){

        // dd($request->toArray());
       $user = Auth::user();
        $requestData = $request->all();
    //    $requestData = array($request['applyFormData']);

        $str_arr = explode (",", $request->cbx);


       $job = Jobs::find($requestData['job_id']);
       // check to confirm job with id exist
       if ($job == null){
           return response()->json([
               'status' => 0,
               'error' => 'Job with id '.$requestData['job_id'].' does not exist'
           ]);
       }else{
           // check if user has not submitted application already.
           foreach($str_arr as $userID){
           $jobApplication = JobsApplication::where('user_id',$userID)->where('job_id',$requestData['job_id'])->first();
           if (!empty($jobApplication)) {
               return response()->json([
                   'status' => 0,
                   'error' => 'You already submit application for this job'
               ]);
           }
        }

           // check application description which is mandatory.
           if(empty($request->application_description)){
                return response()->json([
                   'status' => 0,
                   'error' => 'Please answer all mandatory question.'
               ]);
           }


           foreach($str_arr as $userID){
           $newJobApplication = new JobsApplication();
           $newJobApplication->user_id = $userID;
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

            }
            // dd($request->toArray());

               return response()->json([
                   'status' => 1,
                   'message' => 'You Job Application has been submitted succesfully'
               ]);

       }

   }


   public function massStatusChange(Request $request){

    $user = Auth::user();
    //$requestData = $request->all();
    $statusblue = explode (",", $request->cxx);
    $statusgreen = explode (",", $request->cyx);
    $statusred = explode (",", $request->czx);


    if(!empty($statusblue) || !empty($statusgreen) || !empty($statusred) ){

        if(!empty($statusblue))
        foreach($statusblue as $userID){
            if(!empty($userID)){
            $jobApp = JobsApplication::where('id',$userID)->first();
            $jobApp->status= 'inreview';
            $jobApp->save();
            }
        }


    if(!empty($statusgreen))
    foreach($statusgreen as $userID){
        if(!empty($userID)){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $jobApp->status= 'interview';
        $jobApp->save();
        }
    }
    if(!empty($statusred))
    foreach($statusred as $userID){
        if(!empty($userID)){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $jobApp->status= 'unsuccessful';
        $jobApp->save();
        }
    }

    return response()->json([
        'status' => 1,
        'message' => 'status updates'
    ]);

    }

    else{
        return response()->json([
            'status' => 0,
            'message' => 'status updates failed'
        ]);
    }

}

    public function massJobApplySubmitApplicant(Request $request){

        // dd($request->toArray());
       $user = Auth::user();
        $requestData = $request->all();
    //    $requestData = array($request['applyFormData']);

        $str_arr = explode (",", $request->cbx);


       $job = Jobs::find($requestData['job_id']);
       // check to confirm job with id exist
       if ($job == null){
           return response()->json([
               'status' => 0,
               'error' => 'Job with id '.$requestData['job_id'].' does not exist'
           ]);
       }else{
           // check if user has not submitted application already.

        $userIDs = array();

        foreach($str_arr as $userID){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $userIDs[] = $jobApp->user_id;
        }

        // dd($userIDs);

        foreach($userIDs as $userID){
            $jobApplication = JobsApplication::where('user_id',$userID)->where('job_id',$requestData['job_id'])->first();
            if (!empty($jobApplication)) {
                return response()->json([
                    'status' => 0,
                    'error' => 'You already submit application for this job'
                ]);
            }
         }

           // check application description which is mandatory.
           if(empty($request->application_description)){
                return response()->json([
                   'status' => 0,
                   'error' => 'Please answer all mandatory question.'
               ]);
           }


           foreach($userIDs as $userID){
           $newJobApplication = new JobsApplication();
           $newJobApplication->user_id = $userID;
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

            }
            // dd($request->toArray());

               return response()->json([
                   'status' => 1,
                   'message' => 'You Job Application has been submitted succesfully'
               ]);

       }

   }
    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function store(Request $request){

        // dd( $request->toArray() );
        // dd( $id );
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'country' => 'max:15',
        //     'state' => 'max:15',
        //     'city' => 'max:15',
        //     'experience' => 'max:15',
        //     'type' => 'max:15',
        //     'expiration' => 'max:15',
        //     'user_id' => 'max:15',
        // ]);

        $job = new Jobs();
        $job->title = $request->title;
        $job->country = $request->country;
        $job->state = $request->state;
        $job->city = $request->city;
        $job->experience = $request->experience;
        $job->type = $request->type;
        $job->expiration = $request->expiration;
        $job->created_at = $request->created_at;
        $job->user_id = $request->user_id;

        if( $job->save() ){
            return redirect(route('adminJobs'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }




     public function createJobs(Request $request)
     {

        $records = FALSE;
        $data['content_header'] = 'Edit User';
        $data['record'] = $records;

        $data['title']  = 'Jobs';
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();
        $data['experience'] = Jobs::select('experience')->pluck('experience')->toArray();
        $data['employers']  = User::where('type','employer')->pluck('name','id')->toArray();
        $data['type']  = getJobTypes();
        $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();

        return view('admin.jobs.create', $data);
    }

    // from user controller

    public function storeNewJob(Request $request){

         dd( $request->toArray() );

        $this->validate($request, [
            'title' => 'required|max:255',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'experience' => 'max:250',
            'type' => 'max:250',
            'expiration' => 'max:250',
            'created_at' => 'max:250',
            'user_id' => 'max:250',

        ]);
        $job = new Jobs();
        $job->title = $request->title;
        // $job->description = $request->description;
        $job->country = $request->country;
        $job->state = $request->state;
        $job->city = $request->city;
        $job->experience = $request->experience;
        $job->type = $request->type;
        $job->expiration = $request->expiration;
        $job->created_at = $request->created_at;
        $job->user_id = $request->user_id;

        if( $job->save() ){
            // $job->roles()->attach([config('app.user_role')]);
            return redirect(route('adminJobs'))->withSuccess( __('admin.record_updated_successfully'));

        }
    }
    // create job

    public function show($id){ }

    public function editJob($id){
        $records = Jobs::where('id',$id)->first();

        //  dd($records);
        $data['content_header'] = 'Edit Job';
        $data['record'] = $records;
        $data['salaryRange'] = getSalariesRange();
        $data['title']  = 'Jobs';
        $data['type']  = getJobTypes();
        $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();
        $data['industriesList'] = getIndustries();
        return view('admin.jobs.edit', $data);
        // admin/jobs/edit
    }


    public function updateJob(Request $request, $id){
        // dump( $request->toArray() );
        // dd( $id );
        $this->validate($request, [
            'title' => 'required|max:255',
            'country' => 'max:50',
            'state' => 'max:50',
            'city' => 'max:50',
            'experience' => 'max:100',
            // 'type' => 'max:15',
            'expiration' => 'max:100',
            'created_by' => 'max:19',
        ]);
        $job = Jobs::find($id);
        $job->title = $request->title;
        $job->description = $request->description;
        $job->country = $request->country;
        $job->state = $request->state;
        $job->city = $request->city;
        $job->location_lat =  $request->location_lat;
        $job->location_long = $request->location_long;
        if(!empty($request->industry_experience)){
            $job->experience = $request->industry_experience;
        }
        else{
            $job->experience = '';
        }

        $job->questions()->delete();
        if(!empty($request['jq'])){
        $job->addJobQuestions($request['jq']);
        }
        $job->type = $request->type;
        $job->salary = $request->salary;
        $job->expiration = $request->expiration;
        $job->created_at = $request->created_at;
        $job->user_id = $request->user_id;

        if( $job->save() ){
            return redirect(route('adminJobs'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyJob($id){
      $job = Jobs::find($id);
      if(!empty($job)){
        $job->delete();
          return response()->json([
                'status' => 1,
                'message' => 'Job Succesfully Deleted',
          ]);
      }
    }

    // deleting job

  public function deleteJob(Request $request, $id){
           $this->validate($request, [
            'title' => 'required|max:255',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'experience' => 'max:15',
            // 'type' => 'max:15',
            'expiration' => 'max:19',
            'created_by' => 'max:19',
        ]);

        $job = Jobs::find($id);
        $job->title = $request->title;
        $job->country = $request->country;
        $job->state = $request->state;
        $job->city = $request->city;
        $job->experience = $request->experience;
        $job->type = $request->type;
        $job->expiration = $request->expiration;
        $job->created_at = $request->created_at;
        $job->created_by = $request->created_by;

        if( $job->save() ){
            return redirect(route('adminJobs'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

    // deleting job ends


  // Job Application Functions and dataTable
  public function job_applications(Request $request){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Job Applications';
        $data['content_header'] = 'Job Applications';
        $data['classes_body'] = 'jobs';
        $data['request'] = $request;
        $data['jobs'] = Jobs::with('applicationCount')->get();
        // dd($data);
        return view('admin.job_applications.list', $data);
        // admin/job_applications/list
  }

  // Job Application editting function
  public function editJobApp($id) {
        $records = JobsApplication::findOrFail($id);

        $data['content_header'] = 'Edit Job Application';
        $data['record'] = $records;
        $data['title']  = 'Job Application';
        $data['answers']  = !empty($records->answers)?($records->answers->keyBy('question_id')->toArray()):array();
        return view('admin.job_applications.edit', $data);
        // admin/job_applications/edit
  }



  //===============================================================================================================//
  // .
  //===============================================================================================================//
  public function updateJobApp(Request $request, $id) {

      $jobApp = JobsApplication::find($id);
      $jobApp->status = $request->status;
      if( $jobApp->save() ){
         if(!empty($request->user_answers)){
            foreach ($request->user_answers as $akey => $anvalue) {
              $JobsAnswers = JobsAnswers::find($akey);
              if($JobsAnswers){
                $JobsAnswers->answer = $anvalue;
                $JobsAnswers->save();
              }
            }
          }
          return redirect(route('job_applications'))->withSuccess( __('admin.record_updated_successfully'));
      }
  }

// Job Application editting function End Here

  // Getting Job Application DataTable Start
  public function getJobAppDatatable(Request $request){
      $records =  JobsApplication::with(['jobseeker','job']);

      if(!empty($request->filter_job)){
        $records = $records->where('job_id',$request->filter_job);
      }

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('job_applications.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';
              return $rhtml;
        }
      })
      ->addColumn('profile', function ($records) {
        if (isAdmin()){
            $rhtml = '<a class="btn btn-primary btn-sm btnUserInfo" href="'.route('jobSeekerInfo',['id'=>$records->jobseeker->id]).'" target="_blank" >Info</a>';
            return $rhtml;
        }})
      ->editColumn('user_id', function ($records) {
          return ($records->jobseeker)?($records->jobseeker->name.' '.$records->jobseeker->surname.' ('.$records->user_id.')'):'';
      })
      ->editColumn('job_id', function ($records) {
         return  ($records->job)?($records->job->title.' ('.$records->job_id.')'):'';
      })
      ->editColumn('city', function ($records) {
         return ($records->city);
      })
      ->editColumn('status', function ($records) {
        if($records->status=='applied'){
            return 'Applied';
        }
        else if($records->status=='inreview'){
            return 'In Review';
        }
        else if($records->status=='interview'){
            return 'Interview';
        }
        else if($records->status=='unsuccessful'){
            return 'Unsuccessful';
        }
     })


      ->rawColumns(['profile','action'])
      ->toJson();
    }


    // Job Application and dataTable  End Here


    // filtering function
// public function filter(Request $request)
//    {

//      if(request()->ajax())
//      {
//       if(!empty($request->filter_status))
//       {
//        $records =  JobsApplication::with(['jobseeker','job']);
//         select('id', 'status','title', 'goldstar', 'preffer')
//          ->where('status', $request->filter_status)
//          ->get();

//    }

//  }

// }
    // filtering end here




    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function ExportCSV(Request $request) {
    //   dd($request->toArray());
      if(!empty($request->cbx)){
         $jsExport = new JobApplicationExport($request->cbx);
        return Excel::download($jsExport, 'jobApplications.xlsx');
      }
    }


    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function ExportApplicationCSV(Request $request) {
      if(!empty($request->id)){
         $jsExport = new JobAllApplicationExport($request->id);
        return Excel::download($jsExport, 'JobAllApplications.xlsx');
      }
    }


    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function pdfExport(Request $request, $id) {
      if(!empty($id)){

          $job = Jobs::find($id);
          $applications = JobsApplication::with('jobseeker')->where('job_id',$id)->get();
          // dump( $job );
          // dd( $applications );
           $data['title'] = 'Generate PDF';
           $data['job'] = $job;
           $data['applications'] = $applications;

           if($request->test){


            return view('admin.pdf.jobWithApplication', $data);
           }else{

            $user_gallery    = UserGallery::where('user_id',$job->jobEmployer->id)->where('status',1)->get();
            $profile_image   = UserGallery::where('user_id',$job->jobEmployer->id)->where('status',1)->where('profile',1)->first();
            if(!$profile_image){
                if( $user_gallery->count() > 0){
                    // $profile_image   = asset('images/user/'.$user->id.'/'.$user_gallery->first()->image);
                    $profile_image   = assetGallery($user_gallery->first()->access,$job->jobEmployer->id,'',$user_gallery->first()->image);
                }else{
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                }
            }else{
				// $profile_image   = asset('images/user/'.$user->id.'/gallery/'.$profile_image->image);
                $profile_image   = assetGallery($profile_image->access,$job->jobEmployer->id,'',$profile_image->image);
            }

            $data['profile_image'] = $profile_image;
            $pdf = PDF::loadView('admin.pdf.jobWithApplication', $data);
            $pdf->setPaper('A4');
            return $pdf->download('JobApplications.pdf');
            // admin/pdf/jobWithApplication
           }
      }
    }


    public function addNewJobLocation(Request $request) {
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

            $user = Jobs::findOrFail($request->user_id);
            $user->location_lat     = $request->location_lat;
            $user->location_long    = $request->location_long;


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


}

