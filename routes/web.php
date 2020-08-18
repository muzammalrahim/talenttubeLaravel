<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('test', 'Site\SiteUserController@test')->name('test');
Route::get('test2', 'Site\HomeController@test2')->name('test2');
Route::get('test3', 'Site\HomeController@test3')->name('test3');
Route::get('welcom', function () { return view('welcome'); }); 

Route::get('phpini', 'Site\HomeController@phpini')->name('phpini');

Route::post('notifyPayment', 'Site\PaymentController@notifyPayment')->name('notifyPayment');
// Route::get('notifyPayment', 'Site\PaymentController@notifyPayment')->name('notifyPayment');

Route::get('paymentReturn', 'Site\PaymentController@paymentReturn')->name('paymentReturn');


Auth::routes();
Route::get('/clear', function() {
    $cache = Artisan::call('cache:clear');
    $view = Artisan::call('view:clear');
    $route = Artisan::call('route:clear');
    $config = Artisan::call('config:clear');

    dump(' cache = '.$cache);
    dump(' route = '.$route);
    dump(' config = '.$config);
    dd(' view = '.$view);
});


Route::get('images/user/{userid}/gallery/{any}', [
    'as'         => 'images.show',
    'uses'       => 'Site\HomeController@imgshow',
    'middleware' => 'auth',
])->where('any', '.*');

Route::get('images/user/{userid}/private/{any}', [
    'as'         => 'files.show',
    'uses'       => 'Site\HomeController@fileshow',
    'middleware' => 'auth',
])->where('any', '.*');


// Media access video streaming 
Route::get('stream/{userid}/videos/{any}', [
    'as'         => 'videoStream.show',
    'middleware' => 'auth',
    'uses'       => 'Site\HomeController@videoStream',
])->where('any', '.*');


//Media access gallery  
Route::get('media/public/{userid}/{any}', [
    // 'as'         => 'files.show',
    'uses'       => 'Site\HomeController@fileshow2',
    // 'middleware' => 'auth',
])->where('any', '.*');

Route::get('media/private/{userid}/{any}', [
    'as'         => 'privateFile.show',
    'middleware' => 'auth',
    'uses'       => 'Site\HomeController@privateFileshow',
])->where('any', '.*');






// Backend Admin with out Authentication
Route::get('admin', 'Admin\AdminController@index');
Route::post('admin/login', 'Admin\AdminController@login');

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');



