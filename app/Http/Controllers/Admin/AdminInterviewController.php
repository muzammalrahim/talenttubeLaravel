<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

use Yajra\Datatables\Datatables;

// use App\Exports\JobApplicationExport;
// use App\Exports\JobAllApplicationExport;

// use App\UserGallery;
// use App\JobsApplication;
// use App\JobsAnswers;
// use App\JobsQuestions;

use App\Interview;
use App\Slot;
use App\User;

// use Illuminate\Support\Facades\Hash;
use PDF;

class AdminInterviewController extends Controller
{
    public function interviewsList()
    {
    	
    	if (Auth::user() && Auth::user()->type == "admin") {
    		$user = Auth::user();
	        $data['user'] = $user;
	        $data['title'] = 'Application Concierge';
	        $data['content_header'] = 'Application Concierge';
	        $data['classes_body'] = 'interviews';
	        $data['interviews'] = Interview::with('slots')->get();
	        

	        return view('admin.application_concierge.interviews_list', $data);
    	}
    }


    public function getInterviewsListDatatable(){
         $records = Interview::select([
         		'id',
         		'title',
         		'companyname',
         		'positionname',
         		'uniquedigits',
         		'url',
         		'instruction',
         		'additionalmanagers',
         		'created_at'])
        ->withCount('slots')
        ->orderBy('created_at', 'desc'); 

        // dd( $records->toArray() ); 

      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('jobs.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';
            
            return $rhtml;
        }

      })
      ->toJson();
    }
}
