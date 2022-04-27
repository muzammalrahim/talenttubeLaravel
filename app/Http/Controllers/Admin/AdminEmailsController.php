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
use App\Attachment;
// use Yajra\Datatables\Datatables;
// use Illuminate\Support\Facades\Hash;
use App\Exports\JobSeekerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\JobsApplication;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PDF;
use PDFMerger;
use NcJoes\OfficeConverter\OfficeConverter;
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

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
      })

      ->editColumn('status', function ($records) {
        $rhtml = '<span class = "text-capitalize">'.$records->status.' </span>';
        return $rhtml;
      })
      
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            // $rhtml = '<a href="'.route('bulkEmail.edit',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-edit"></i></button></a>';
            $rhtml = '';
            $rhtml .= '<button id="itemdel" type="button" class="btn btn-danger btn-sm BulkEmailConfirmEmail" data-id='.$records->id.' data-title="'.$records->title.'">SendEmail</button>';
            $rhtml .= '<button id="itemdel" type="button" class="ml-2 btn btn-danger btn-sm BulkEmailDeleteConfirmEmail" data-id='.$records->id.' data-title="'.$records->title.'">Delete Email</button>';
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
      ->rawColumns(['status', 'action'])

      ->toJson();
    }



    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function newBulkEmail(Request $request){


        if(!empty($request->cbx)){

        // $userIDs = array();

        // foreach($request->cbx as $userID){
        // $jobApp = JobsApplication::where('id',$userID)->first();
        // $userIDs[] = $jobApp->user_id;
        // }
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Email';
        $data['content_header'] = 'bulkEmail';
        $data['classes_body'] = 'bulkEmail';
        $data['record'] = null;
        $data['jobSeekers'] = User::whereIn('id',$request->cbx)->get();
        return view('admin.bulkEmail.new', $data);

        }

    }

    public function newBulkEmailApplicant(Request $request){

        if(!empty($request->cbx)){

        $userIDs = array();

        foreach($request->cbx as $userID){
        $jobApp = JobsApplication::where('id',$userID)->first();
        $userIDs[] = $jobApp->user_id;
        }
        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Bulk Email';
        $data['content_header'] = 'bulkEmail';
        $data['classes_body'] = 'bulkEmail';
        $data['record'] = null;

        $data['jobSeekers'] = User::whereIn('id',$userIDs)->get();
        return view('admin.bulkEmail.new', $data);

        }

    }



    //===============================================================================================================//
    // .
    //===============================================================================================================//
    public function storeBulkEmail(Request $request){
        $new = new BulkEmail();

        // dd($request->user_ids);
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);


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
                 // $when = now()->addSeconds(2);
                  Mail::to($user->email)->cc('creativedev22@gmail.com')->send(new BulkEmailForQueuing($bulkEmail));
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



    public function DeleteEmail(Request $request) {
        // dd( $request->toArray() );
        if(!empty($request->id)){
        $res=BulkEmail::where('id',$request->id)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Bulk Email Succesfully Deleted',
          ]);
        }
     }

    //===============================================================================================================//
    // Generate CSV
    //===============================================================================================================//
    public function GenerateCVS(Request $request) {
      // dd($request->toArray());
      if(!empty($request->cbx)){
         $jsExport = new JobSeekerExport($request->cbx);
        return Excel::download($jsExport, 'jobSeekers.xlsx');
      }
    }


    //===============================================================================================================//
    // Buk Genetae PDF
    //===============================================================================================================//
    
    public function BulkGenerateCVPDF(Request $request) {

      // dd($request->toArray());
      if(!empty($request->cbx)){
        $data['title'] = 'Generate PDF';
        $users = User::whereIn('id', $request->cbx)->get();
        $data['users'] = $users;
        $userAttachment = null;
        $pdf = new PDFMerger();
        $isFileAdded = False;
        foreach($users as $user){
          $userAttachment = Attachment::where('user_id', $user->id)->first();
          if(!empty($userAttachment)){
            if($userAttachment->type=="pdf"){
              if(PHP_OS=="WINNT"){
                $str = str_replace('/', '\\', $userAttachment->file);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'\\storage\\images\\user\\'.$str)){
                  $pdf->addPDF($cwd.'\\storage\\images\\user\\'.$str, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
              else if(PHP_OS=="Linux"){
                $str =  $userAttachment->file;
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'/storage/images/user/'.$str)){
                  $pdf->addPDF($cwd.'/storage/images/user/'.$str, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
            }
            else if($userAttachment->type=="doc" || $userAttachment->type=="docx" ){
              if(PHP_OS=="WINNT"){
                $str = str_replace('/', '\\', $userAttachment->file);
                $copystr = str_replace(".docx",".pdf",$userAttachment->name);
                $copystr = str_replace(".doc",".pdf",$copystr);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'\\storage\\images\\user\\'.$str)){
                  $converter = new OfficeConverter($cwd.'\\storage\\images\\user\\'.$str);
                  $converter->convertTo($copystr);
                  $pdf->addPDF($cwd.'\\storage\\images\\user\\'.$userAttachment->user_id.'\\private\\'.$copystr, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
              else if(PHP_OS=="Linux"){
                $str = $userAttachment->file;
                $copystr = str_replace(".docx",".pdf",$userAttachment->name);
                $copystr = str_replace(".doc",".pdf",$copystr);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'/storage/images/user/'.$str)){
                  $converter = new OfficeConverter($cwd.'/storage/images/user/'.$str);
                  $converter->convertTo($copystr);
                  $pdf->addPDF($cwd.'/storage/images/user/'.$userAttachment->user_id.'/private/'.$copystr, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
            }
          }
        }
      }
      if($isFileAdded)
        $pdf->merge('download', "bundledCVs.pdf");
      else
        return redirect()->back();
    }

    //===============================================================================================================//
    // Buk Genetae PDF Applicants
    //===============================================================================================================//
    
    public function BulkGenerateCVPDFApplicant(Request $request) {
      if(!empty($request->cbx)){
        $userIDs = array();
        foreach($request->cbx as $userID){
          $jobApp = JobsApplication::where('id',$userID)->first();
          $userIDs[] = $jobApp->user_id;
        }
        $data['title'] = 'Generate PDF';
        $users = User::whereIn('id', $userIDs)->get();
        $data['users'] = $users;
        $userAttachment = null;
        $pdf = new PDFMerger();
        $isFileAdded = False;
        foreach($users as $user){
          $userAttachment = Attachment::where('user_id', $user->id)->first();
          if(!empty($userAttachment)){
            if($userAttachment->type=="pdf"){
              if(PHP_OS=="WINNT"){
                $str = str_replace('/', '\\', $userAttachment->file);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'\\storage\\images\\user\\'.$str)){
                  $pdf->addPDF($cwd.'\\storage\\images\\user\\'.$str, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
              else if(PHP_OS=="Linux"){
                $str =  $userAttachment->file;
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'/storage/images/user/'.$str)){
                  $pdf->addPDF($cwd.'/storage/images/user/'.$str, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
            }
            else if($userAttachment->type=="doc" || $userAttachment->type=="docx" ){
              if(PHP_OS=="WINNT"){
                $str = str_replace('/', '\\', $userAttachment->file);
                $copystr = str_replace(".docx",".pdf",$userAttachment->name);
                $copystr = str_replace(".doc",".pdf",$copystr);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'\\storage\\images\\user\\'.$str)){
                  $converter = new OfficeConverter($cwd.'\\storage\\images\\user\\'.$str);
                  $converter->convertTo($copystr);
                  $pdf->addPDF($cwd.'\\storage\\images\\user\\'.$userAttachment->user_id.'\\private\\'.$copystr, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
              else if(PHP_OS=="Linux"){
                $str = $userAttachment->file;
                $copystr = str_replace(".docx",".pdf",$userAttachment->name);
                $copystr = str_replace(".doc",".pdf",$copystr);
                chdir('..');
                $cwd = getcwd();
                if(file_exists($cwd.'/storage/images/user/'.$str)){
                  $converter = new OfficeConverter($cwd.'/storage/images/user/'.$str);
                  $converter->convertTo($copystr);
                  $pdf->addPDF($cwd.'/storage/images/user/'.$userAttachment->user_id.'/private/'.$copystr, 'all');
                  $isFileAdded = True;
                }
                chdir('public');
              }
            }
          }
        }
        if($isFileAdded)
          $pdf->merge('download', "bundledCVs.pdf");
        else
          return redirect()->back();
      }
    }

    //===============================================================================================================//
    // Generate PDF
    //===============================================================================================================//
    
    public function GeneratePDF(Request $request){
      // dd($request->cbx);
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


    //===============================================================================================================//
    // Generate PDF Applicant
    //===============================================================================================================//
    
    public function generatePDFApplicant(Request $request) {
      if(!empty($request->cbx)){
      // dd($request->cbx);
      // $str_arr = explode (",", $request->cbx);
        $userIDs = array();
        foreach($request->cbx as $userID){
          $jobApp = JobsApplication::where('id',$userID)->first();
          $userIDs[] = $jobApp->user_id;
        }
        $data['title'] = 'Generate PDF';
        $users = User::whereIn('id', $userIDs)->get();
        $data['users'] = $users;
        if($request->test){
          return view('admin.pdf.bulkJobSeeker', $data);
        }else{
          $pdf = PDF::loadView('admin.pdf.bulkJobSeeker', $data); // admin/pdf/bulkJobSeeker
          $pdf->setPaper('A4');
          return $pdf->download('JobSeekers.pdf');
          // admin/pdf/bulkJobSeeker
        }
      }
    }




    // public function bulkInterview(Request $request){

    //   dd($request->cbx);
    //   if(!empty($request->cbx)){

    //     // $userIDs = array();

    //     // foreach($request->cbx as $userID){
    //     // $jobApp = JobsApplication::where('id',$userID)->first();
    //     // $userIDs[] = $jobApp->user_id;
    //     // }
    //     $user = Auth::user();
    //     $data['user'] = $user;
    //     $data['title'] = 'Bulk Email';
    //     $data['content_header'] = 'bulkEmail';
    //     $data['classes_body'] = 'bulkEmail';
    //     $data['record'] = null;
    //     $data['jobSeekers'] = User::whereIn('id',$request->cbx)->get();
    //     return view('admin.bulkEmail.new', $data);

    //     }

    // }


    
}
