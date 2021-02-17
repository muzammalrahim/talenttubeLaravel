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
        $data['title'] = $name;
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

      ->addColumn('name', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->name.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('email', function ($records) {
        if (isAdmin()){
                $rhtml = '<p>'.$records->user->email.'</p>';
            return $rhtml;
        }
      })

      ->addColumn('action', function ($records) {
        if (isAdmin()){
                $rhtml = ' <span user_id = "'.$records->user_id.'" class="fas fa-trash text-danger removeFromPool pointer" >  </span>';
            return $rhtml;
        }
      })


      
      ->rawColumns(['name','email','action'])
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
    	$records = User::select(['id', 'name','email','qualification','created_at'])->whereNotIn('id' , $UserPool)
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');

        return datatables($records)

      // ->editColumn('created_at', function ($request) {
      //   return $request->created_at->format('Y-m-d'); // human readable format
      // })

        ->addColumn('action', function ($records) {
        	if (isAdmin()){
                $rhtml = ' <span user_id = "'.$records->id.'" class="fas fa-plus addjsInPool text-primary pointer">  </span>';
            	return $rhtml;
        	}
    	})


        ->addColumn('qualification', function ($records) {
        	if (isAdmin()){

                // $qualificationsData =  ($records->qualification)?(getQualificationsData($records->qualification)):(array());

                $rhtml = $records->qualification;

				// $qualification = '';
				//     foreach ($qualificationsData as $qualification) {
				//         $qualification .= '<p value="test">'.$qualification['title'].'</p>';
				//     }
				// $rhtml = '</p> '.$qualification.' </p>';
 

      
            	return $rhtml;
        	}
    	})
      
      ->rawColumns(['action','qualification'])
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




}