// Backend Admin with Authentication
Route::group(array('prefix' => 'admin', 'middleware' => ['auth','admin']), function(){

    Route::get('dashboard','Admin\AdminController@dashboard')->name('adminDashboard');
    Route::get('adminDashboard','Admin\AdminController@dashboard');
   
    Route::get('users', 'Admin\UserController@index')->name('users');
    Route::get('users/create', 'Admin\UserController@create')->name('users.create');
    Route::get('users/edit/{id}', 'Admin\UserController@edit')->name('users.edit');
    Route::post('users/create', 'Admin\UserController@store')->name('users.store');
    Route::patch('users/update/{id}', 'Admin\UserController@update')->name('users.update');
    Route::get('users/getList', 'Admin\UserController@getDatatable')->name('users.dataTable');
    Route::get('users/pending', 'Admin\UserController@pendingUsers')->name('pendingUsers');
    Route::get('users/verified', 'Admin\UserController@verifiedUsers')->name('verifiedUsers');


    // for deleting 
    Route::post('users/delete/{id}', 'Admin\UserController@destroyUser')->name('users.destroy');

    // user Info
    Route::get('users/userinfo', 'Admin\UserController@profilePopup')->name('users.profilePopup');
    Route::get('users/videoInfo', 'Admin\UserController@profileVideoPopup')->name('users.profileVideoPopup');
    Route::get('users/resumeData', 'Admin\UserController@resumeData')->name('users.resumeData');
    Route::post('users/confirmAccount', 'Admin\UserController@confirmAccount')->name('users.confirmAccount');

    Route::get('employers', 'Admin\UserController@employers')->name('adminEmployers');
    Route::get('employers/verified', 'Admin\UserController@verifiedEmployers')->name('adminVerifiedEmployers');
    Route::get('employers/pending', 'Admin\UserController@pendingEmployers')->name('adminPendingEmployers');

    Route::get('employers/edit/{id}', 'Admin\UserController@editEmployer')->name('employers.edit');
    Route::patch('employers/update/{id}', 'Admin\UserController@updateEmployer')->name('employers.update');
    Route::get('employers/create', 'Admin\UserController@createEmployer')->name('employers.create');
    Route::post('employers/create', 'Admin\UserController@storeEmployer')->name('employers.store');
    Route::get('employers/getList', 'Admin\UserController@getEmployerDatatable')->name('employers.dataTable');

    // for deleting 
    Route::post('employers/delete/{id}', 'Admin\UserController@destroyemployers')->name('employers.destroy');

    // Route added by Hassaan
    Route::get('jobs','Admin\AdminJobsController@jobs')->name('adminJobs');
    Route::get('jobs/getList', 'Admin\AdminJobsController@getDatatable')->name('jobs.dataTable');
    Route::get('jobs/create', 'Admin\AdminJobsController@createJobs')->name('jobs.create');
    Route::post('jobs/store', 'Admin\AdminJobsController@storeNewJob')->name('jobs.store');
    Route::get('jobs/edit/{id}', 'Admin\AdminJobsController@editJob')->name('jobs.edit');
    Route::get('jobs/{id}', 'Admin\AdminJobsController@pdfExport')->name('jobs.pdfExport');
    Route::patch('jobs/update/{id}', 'Admin\AdminJobsController@updateJob')->name('jobs.update');

    // for deleting 
    Route::post('jobs/delete/{id}', 'Admin\AdminJobsController@destroyJob')->name('jobs.destroy');
    

    // bulkEmail 
    Route::get('bulkEmail/new', 'Admin\AdminEmailsController@newBulkEmail')->name('bulkEmail.new');
    Route::post('bulkEmail/store', 'Admin\AdminEmailsController@storeBulkEmail')->name('bulkEmail.store');
    Route::get('bulkEmail/list', 'Admin\AdminEmailsController@list')->name('bulkEmail.list');
    Route::get('bulkEmail/getList', 'Admin\AdminEmailsController@getDatatable')->name('bulkEmail.dataTable');
    Route::post('bulkEmail/SendEmail', 'Admin\AdminEmailsController@SendEmail')->name('bulkEmail.SendEmail');

    // bulkCVS 
    Route::post('bulk/generateCVS', 'Admin\AdminEmailsController@GenerateCVS')->name('bulk.GenerateCVS');
    Route::get('bulk/generateCVS', 'Admin\AdminEmailsController@GenerateCVS');
    Route::post('bulk/generatePDF', 'Admin\AdminEmailsController@GeneratePDF')->name('bulk.GeneratePDF');
    Route::get('bulk/generatePDF', 'Admin\AdminEmailsController@GeneratePDF');
    

    // End here

    // Job Application Start here 

    Route::get('job_applications','Admin\AdminJobsController@job_applications')->name('job_applications');
    Route::get('job_applications/getjobapps', 'Admin\AdminJobsController@getJobAppDatatable')->name('job.jobAppDatatable');
    Route::get('job_applications/edit/{id}', 'Admin\AdminJobsController@editJobApp')->name('job_applications.edit');
    Route::patch('job_applications/update/{id}', 'Admin\AdminJobsController@updateJobApp')->name('job_applications.update');
    Route::post('jobApplication/exportCSV', 'Admin\AdminJobsController@ExportCSV')->name('jobApplication.exportCSV');
    Route::get('job/exportApplicationCSV/{id}', 'Admin\AdminJobsController@ExportApplicationCSV')->name('job.exportApplicationCSV');

    // for filtering 
    Route::post('job_applications/search', 'Admin\AdminJobsController@filter')->name('job_applications.filter');


    // Job Application End Here
});








// Front End without Authentication
// Desktop layout only. 
Route::group(array('middleware' => ['devicecheck']), function(){

    Route::get('/', 'Site\HomeController@index')->name('homepage');

    // Login.
    Route::get('login', function () { return redirect('/'); });
    Route::post('login', 'Site\HomeController@loginUser')->name('login');
    Route::post('join', 'Site\HomeController@join')->name('join'); 
    Route::get('join', function () { return redirect('/'); });


    // User Registeration.
    Route::post('register', 'Site\HomeController@register')->name('register'); // user_register
    // Route::get('step2', 'Site\HomeController@step2')->name('step2');


    //Employer Registeration.
    Route::post('register/employer', 'Site\HomeController@registerEmployer')->name('registerEmployer'); // user_register
    Route::get('employer/verification', 'Site\HomeController@employerNotVerified')->name('employerNotVerified');
    Route::post('employer/verification', 'Site\HomeController@resendVerificationCode')->name('resendVerificationCode');
    Route::get('employer/verify/{id}/{code}', 'Site\HomeController@accountVerification')->name('accountVerification');

    Route::get('/unauthorized', function () { return view('unauthorized'); });
    Route::post('ajax/geo_states', 'Site\HomeController@geo_states')->name('ajax_geo_states');
    Route::post('ajax/geo_cities', 'Site\HomeController@geo_cities')->name('ajax_geo_cities');

});




