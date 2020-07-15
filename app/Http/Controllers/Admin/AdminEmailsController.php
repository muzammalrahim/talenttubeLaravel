<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use App\Jobs;
use App\User;
use App\BulkEmail;

use App\Jobs\SendBulkEmailJob;
use App\Mail\BulkEmailForQueuing;
use Illuminate\Support\Facades\Mail;

// use Yajra\Datatables\Datatables;
// use Illuminate\Support\Facades\Hash;

use App\Exports\JobSeekerExport;
use Maatwebsite\Excel\Facades\Excel;

use PDF;


class AdminEmailsController extends Controller {

    use AuthenticatesUsers;

    
    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function list() {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if ($user->isAdmin() ) {
        //         return redirect()->route('adminDashboard');
        //     }else{
        //         return redirect()->route('homepage');
        //     }
        // } 
        $data['title'] = 'Page Title';
        $data['content_header'] = 'Content Header';
        $data['content'] = 'this is page content';
        $view_name = 'admin.bulkEmail.list'; //   admin/bulkEmail/list
        return view($view_name, $data); 
    }


    //===============================================================================================================//
    // .
    //===============================================================================================================//
    function getDatatable(){
      $records = BulkEmail::orderBy('created_at', 'desc');
      
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            // $rhtml = '<a href="'.route('bulkEmail.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';
            $rhtml = '';
            $rhtml .= '<button id="itemdel" type="button" class="btn btn-danger btn-sm BulkEmailConfirmEmail" data-id='.$records->id.' data-title="'.$records->title.'">SendEmail</button>';
            return $rhtml;
        }
      })
      // ->editColumn('country', function ($records) {
      //     return ($records->GeoCountry)?($records->GeoCountry->country_title):'';
      // })
      // ->editColumn('state', function ($records) {
      //    return  ($records->GeoState)?($records->GeoState->state_title):'';
      // })
      // ->editColumn('city', function ($records) {
      //    return  ($records->GeoCity)?($records->GeoCity->city_title):'';
      // })
      ->toJson();
    }



    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function newBulkEmail(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Email';
        $data['content_header'] = 'bulkEmail';
        $data['classes_body'] = 'bulkEmail';
        $data['record'] = null;
        $data['jobSeekers'] = User::JobSeeker()->get();
        return view('admin.bulkEmail.new', $data);
    }



    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function storeBulkEmail(Request $request){
        $new = new BulkEmail(); 
        $new->title = $request->title; 
        $new->content = $request->content;  
        $new->user_ids = $request->user_ids;  
        $new->status = 'new';  
        if( $new->save() ){
            return redirect(route('bulkEmail.list'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }
    

    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function SendEmail(Request $request) {
       // dd( $request->toArray() );   
       if(!empty($request->id)){
        
        $bulkEmail = BulkEmail::find($request->id); // orderBy('created_at', 'desc');
        if(!empty($bulkEmail)){
           $user_ids = $bulkEmail->user_ids; 
           if(!empty($user_ids)){

              $users = User::whereIn('id',$user_ids)->get();
              if(!empty($users)){
                foreach ($users as $user) {
                  // $details = ['email' => $user->email];
                  // SendBulkEmailJob::dispatch($details);
                  $when = now()->addSeconds(2);
                  Mail::to($user->email)->cc('creativedev22@gmail.com')->later($when, new BulkEmailForQueuing($bulkEmail));
                }
              }

              $bulkEmail->status = 'queued';
              $bulkEmail->save();

              return response()->json([
                'status' => 1,
                'message' => 'Bulk Email Succesfully Added for Quing',
              ]);

           } 
        }
       }   
    }



    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function GenerateCVS(Request $request) {
      // dd($request->toArray()); 
      if(!empty($request->cbx)){
         $jsExport = new JobSeekerExport($request->cbx); 
        return Excel::download($jsExport, 'jobSeekers.xlsx');
      }
    }

    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function GeneratePDF(Request $request) {
      if(!empty($request->cbx)){
           
           $data['title'] = 'Generate PDF';
           $users = User::whereIn('id', $request->cbx)->get();
           $data['users'] = $users;

           if($request->test){
            return view('admin.pdf.bulkJobSeeker', $data);
           }else{
            $pdf = PDF::loadView('admin.pdf.bulkJobSeeker', $data); 
            $pdf->setPaper('A4'); 

            return $pdf->download('JobSeekers.pdf');
            // admin/pdf/bulkJobSeeker 
           }
           
      }
    }
     

}
