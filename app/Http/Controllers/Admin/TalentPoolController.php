<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\TalentPool;
use App\UserPool;

class TalentPoolController extends Controller
{

    public function __construct(){
    	$this->middleware('auth');
    }


    // ========================================= Iteration-8 Talent Pool =========================================

    public function talentPool() {
        $data['title'] = 'Talent Pool';
        $data['content_header'] = 'Talent Pool';
        // $data['filter_status'] = 'verified';
        // $data['jobStatusArray'] = jobStatusArray();
        return view('admin.candidate_tracking.pool_list', $data); // admin/candidate_tracking/pool_list
    }

    // =================================================== Talent Pool Data table iteration-8 ===================================================
    
    public function talentPoolDataTable(Request $request){
      $records = array();
      $records = TalentPool::select(['id', 'name','created_at'])
        // ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      // ->editColumn('created_at', function ($request) {
      //   return $request->created_at->format('Y-m-d'); // human readable format
      // })

      ->addColumn('action', function ($records) {
        if (isAdmin()){
                $rhtml = ' <a  href = " '.route('poolInfo',['id'=>$records->id , 'name'=>$records->name ]).'" value = "'.$records->id.'" class="btn btn-primary ViewPool" > View Pool</a>';
            return $rhtml;
        }
      })
      
      ->rawColumns(['action'])
      ->toJson();

    }

    // =================================================== Create Pool iteration-8 ===================================================

    public function poolCreate(){
        $data['record']   = FALSE;
        $data['title']  = 'Create Pool';
        $data['content_header'] = 'Create Pool';
        return view('admin.candidate_tracking.create_pool', $data);  
        // admin/interviewTemplate/create
    }


    // =================================================== Store pool iteration-8 ===================================================

    public function poolStore(Request $request){
    	$user = Auth::user();
        // dd($user->id);
    //     // $data['user'] = $user;
        $data = $request->all();
        // dd($data);
         $this->validate($request, [
            'name' => 'required|max:255|unique:talent_pools',
        ]);

        $pool = New TalentPool();
        $pool->name = $data['name'];
        $pool->save();

        if( $pool->save() ){
                return redirect(route('talentPool'))->withSuccess( __('admin.record_added_successfully'));
            }

    }

    // =================================================== Pool Info iteration-8 ===================================================


    public function poolInfo($id, $name) {
    	// dd($id);
        $UserPool = UserPool::where('id' , $id)->first();
        // dd($UserPool);
        $data['id'] = $id;
        $data['title'] = $name ;
        $data['content_header'] = $name;
        // $data['filter_status'] = 'verified';
        // $data['jobStatusArray'] = jobStatusArray();
        return view('admin.candidate_tracking.pool_info', $data); // admin/candidate_tracking/pool_info
    }


    // =================================================== User Pool Data table iteration-8 ===================================================

    public function userPoolDatatable(Request $request){
    	// dd($request->id);
      $records = array();
      $records = UserPool::select(['user_id','created_at'])->where('pool_id', $request->id)
        // ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)

      // ->editColumn('created_at', function ($request) {
      //   return $request->created_at->format('Y-m-d'); // human readable format
      // })

      ->addColumn('surname', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->surname.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('city', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->city.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('email', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->email.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('phone', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->phone.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('created_at', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->created_at.'</p>';
            return $rhtml;
        }
      })


      ->addColumn('profile', function ($records) {
            if (isAdmin()){
                $rhtml = '<a class="btn btn-primary btn-sm" href="'.route('jobSeekerInfo',['id'=>$records->user->id]).'" target="_blank" >Info</a>';
                return $rhtml;
            }})
        ->addColumn('videoInfo', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserVideoInfo" user-id='. $records->user->id.' >Info</button>';
            return $rhtml;
        }})

        ->addColumn('resume', function ($records) {
        if (isAdmin()){
            $rhtml = '<button type="button" class="btn btn-primary btn-sm btnUserResumeInfo" user-id='. $records->user->id.' >Info</button>';
            return $rhtml;
        }})

      ->addColumn('action', function ($records) {
        if (isAdmin()){
                $rhtml = ' <span user_id = "'.$records->user_id.'" class="fas fa-trash text-danger removeFromPool pointer" >  </span>';
            return $rhtml;
        }
      })


      
      ->rawColumns(['surname', 'city', 'email','phone','created_at','profile','videoInfo','resume','action'])
      ->toJson();

    }


