<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Jobs;
use App\User;

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
            $rhtml = '<a href="'.route('jobs.edit',['id' =>$records->id]).'">'.__('common.edit').'</a>';
            // $records->GeoCountry->country_title
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

    // from user controller

    public function storeJob(Request $request){
        dd( $request->toArray() );
        $this->validate($request, [
            'title' => 'required|max:255',
            'phone' => 'max:15',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:15',
            'created_at' => 'max:250',

        ]);
        $user = new Job();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->created_at = $request->created_at;
        if( $user->save() ){
            $user->roles()->attach([config('app.user_role')]);
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }

// Storing job in database
    public function store(Request $request){
        dump( $request->toArray() );
        $this->validate($request, [
            'email'         => 'required|max:255|email',
            'password'      => 'required',
        ]);
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Success
            return redirect()->intended('/panel');
        } else {
            // Go back on error (or do what you want)
            return redirect()->back();
        }

    }

// Storing job in database

// create job
    
     public function createJob(){
        $data['record']   = FALSE;
        $data['title']  = 'Job';
        $data['content_header'] = 'Add new Job';
        $data['countries'] = get_Geo_Country();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = array();
        $data['cities'] = array();

        return view('admin.jobs.edit', $data);
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
    public function edit($id)
    {
        $records = Jobs::where('id',$id)->first();
        $data['content_header'] = 'Edit User';
        $data['record'] = $records;
        $data['title']  = 'Jobs';
        $data['employers']  = User::where('type','employer')->pluck('name','id')->toArray();
        $data['job_type']  = Jobs::select('type')->pluck('type')->toArray();
        $data['countries'] = get_Geo_Country()->pluck('country_title','country_id')->toArray();
        $data['states'] = get_Geo_State($records->country)->pluck('state_title','state_id')->toArray();
        $data['cities'] = get_Geo_City($records->country,$records->state)->pluck('city_title','city_id')->toArray();
        return view('admin.jobs.edit', $data); // admin/jobs/edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function updateJob(Request $request, $id){

        dump( $request->toArray() );
        // dd( $id );
        $this->validate($request, [
            'title' => 'required|max:255|min:100',
            'country' => 'max:15',
            'state' => 'max:15',
            'city' => 'max:150|min:100',
           
            'experience' => 'max:15',
            'job_type' => 'max:15',
            'expiration' => 'max:15',   
            'created_by' => 'max:15',    
        ]);

        dd('validation done e');

        $job = Jobs::find($id);
        $job->title = $request->title;
        $job->country = $request->country;
        $job->state = $request->state;
        $job->city = $request->city;
        $job->gender = $request->gender;
        $job->experience = $request->experience;
        // $job->job_type = $request->job_type;
        $job->expiration = $request->expiration;
        $job->created_at = $request->created_at;
        // $job->created_by = $request->created_by;
    
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
    public function destroy($id)
    {
        //
    }

}
