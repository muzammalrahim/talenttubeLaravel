<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Jobs;
use App\JobsApplication;


use App\UserQualification;
use App\Industries;

use DB;

class AdminReportsController extends Controller
{   

    public function __construct(){
        $this->middleware('auth');
    }

    public function jobseeker_reports(){


        // ========================================= Male/Female Level =========================================

        $males = User::where('type' , 'user')->where('gender' , 'male')->get();
        $females = User::where('type' , 'user')->where('gender' , 'female')->get();
        $data['males'] = $males;
        $data['females'] = $females;

        // ========================================= Age =========================================

        $first_loop = User::where('type' , 'user')->whereBetween('age', [18,25])->get()->count();
        $second_loop = User::where('type' , 'user')->whereBetween('age', [26,30])->get()->count();
        $third_loop = User::where('type' , 'user')->whereBetween('age', [31,40])->get()->count();
        $forth_loop = User::where('type' , 'user')->whereBetween('age', [41,54])->get()->count();
        $fifth_loop = User::where('type' , 'user')->whereBetween('age', [54, 80])->get()->count();
        
        $data['first_loop'] = $first_loop;
        $data['second_loop'] = $second_loop;
        $data['third_loop'] = $third_loop;
        $data['forth_loop'] = $forth_loop;
        $data['fifth_loop'] = $fifth_loop;

        // ====================================== Count Job Seekers by initial Question ======================================
        
        // $question_like =  '%\"'. $user_q1.'\":\"'. $user_q1_ans.'\"%';
        $q1_like =  '%"graduate_intern":"yes"%';
        $user_q1_count = User::where('type' , 'user')->where('questions', 'LIKE', $q1_like)->get()->count();
        $user_q2_count = User::where('type' , 'user')->where('questions', 'LIKE', '%"part_time":"yes"%')->get()->count();
        $user_q3_count = User::where('type' , 'user')->where('questions', 'LIKE', '%"temporary_contract":"yes"%')->get()->count();
        $user_q4_count = User::where('type' , 'user')->where('questions', 'LIKE', '%"fulltime":"yes"%')->get()->count();
        $user_q5_count = User::where('type' , 'user')->where('questions', 'LIKE', '%"relocation":"yes"%')->get()->count();
        $user_q6_count = User::where('type' , 'user')->where('questions', 'LIKE', '%"resident":"yes"%')->get()->count();

        $data['user_q1_count'] = $user_q1_count;
        $data['user_q2_count'] = $user_q2_count;
        $data['user_q3_count'] = $user_q3_count;
        $data['user_q4_count'] = $user_q4_count;
        $data['user_q5_count'] = $user_q5_count;
        $data['user_q6_count'] = $user_q6_count;

        // ========================================= Qualifications Level =========================================

        $trade = User::where('type' , 'user')->where('qualificationType', 'trade')->get()->count();
        $certificate = User::where( 'type' , 'user')->where('qualificationType', 'certificate')->get()->count();
        $degree = User::where('type' , 'user')->where('qualificationType', 'degree')->get()->count();
        $post_degree = User::where('type' , 'user')->where('qualificationType', 'post_degree')->get()->count();

        $data['trade'] = $trade;
        $data['certificate'] = $certificate;
        $data['degree'] = $degree;
        $data['post_degree'] = $post_degree;

        // ======================================= Most Qualification =======================================
        
        $userQual = UserQualification::groupBy('qualification_id')->select(DB::raw('count(*) as qualif_count, qualification_id '))
        ->orderByRaw('COUNT(*) DESC')->get();
        $data['userQual'] = $userQual;

        // ======================================= Most popular location =======================================
        
        $userLocation = User::where('type' ,'user')->whereNotNull('city')->groupBy('city')->select(DB::raw('count(*) as city_count, city'))->orderByRaw('COUNT(*) DESC')->take(10)->get();
        $data['userLocation'] = $userLocation;
        
        // ======================================= Industry Experience =======================================
        
        $industries = getIndustries();
        $indus = array();
        foreach ($industries as $key => $value) {
            $user_q1_count = User::where('type' , 'user')->where('industry_experience', 'LIKE', '%'.$key.'%')->get()->count();
            // dump($user_q1_count);
            // $indus[0] = $key;
            array_push($indus, $user_q1_count);
            // $user_q1_count = User::where('type' , 'user')->where('industry_experience', 'LIKE', '%'.$key.'%')->groupBy('industry_experience')->select(DB::raw('count(*) as indus_count, industry_experience'))->orderByRaw('COUNT(*) DESC')->take(5)->get();
            // array_push($indus, $user_q1_count);
        }

        // dump($indus);
        $data['indus'] = $indus ;
        $industriesnew = getIndustries_new();
        $data['industriesnew'] = $industriesnew; 
        // dump($industriesnew);
        // dd($industries); 
        // $q1_like =  '%"graduate_intern":"yes"%';
        // $user_q1_count = User::where('type' , 'user')->where('questions', 'LIKE', $q1_like)->get()->count();

        // ======================================= Industry Experience end =======================================
        
        $data['title'] = 'Reporting';
        $data['content_header'] = 'Reports';
        return view('admin.reports.index', $data); // admin/reports/index
    }