    public function addJobseekerInPool(Request $request){
    	$id = $request->id;
    	$talentPool = TalentPool::find($id);
    	// dd($talentPool->name);
    	if ($talentPool) {

    		$data['title'] = $talentPool->name;
    	    $data['content_header'] = $talentPool->name;
    	    $data['id']= $id;
	        return view('admin.candidate_tracking.addJobseekerinPool', $data); 
	        // admin/candidate_tracking/addJobseekerinPool
    	}
    	else{
    		return redirect()->back();
    	}
    	
    }


     // =================================================== User Pool Data table iteration-8 ===================================================

    public function addJobseekerinPoolDatatable(Request $request){
    	// dd($request->id);
    	$UserPool = UserPool::where('pool_id', $request->id)->pluck('user_id');
    	// dd($UserPool);
    	$records = array();
    	$records = User::select(['id', 'name','email','qualificationType', 'industry_experience' ,'qualification','created_at'])->whereNotIn('id' , $UserPool)
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
        
        return datatables($records)

        ->editColumn('qualification', function ($records) {

        $qualificationsData =  ($records->qualification)?(getQualificationsData($records->qualification)):(array());

        if(!empty($qualificationsData))
            foreach($qualificationsData as $qualification)
            {
                $rhtml = '<div class="QualificationSelect">';
                $rhtml .= '<p style="margin-bottom: 0px;"> '.$qualification['title'].' </p>'; 
                $rhtml .= '</div>';
                return $rhtml;
            }

        })


        ->editColumn('industry_experience', function ($records) {
           if(isset($records->industry_experience)){
               foreach ($records->industry_experience as $ind){
                $rhtml = '<div class="indsutrySelect">';
                $rhtml .= '<p style="margin-bottom: 0px;">'.getIndustryName($ind).'</p>';
                $rhtml .= '</div>';
                return $rhtml;
               }
           }
        })

        // ->addColumn('qualification_type', function ($records) {
        //     if (isAdmin()){
        //         $rhtml = ' <span> '.$records->qualificationType.'  </span>';
        //         return $rhtml;
        //     }
        // })

        ->addColumn('action', function ($records) {
        	if (isAdmin()){
                $rhtml = ' <span user_id = "'.$records->id.'" class="fas fa-plus addjsInPool text-primary pointer">  </span>';
            	return $rhtml;
        	}
    	})

      
      ->rawColumns(['qualificationType','qualification','industry_experience','action'])
      ->toJson();
      dump($records);

    }


// =================================================== Store pool iteration-8 ===================================================

    public function addInPool(Request $request){
    	$user = Auth::user();
        // dd($user->id);
        $data = $request->all();
  
        $pool = New UserPool();
        $pool->user_id = $data['user_id'];
        $pool->pool_id = $data['pool_id'];
        $pool->save();
    }

    // =================================================== Remove user from pool iteration-8 ===================================================

    public function removeFromPool(Request $request){
    	$user = Auth::user();
        // dd($request->user_id);
        $UserPool = UserPool::where('pool_id' , $request->pool_id)->where('user_id' , $request->user_id)->first();
        // dd($UserPool->id)
        if (isAdmin()) {
        	$UserPool->delete();
        }
  
    }


    // =================================================== Bulk jobseeker  iteration-8 ===================================================

    public function bulkPool(Request $request){
        $user = Auth::user();
        // $data = $request->toArray();
        // dd($data);
        $UserPool = TalentPool::get();
        $data['UserPool'] = $UserPool;
        return view('admin.candidate_tracking.poolAjax', $data); 

  
    }

    // =================================================== Add Bulk Jobseeker in Pool iteration-8 ===================================================

    public function AddBulkJobseekerInPool(Request $request){
        $user = Auth::user();
        $data = $request->toArray();
        $notSavedUser = array();
        // dd($data);
        foreach ($data['cbx'] as $key => $value) {
            $user = User::where('id' , $value)->where('type', 'user')->first();
            // dd($user);
            if ($user != null) {

                $UserPool = new UserPool;
                $UserPool->user_id = $value;
                $UserPool->pool_id = $data['pool_id'];

                $UserPool->save();
            /*    return response()->json([
                    'status' => 1,
                    'message' => 'Users added in pool successfully'
                ]);*/

            }
            /*else if($user == null){
                   array_push($notSavedUser, $value);
                   dump($notSavedUser); 
            }*/
         
        }
    }




}