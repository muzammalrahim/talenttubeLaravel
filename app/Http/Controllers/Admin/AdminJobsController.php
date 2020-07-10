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

// use Yajra\Datatables\Datatables;
// use Illuminate\Support\Facades\Hash;

class AdminJobsController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

       return view('admin.jobs.list', $data);
    }

    function getDatatable(){
         $records = Jobs::select(['id', 'title','country','state','city','experience','salary','created_at'])
         ->with(['GeoCountry','GeoState','GeoCity'])
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('jobs.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';

            $rhtml .= '<button id="itemdel" type="button" class="btn btn-danger btn-sm" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';
            return $rhtml;
        }

      })
      ->editColumn('country', function ($records) {
          return ($records->GeoCountry)?($records->GeoCountry->country_title):'';
      })
      ->editColumn('state', function ($records) {
         return  ($records->GeoState)?($records->GeoState->state_title):'';
      })
      ->editColumn('city', function ($records) {
         return  ($records->GeoCity)?($records->GeoCity->city_title):'';
      })
      ->toJson();
    }

// Storing job in database

    public function store(Request $request)
        {

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
    

// Storing job in database

// create job
    
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

        // dd( $request->toArray() );

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

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editJob($id)
    {
        $records = Jobs::where('id',$id)->first();

        // dd(); 
        $data['content_header'] = 'Edit Job';
        $data['record'] = $records;
        $data['title']  = 'Jobs';
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = get_Geo_State($records->country)->pluck('state_title','state_id')->toArray();
        $data['cities'] = get_Geo_City($records->country,$records->state)->pluck('city_title','city_id')->toArray();

        // dd( $records->user_id ); 

        $data['type']  = getJobTypes();
        $data['user_id']  = User::where('type','employer')->pluck('name','id')->toArray();
        return view('admin.jobs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function updateJob(Request $request, $id){

        // dump( $request->toArray() );
        // dd( $id );
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

        public function job_applications(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Job Applications';
        $data['content_header'] = 'Job Applications';
        $data['classes_body'] = 'jobs';
        $data['jobs'] = Jobs::with('applicationCount')->get();

        // dd($data); 

       return view('admin.job_applications.list', $data);
    }
      // Job Application editting function

      public function editJobApp($id)
    {
        $records = JobsApplication::where('id',$id)->first();
        
        // dump($records->toArray());
        // dump($records->job->toArray());
        // dump($records->job->questions->toArray());
        // dump();
        // dd(); 
        $data['content_header'] = 'Edit Job Application';
        $data['record'] = $records;
        $data['title']  = 'Job Application';
        $data['answers']  = $records->answers->keyBy('question_id')->toArray();
        return view('admin.job_applications.edit', $data);
    }

      // Job Application editting function End Here

// Getting Job Application DataTable Start
    function getJobAppDatatable(){
      
       // $records =  JobsApplication::select(['id', 'status','job_id','goldstar','user_id','preffer'])->get(); 
       // dd($records->first()->jobseeker());

       $records =  JobsApplication::with(['jobseeker','job']); 
       
      
       // ->with(['GeoCountry','GeoState','GeoCity'])
      // ->orderBy('created_at', 'desc');
      return datatables($records)

      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('job_applications.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';
              return $rhtml;
        }
      })
      ->editColumn('user_id', function ($records) {
          return ($records->jobseeker)?($records->jobseeker->name.' '.$records->jobseeker->surname.' ('.$records->user_id.')'):'';
      })
      ->editColumn('job_id', function ($records) {
         return  ($records->job)?($records->job->title.' ('.$records->job_id.')'):'';
      })
      ->editColumn('city', function ($records) {
         return  ($records->GeoCity)?($records->GeoCity->city_title):'';
      })
      ->toJson();
    }

    // Job Application and dataTable  End Here

}