// Front End  with Authentication
Route::group(array('middleware' => ['auth','devicecheck']), function(){

    Route::get('profile', function () { return redirect('user/'.Auth::user()->username); })->name('profile');
    Route::get('user/{username}', 'Site\SiteUserController@index')->name('username');
    Route::post('saveUserProfile', 'Site\SiteUserController@updateUserProfile')->name('saveUserProfile');
    Route::post('saveUserPersonalSetting', 'Site\SiteUserController@saveUserPersonalSetting')->name('saveUserPersonalSetting');

    // User
    Route::get('step2',       'Site\SiteUserController@step2User')->name('step2User');
    Route::post('step2',      'Site\SiteUserController@Step2');
    
    Route::post('ajax/changeUserStatusText', 'Site\SiteUserController@changeUserStatusText');
    Route::post('ajax/updateRecentJob', 'Site\SiteUserController@updateRecentJob');
    
    // Added by Hassan

    Route::post('ajax/updateSalaryRange', 'Site\SiteUserController@updateSalaryRange');
    Route::post('ajax/updateQualification', 'Site\SiteUserController@updateQualification')->name('updateQualification');
    Route::post('ajax/updateQuestions', 'Site\SiteUserController@updateQuestions');



    // ========================== Update Employer Questions ===========================================

    Route::post('ajax/updateEmployerQuestions', 'Site\SiteUserController@updateEmployerQuestions');

    // ========================== Update Employer Questions ===========================================


    Route::post('ajax/updateIndustryExperience', 'Site\SiteUserController@updateIndustryExperience')->name('updateIndustryExperience');

    
    // Added by Hassan
    
    Route::get('ajax/getUserPersonalInfo', 'Site\SiteUserController@getUserPersonalInfo');
    Route::post('ajax/update_about_field', 'Site\SiteUserController@updateAboutField');
    Route::post('ajax/uploadUserGallery', 'Site\SiteUserController@uploadUserGallery');
    Route::post('ajax/deleteGallery/{id}', 'Site\SiteUserController@deleteGallery');
    Route::post('ajax/setGalleryPrivateAccess/{id}', 'Site\SiteUserController@setGalleryPrivateAccess');
    Route::post('ajax/setImageAsProfile/{id}', 'Site\SiteUserController@setImageAsProfile');
    Route::post('ajax/userUploadResume', 'Site\SiteUserController@userUploadResume')->name('userUploadResume');
    Route::post('ajax/removeAttachment/', 'Site\SiteUserController@removeAttachment')->name('removeAttachment');
    Route::get('ajax/getTags/{category}/{offset?}', 'Site\SiteUserController@getTags');
    Route::get('ajax/searchTags', 'Site\SiteUserController@searchTags')->name('searchTags');

    // ============================================= Save User Tags =============================================

    Route::post('ajax/updateUserTags', 'Site\SiteUserController@updateUserTags')->name('updateUserTags');


    // ============================================= Save User Tags =============================================

    Route::post('ajax/addNewTag', 'Site\SiteUserController@addNewTag')->name('addNewTag');

    // activity  user/employer
    Route::post('ajax/saveNewActivity', 'Site\SiteUserController@saveNewActivity')->name('saveNewActivity');
    Route::post('ajax/removeActivity', 'Site\SiteUserController@removeActivity')->name('removeActivity');

    // video user/employer
    Route::post('ajax/uploadVideo', 'Site\SiteUserController@uploadVideo')->name('uploadVideo');
    Route::post('ajax/deleteVideo', 'Site\SiteUserController@deleteVideo')->name('deleteVideo');
    Route::get('block',         'Site\SiteUserController@blockList')->name('blockList');
    Route::post('ajax/unBlockUser', 'Site\SiteUserController@unBlockUser')->name('unBlockUser');

    // Like Route and unlike route
    Route::get('like',         'Site\SiteUserController@likeList')->name('likeList');
    Route::post('ajax/unLikeUser', 'Site\SiteUserController@unLikeUser')->name('unLikeUser');

    Route::get('mutual-likes',         'Site\SiteUserController@mutualLikes')->name('mutualLikes');
    



    // Employer
    Route::get('employer/profile', function () { return redirect('employer/'.Auth::user()->username); })->name('employerProfile');
    Route::get('employer/step2',       'Site\EmployerController@step2Employer')->name('step2Employer');
    Route::post('employer/step2',      'Site\EmployerController@Step2');

    Route::get('jobSeekers',        'Site\EmployerController@jobSeekers')->name('jobSeekers');
    Route::post('jobSeekersFilter', 'Site\EmployerController@jobSeekersFilter')->name('jobSeekersFilter');

    Route::post('ajax/blockJobSeeker/{id}', 'Site\EmployerController@blockJobSeeker')->name('blockJobSeeker');
    Route::post('ajax/likeJobSeeker/{id}', 'Site\EmployerController@likeJobSeeker')->name('likeJobSeeker');
    Route::get('employers',         'Site\JobSeekerController@employers')->name('employers');
    Route::get('employerInfo/{id}', 'Site\JobSeekerController@employerInfo')->name('employerInfo');
    Route::get('jobSeekerInfo/{id}', 'Site\JobSeekerController@jobSeekerInfo')->name('jobSeekerInfo');
    Route::post('ajax/blockEmployer/{id}', 'Site\JobSeekerController@blockEmployer')->name('blockEmployer');
    Route::post('ajax/likeEmployer/{id}', 'Site\JobSeekerController@likeEmployer')->name('likeEmployer');


    // job

 

    Route::get('employer/job/new',    'Site\EmployerController@newJob')->name('newJob');
    Route::post('ajax/job/new',    'Site\EmployerController@addNewJob')->name('addNewJob');
    Route::get('employer/jobs',    'Site\EmployerController@jobs')->name('employerJobs');
    Route::get('employer/jobsEdit/{id}',    'Site\EmployerController@jobEdit')->name('employerJobEdit');
    Route::get('employer/job/{id}/applications', 'Site\EmployerController@empJobApplications')->name('empJobApplications');
    
    Route::post('employer/jobAppFilter', 'Site\EmployerController@jobAppFilter')->name('jobAppFilter');

 
    Route::post('ajax/job/{id}',    'Site\EmployerController@updateJob')->name('employerJobUpdate');
    
    Route::get('jobs', 'Site\SiteUserController@jobs')->name('jobs');
    Route::post('jobsFilter', 'Site\SiteUserController@jobsFilter')->name('jobsFilter');

    Route::get('jobs/{id}', 'Site\SiteUserController@jobDetail')->name('jobDetail');
    
    Route::post('ajax/deleteJob/{id}', 'Site\SiteUserController@deleteJob')->name('deleteJob');
    Route::get('jobApplications', 'Site\SiteUserController@jobApplications')->name('jobApplications');

    Route::get('ajax/jobApplyInfo/{id}', 'Site\SiteUserController@jobApplyInfo')->name('jobApplyInfo');
    Route::post('ajax/jobApplySubmit', 'Site\SiteUserController@jobApplySubmit')->name('jobApplySubmit');
    Route::post('ajax/deleteJobApplication/{id}', 'Site\SiteUserController@deleteJobApplication')->name('deleteJobApplication');
    Route::get('ajax/getJobAppQA/{id}', 'Site\EmployerController@getJobAppQA')->name('getJobAppQA');
    Route::post('ajax/changeJobApplicationStatus', 'Site\EmployerController@changeJobApplicationStatus')->name('changeJobApplicationStatus');

    // Route::get('employer/jobapplications', 'Site\EmployerController@empJobApplications')->name('empJobApplications');
    


    // Credits
    Route::get('credit',       'Site\EmployerController@credit')->name('credit');
    Route::get('paymentStatus', 'Site\PaymentController@paymentInfo')->name('paymentStatus');
    Route::get('paymentCancel', function () { return 'Payment has been canceled'; })->name('paymentCancel');
    Route::get('employer/{username}',   'Site\EmployerController@index');



});




// Localization
Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');
        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];
        foreach ($files as $file) {
            $name      = basename($file, '.php');
            if( $name == 'site' ){  $strings[$name] = require $file;  }
        }
        return $strings;
    });
    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');



Route::get('textLog', 'Site\HomeController@textLog')->name('textLog');