    // ====================================================== Job Reports ======================================================

    public function job_reports(){


        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Jobs';
        $data['content_header'] = 'Jobs Reports';
        $data['classes_body'] = 'jobs Reports';
        $data['jobs'] = Jobs::with('applicationCount')->get();


        // $data['title'] = 'Reporting';
        // $data['content_header'] = 'Reports';
        return view('admin.reports.job_reports', $data); // admin/reports/job_reports

    }

    function getDatatableReport(){
         $records = Jobs::with(['jobEmployer']);
      return datatables($records)

      ->editColumn('created_at', function ($records) {
        return humanReadableDateTime($records->created_at); // human readable format
      })
      
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $job_aggregate = ($records->applicationCount)?($records->applicationCount->aggregate):0;
            $rhtml = '<a href="'.route('viewJobReport',['id' => $records->id]).'"><button type="button" class="btn btn-primary btn-sm"style = "margin-bottom:2px; "><i class="far fa-eye"> '.$job_aggregate.' </i></button></a>';

            // $rhtml .= '<button type="button" class="btn btn-danger btn-sm viewJobReport" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" ><i class="far fa-trash-alt" style= "padding: 1.5px;"></i></button>';

            // $rhtml .= '<a href="'.route('job.exportApplicationCSV',['id' => $records->id]).'" type="button" class="btn btn-success btn-sm" data-type="Jobs" data-id='. $records->id.' data-title="'.$records->title.'" >CSV Export</a>';

             // $rhtml .= '<a href="'.route('job_applications').'?job_id='.$records->id.'" type="button" class="btn btn-success btn-sm" data-id='.$records->id.'>Applications</a>';
             // $rhtml .= '<a href="'.route('jobs.pdfExport',['id' => $records->id]).'" type="button" class="btn btn-success btn-sm" data-id='.$records->id.'>PDF</a>';

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
      ->editColumn('user_id', function ($records) {
         return  ($records->jobEmployer->company);
      })

      // ->addColumn('company', function ($records) {
      //    return  ($records->jobEmployer->company);
      // })

      ->toJson();
    }

    // ============================================================================================================ 
    //Job Reports of single job 
    // ============================================================================================================

    public function viewJobReport($id){

        // dd($id);

        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Job Report';
        $data['content_header'] = 'Job Report';
        $data['classes_body'] = 'Job Report';
        $data['job'] = Jobs::where('id' , $id)->get();

        // ==================================================== Males Females ====================================================

        $males = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)->where('users.gender', 'male')
            ->count();

        $females = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)->where('users.gender', 'female')
            ->count();

        $data['males'] = $males;
        $data['females'] = $females;

        // ========================================= Age =========================================

        $first_loop = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereBetween('users.age', [18,25])->count();

        $second_loop = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereBetween('users.age', [26,30])->count();

        $third_loop = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereBetween('users.age', [31,40])->count();

        $forth_loop = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereBetween('users.age', [41,54])->count();

        $fifth_loop = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereBetween('users.age', [54, 80])->count();
        
        $data['first_loop'] = $first_loop;
        $data['second_loop'] = $second_loop;
        $data['third_loop'] = $third_loop;
        $data['forth_loop'] = $forth_loop;
        $data['fifth_loop'] = $fifth_loop;

        // ====================================== Count Job Seekers by initial Question ======================================
        
        // $question_like =  '%\"'. $user_q1.'\":\"'. $user_q1_ans.'\"%';
        $q1_like =  '%"graduate_intern":"yes"%';
        $user_q1_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', $q1_like)->get()->count();
        
        $user_q2_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', '%"part_time":"yes"%')->get()->count();

        $user_q3_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', '%"temporary_contract":"yes"%')->get()->count();

        $user_q4_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', '%"fulltime":"yes"%')->get()->count();

        $user_q5_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', '%"relocation":"yes"%')->get()->count();

        $user_q6_count = DB::table('jobs_applications')->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')
        ->where('jobs_applications.job_id', $id)->where('questions', 'LIKE', '%"resident":"yes"%')->get()->count();

        $data['user_q1_count'] = $user_q1_count;
        $data['user_q2_count'] = $user_q2_count;
        $data['user_q3_count'] = $user_q3_count;
        $data['user_q4_count'] = $user_q4_count;
        $data['user_q5_count'] = $user_q5_count;
        $data['user_q6_count'] = $user_q6_count;


        // ========================================= Qualifications Level =========================================

        $trade = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->where('qualificationType', 'trade')->get()->count();

        $certificate = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->where('qualificationType', 'certificate')->get()->count();

        $degree = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->where('qualificationType', 'degree')->get()->count();

        $post_degree = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->where('qualificationType', 'post_degree')->get()->count();

        $data['trade'] = $trade;
        $data['certificate'] = $certificate;
        $data['degree'] = $degree;
        $data['post_degree'] = $post_degree;

        // ======================================= Most Qualification =======================================
        
        $userQual = DB::table('jobs_applications')
            ->leftJoin('user_qualifications', 'user_qualifications.user_id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->groupBy('qualification_id')->select(DB::raw('count(*) as qualif_count, qualification_id'))
        ->orderByRaw('COUNT(*) DESC')->get();
        $data['userQual'] = $userQual;


        // ======================================= Most popular location =======================================
        
        $userLocation = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)
            ->whereNotNull('city')->groupBy('city')->select(DB::raw('count(*) as city_count, city'))->orderByRaw('COUNT(*) DESC')->get();
        $data['userLocation'] = $userLocation;

        // ======================================= Industry Experience =======================================
        
        $industries = getIndustries();
        $indus = array();
        foreach ($industries as $key => $value) {
            $user_q1_count = DB::table('jobs_applications')
            ->leftJoin('users', 'users.id', '=', 'jobs_applications.user_id')->where('jobs_applications.job_id', $id)->where('users.type' , 'user')->where('industry_experience', 'LIKE', '%'.$key.'%')->get()->count();
            // dump($user_q1_count);
            // $indus[0] = $key;
            array_push($indus, $user_q1_count);
            // $user_q1_count = User::where('type' , 'user')->where('industry_experience', 'LIKE', '%'.$key.'%')->groupBy('industry_experience')->select(DB::raw('count(*) as indus_count, industry_experience'))->orderByRaw('COUNT(*) DESC')->take(5)->get();
            // array_push($indus, $user_q1_count);
        }

        // dump($indus);
        $data['indus'] = $indus ;
        $industriesnew = getIndustries_new();
        $data['industriesnew'] = $industriesnew; 

        // ======================================= Job Status =======================================
     
        $JobsApplication = JobsApplication::groupBy('prev_status')->where('status', 'unsuccessful')->select(DB::raw('count(*) as statu_count, prev_status '))->where('job_id', $id)
        ->orderByRaw('COUNT(*) DESC')->get(); 
        $data['JobsApplication'] = $JobsApplication;

        // dump($userQual);

        // foreach ($appStatus as $app) {
        //     dump($app->status_count);
        //     dump($app->prev_status);
        // }
        
        // ========================================= End Filters =========================================



        // $data['applications'] = JobsApplication::where('job_id' , $id)->get();
        return view('admin.reports.job_reports_detail', $data); // admin/reports/job_reports_detail 

    }


    // ============================================================================================================ 
    //  Employer's Reports 
    // ============================================================================================================

    public function employer_reports(){

        // ====================================== Count total employers ======================================

        // $employers = User::where('type' , 'employer')->get()->count();
        $data['employers'] = User::where('type' , 'employer')->get()->count();


        // ====================================== Count Job Seekers by initial Question ======================================
        
        // $question_like =  '%\"'. $user_q1.'\":\"'. $user_q1_ans.'\"%';
        $q1_like =  '%"graduate_intern":"yes"%';
        $data['user_q1_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', $q1_like)->get()->count();
        $data['user_q2_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', '%"part_time":"yes"%')->get()->count();
        $data['user_q3_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', '%"temporary_contract":"yes"%')->get()->count();
        $data['user_q4_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', '%"fulltime":"yes"%')->get()->count();
        $data['user_q5_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', '%"relocation":"yes"%')->get()->count();
        $data['user_q6_count'] = User::where('type' , 'employer')->where('questions', 'LIKE', '%"resident":"yes"%')->get()->count();


        // ======================================= Industry Experience =======================================
        
        $industries = getIndustries();
        $indus = array();
        foreach ($industries as $key => $value) {
            $user_q1_count = User::where('type' , 'employer')->where('industry_experience', 'LIKE', '%'.$key.'%')->get()->count();
            array_push($indus, $user_q1_count);
        }

        $data['indus'] = $indus ;
        $data['industriesnew'] = getIndustries_new(); 

        // ======================================= Most popular location =======================================
        
        $data['userLocation'] = User::where('type' ,'employer')->whereNotNull('city')->groupBy('city')->select(DB::raw('count(*) as city_count, city'))->orderByRaw('COUNT(*) DESC')->take(5)->get();
        
        // $data['userLocation'] = $userLocation;

        // ====================================== End Employer's Reporting ======================================


        $user = Auth::user();
        $data['user'] = $user;
        $data['title'] = 'Employer Report';
        $data['content_header'] = 'Employer Report';
        $data['classes_body'] = 'employers';




        return view('admin.reports.employer_report', $data); // admin/reports/employer_report 


    }










}
