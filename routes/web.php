<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Mail\TestEmail;
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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('testEmail', function () {


    $data = ['message' => 'This is a test!'];

    dd(Mail::to('hassaansaeed1@gmail.com')->send(new TestEmail($data)));
});

// Route::get('testEmail1','Site\ReferenceController@testEmail1')->name('testEmail1');

Route::get('interview-invitation/{url}','Site\HomeController@interviewInvitationUrl')->name('interviewInvitationUrl');
Route::get('userinterviewconcierge/url', 'Site\HomeController@userUniqueurl')->name('userinterviewconcierge.url');
Route::get('userspublic/videoInfo', 'Site\HomeController@profileVideoPopup')->name('publicuservideo');

// ================================================ Save interview from unique url ================================================ 
Route::post('ajax/booking/saveInterviewSlot',    'Site\HomeController@saveInterviewSlot')->name('saveSlot');
Route::get('/interViewSlotCreated',    'Site\HomeController@interViewSlotCreated')->name('interViewSlotCreated');
Route::get('/alreadyBookedSlot',    'Site\HomeController@alreadyBookedSlot')->name('alreadyBookedSlot');
Route::post('interviewConLogin',    'Site\HomeController@interviewConLogin')->name('interviewConLogin');
Route::get('/interviewCon',    'Site\HomeController@interviewConLayout')->name('interviewCon');
Route::get('/noBookingMade',    'Site\HomeController@noBookingMade')->name('noBookingMade');
Route::post('ajax/booking/deleteBooking',    'Site\HomeController@deleteBooking')->name('deleteBooking');
Route::post('ajax/booking/deleteSlot',    'Site\HomeController@deleteSlot')->name('deleteSlot');
Route::post('ajax/booking/sendEmailEmployer',    'Site\HomeController@sendEmailEmployer')->name('sendEmailEmployer');
Route::post('ajax/rescheduleSlot',    'Site\HomeController@rescheduleSlot')->name('rescheduleSlot');

// =========================================== Cross Reference for unauthenticated ===========================================
Route::get('crosssreference/url', 'Site\ReferenceController@crosssreference')->name('crosssreference');
Route::post('ajax/booking/sendReferenceW', 'Site\ReferenceController@sendReferenceW')->name('sendReferenceW');
Route::post('ajax/booking/sendReferenceP', 'Site\ReferenceController@sendReferenceP')->name('sendReferenceP');
Route::post('ajax/booking/sendReferenceE', 'Site\ReferenceController@sendReferenceE')->name('sendReferenceE');
Route::post('ajax/crossreference/declineReference/{id}','Site\ReferenceController@declineReference')->name('declineReference');
Route::get('reference/completed','Site\ReferenceController@referenceCompleted')->name('reference.completed');
Route::get('reference/declined','Site\ReferenceController@referenceDeclined')->name('reference.declined');
Route::get('completed/reference/{id}/{name}','Site\ReferenceController@completedReferenceAll')->name('referencesForAll');
Route::get('referece/terms','Site\ReferenceController@ref_terms')->name('ref_terms');


// =========================================== Cross Reference for unauthenticated ===========================================

// =========================================== Resume Read Section ============================================

Route::get('generate-docx','Site\HomeController@generateDocx')->name('generateDocx');

// Route::get('userInterview',    'Site\HomeController@unregisteredUserInterview')->name('userInterview');

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


Route::get('media/public/template/employer_intro/{any}', [
    'as'         => 'videoStream.show',
    'middleware' => 'auth',
    'uses'       => 'Site\HomeController@videoStreamForInterview',
])->where('any', '.*');  


Route::get('media/public/interview_bookings/{any}', [
    'as'         => 'videoStream.show',
    'middleware' => 'auth',
    'uses'       => 'Site\HomeController@videoStreamInterviewAnswers',
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
    Route::get('admin', 'Admin\AdminController@index')->name('admin');
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
    Route::patch('users/update/{id}', 'Admin\UserController@admin_userUpdate')->name('users.update');
    Route::get('users/getList', 'Admin\UserController@getDatatable')->name('users.dataTable');
    Route::get('users/pending', 'Admin\UserController@pendingUsers')->name('pendingUsers');
    Route::get('users/verified', 'Admin\UserController@verifiedUsers')->name('verifiedUsers');
    Route::get('users/list', 'Admin\UserController@verifiedUsers')->name('userslist');
    Route::get('ajax/removeAttachment/', 'Admin\UserController@removeAttachment')->name('removeAttachmentadmin');
    Route::post('ajax/deleteVideo', 'Admin\UserController@deleteVideo')->name('deleteVideoadmin');
    Route::post('ajax/uploadUserGallery', 'Admin\UserController@uploadUserGallery');
    // for deleting
    Route::post('users/delete/{id}', 'Admin\UserController@destroyUser')->name('users.destroy');
    Route::post('ajax/uploadVideo1', 'Admin\UserController@uploadVideo')->name('uploadvideoadmin');
    // user Info
    Route::get('users/userinfo', 'Admin\UserController@profilePopup')->name('users.profilePopup');
    Route::get('users/videoInfo', 'Admin\UserController@profileVideoPopup')->name('users.profileVideoPopup');
    Route::get('users/resumeData', 'Admin\UserController@resumeData')->name('users.resumeData');
    Route::post('users/confirmAccount', 'Admin\UserController@confirmAccount')->name('users.confirmAccount');
    Route::post('ajax/userUploadResume', 'Admin\UserController@userUploadResume')->name('userUploadResumeadmin');
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

    // Routes added by Hassaan
    Route::get('jobs','Admin\AdminJobsController@jobs')->name('adminJobs');
    Route::get('jobs/getList', 'Admin\AdminJobsController@getDatatable')->name('jobs.dataTable');
    Route::get('jobs/getListjob', 'Admin\AdminJobsController@getDatatablejob')->name('jobs.dataTablejob');
    Route::get('jobs/create', 'Admin\AdminJobsController@createJobs')->name('jobs.create');
    Route::post('jobs/store', 'Admin\AdminJobsController@storeNewJob')->name('jobs.store');
    Route::get('jobs/edit/{id}', 'Admin\AdminJobsController@editJob')->name('jobs.edit');
    Route::get('jobs/{id}', 'Admin\AdminJobsController@pdfExport')->name('jobs.pdfExport');
    Route::patch('jobs/update/{id}', 'Admin\AdminJobsController@updateJob')->name('jobs.update');

    // for deleting
    Route::post('jobs/delete/{id}', 'Admin\AdminJobsController@destroyJob')->name('jobs.destroy');

    // bulkEmailnewBulkEmailApplicant
    Route::get('bulkEmail/new', 'Admin\AdminEmailsController@newBulkEmail')->name('bulkEmail.new');
    Route::get('bulkEmailApllicant/new', 'Admin\AdminEmailsController@newBulkEmailApplicant')->name('bulkEmailApplicant.new');
    Route::post('bulkEmail/store', 'Admin\AdminEmailsController@storeBulkEmail')->name('bulkEmail.store');
    Route::get('bulkEmail/list', 'Admin\AdminEmailsController@list')->name('bulkEmail.list');
    Route::get('bulkEmail/getList', 'Admin\AdminEmailsController@getDatatable')->name('bulkEmail.dataTable');
    Route::post('bulkEmail/SendEmail', 'Admin\AdminEmailsController@SendEmail')->name('bulkEmail.SendEmail');
    Route::post('bulkEmail/DeleteEmail', 'Admin\AdminEmailsController@DeleteEmail')->name('bulkEmail.DeleteEmail');

    // bulkCVS
    Route::post('bulk/generateCVS', 'Admin\AdminEmailsController@GenerateCVS')->name('bulk.GenerateCVS');
    Route::get('bulk/generateCVS', 'Admin\AdminEmailsController@GenerateCVS');
    Route::post('bulk/generatePDF', 'Admin\AdminEmailsController@GeneratePDF')->name('bulk.GeneratePDF');
    Route::post('bulk/generatePDFApplicant', 'Admin\AdminEmailsController@generatePDFApplicant')->name('bulk.generatePDFApplicant');
    Route::get('bulk/generatePDF', 'Admin\AdminEmailsController@GeneratePDF');
    Route::post('bulk/BulkGenerateCVPDF', 'Admin\AdminEmailsController@BulkGenerateCVPDF')->name('bulk.BulkGenerateCVPDF');
    Route::post('bulk/BulkGenerateCVPDFApplicant', 'Admin\AdminEmailsController@BulkGenerateCVPDFApplicant')->name('bulk.BulkGenerateCVPDFApplicant');

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
    Route::post('ajax/addNewLocation', 'Admin\UserController@addNewLoaction');
    Route::post('ajax/addNewJobLocation', 'Admin\AdminJobsController@addNewJobLocation');
    // Job Application End Here
    Route::get('ajax/jobApplyInfoa/{id}', 'Admin\AdminJobsController@jobApplyInfo')->name('jobApplyInfo');
    Route::post('ajax/massJobApplySubmit', 'Admin\AdminJobsController@massJobApplySubmit')->name('massJobApplySubmit');
    Route::post('ajax/massJobApplySubmitApplicant', 'Admin\AdminJobsController@massJobApplySubmitApplicant')->name('massJobApplySubmitApplicant');
    Route::post('ajax/massStatusChange', 'Admin\AdminJobsController@massStatusChange')->name('massStatusChange');
    Route::post('ajax/deleteGallery/{id}/{userID}', 'Admin\UserController@deleteGallery');
    
    // ====================================== Interview Concierge ======================================
    // Route::get('interviewConcierge/list', 'Admin\AdminInterviewController@interviewsList')->name('interviewConcierge.list');
    // Route::get('interviews/getList', 'Admin\AdminInterviewController@getInterviewsListDatatable')->name('interviews.dataTable');
    // Route::get('interviews/edit/{id}', 'Admin\AdminInterviewController@interviewEdit')->name('interview.edit');
    // Route::patch('interviews/update/{id}', 'Admin\AdminInterviewController@updateInterview')->name('interview.update');
    // Route::post('ajax/booking/adminDeleteSlot','Admin\AdminInterviewController@adminDeleteSlot')->name('adminDeleteSlot');
    // Route::post('ajax/adminInterviews/delete/{id}', 'Admin\AdminInterviewController@interviewDelete')->name('interviewDelete');

    // Route::get('interview/create', 'Admin\AdminInterviewController@createInterview')->name('interview.create');
    // Route::post('interview/store', 'Admin\AdminInterviewController@storeNewInterview')->name('interview.store');

    // ====================================== Interview Concierge End Here ======================================

    // ====================================== AdminCrossReference ======================================

    Route::get('reference/list', 'Admin\AdminReferenceController@referenceList')->name('reference.list');
    Route::get('reference/completed/list', 'Admin\AdminReferenceController@completedReferenceList')->name('reference.list');
    Route::get('reference/getList', 'Admin\AdminReferenceController@getReferenceDatatable')->name('reference.dataTable');
    Route::get('compReference/getList', 'Admin\AdminReferenceController@getCompReferenceDatatable')->name('completedReference.dataTable');
    Route::get('view/reference/{id}', 'Admin\AdminReferenceController@view_reference')->name('view_reference');

    Route::get('reference/create', 'Admin\AdminReferenceController@createInterview')->name('reference.create');
    Route::get('reference/edit/{id}', 'Admin\AdminReferenceController@referenceEdit')->name('reference.edit');


    // ====================================== Cross Reference End Here ======================================

    // ====================================== ControlJs Start ======================================

    Route::get('controlJS/list', 'Admin\UserController@controJSlndex')->name('controlJS.list');
    Route::get('controlsJS/getList', 'Admin\UserController@CJSgetDatatable')->name('CJS.dataTable');
    Route::get('controlEmp/list', 'Admin\UserController@controlEmpIndex')->name('controlEmp.list');
    Route::get('controlEmp/getList', 'Admin\UserController@cEmpDatatable')->name('Cemp.dataTable');

    // Adminnotes
    // ====================================== Admin Notes ======================================

    Route::get('notes/list', 'Admin\UserController@adminNotes')->name('adminNotes');
    Route::get('notes/getList', 'Admin\UserController@notesDataTable')->name('notes.dataTable');
    Route::post('note/delete', 'Admin\UserController@adminDeleteNote')->name('AdminDeleteNote');
    Route::post('note/edit/{id}', 'Admin\UserController@adminEditNote')->name('adminEditNote');

    // ====================================== Admin Interview Templates ======================================

    Route::get('interview/templates', 'Admin\AdminInterviewController@interviewTemplates')->name('interviewTemplates');
    Route::get('template/create', 'Admin\AdminInterviewController@templateCreate')->name('template.create');
    Route::post('template/create', 'Admin\AdminInterviewController@storeTemplate')->name('template.store');
    Route::get('template/getList', 'Admin\AdminInterviewController@interviewTemplateDataTable')->name('template.dataTable');
    Route::post('template/delete', 'Admin\AdminInterviewController@AdminDeleteTemplate')->name('AdminDeleteTemplate');
    Route::get('template/edit/{id}', 'Admin\AdminInterviewController@templateEdit')->name('adminEditTemplateQuestion');
    Route::post('template/update/{id}', 'Admin\AdminInterviewController@templateUpdate')->name('template.update');
    Route::post('ajax/template/question/delete', 'Admin\AdminInterviewController@templateQuestionDelete')->name('templateQuestionDelete');




    // ====================================== iteration-12 ======================================

    Route::post('/ajax/interview_template/uploadVideo', 'Admin\AdminInterviewController@employer_video_intro')->name('employer_video_intro');



    // ====================================== iteration-8 ======================================

    Route::get('users/tracker', 'Admin\UserController@trackUsers')->name('trackUsers');
    Route::get('tracker/getList', 'Admin\UserController@getDatatableTracker')->name('tracker.dataTable');
    Route::get('users/tracker/jobs', 'Admin\AdminJobsController@getJobsOjs')->name('users.getJobs');
    Route::post('jobs/status', 'Admin\AdminJobsController@changesJobStatus')->name('jobs.changesStatus');
    Route::post('jobs/status/change', 'Admin\AdminJobsController@changesJobStatusConfirm')->name('jobs.changesJobStatusConfirm');
    Route::post('jobs/defaultJobApplication', 'Admin\AdminJobsController@defaultJobApplication')->name('jobs.defaultJobApplication');
    Route::get('users/tracker/addCandidate', 'Admin\UserController@addCandidate')->name('addCandidate');
    Route::get('candidates/getList', 'Admin\UserController@addCandidateDatatable')->name('addCandidateDatatable.dataTable');
    Route::post('candidates/addToTracker', 'Admin\UserController@addToTracker')->name('users.addToTracker');
    Route::get('ajax/bulk/removeTracker', 'Admin\UserController@removefromTracker')->name('users.removeTracker');
    Route::post('note/addUsersNote', 'Admin\UserController@addUsersNote')->name('users.addUsersNote');
    Route::post('note/updateNote', 'Admin\UserController@updateNote')->name('users.updateNote');

    // ========================================== Talent pool iteration-8 ==========================================
    
    Route::get('users/pool', 'Admin\TalentPoolController@talentPool')->name('talentPool');
    Route::get('talent/pool/getList', 'Admin\TalentPoolController@talentPoolDataTable')->name('talentPool.dataTable');
    Route::get('pool/create', 'Admin\TalentPoolController@poolCreate')->name('pool.create');
    Route::post('pool/store', 'Admin\TalentPoolController@poolStore')->name('pool.store');
    Route::get('pool/{id}/{name}', 'Admin\TalentPoolController@poolInfo')->name('poolInfo');
    Route::get('userPoolDatatable/getList', 'Admin\TalentPoolController@userPoolDatatable')->name('userPool.dataTable');
    Route::get('pool/addJobseeker', 'Admin\TalentPoolController@addJobseekerInPool')->name('addJobseekerInPool');
    Route::get('addJobseekerinPoolDatatable/getList', 'Admin\TalentPoolController@addJobseekerinPoolDatatable')->name('addJobseekerinPool.dataTable');
    Route::post('jobseeker/addInPool', 'Admin\TalentPoolController@addInPool')->name('users.addInPool');
    Route::post('jobseeker/removeFromPool', 'Admin\TalentPoolController@removeFromPool')->name('users.removeFromPool');
    Route::get('ajax/bulk/bulkPool', 'Admin\TalentPoolController@bulkPool')->name('bulkPool');
    Route::post('ajax/bulk/AddBulkJobseekerInPool', 'Admin\TalentPoolController@AddBulkJobseekerInPool')->name('AddBulkJobseekerInPool');
    Route::post('ajax/bulk/jobApplication/AddBulkJobseekerInPool', 'Admin\TalentPoolController@AddBulkJobseekerInPoolJobApp')->name('AddBulkJobseekerInPoolJobApp');

    // ===================================================== jobapplication page Interview Iteration-8 ===================================================== 

    // iteration-8 BulkInterview
    Route::post('ajax/interview/adminInterviewTemplate','Admin\AdminInterviewController@adminInterviewTemplate')->name('adminInterviewTemplate');
    Route::post('ajax/interview/bulkInterviewTemplate','Admin\AdminInterviewController@bulkInterviewTemplate')->name('bulkInterviewTemplate');
    Route::post('bulk/bulkInterview', 'Admin\AdminInterviewController@bulkInterview')->name('bulk.bulkInterview');
    Route::post('ajax/bulk/bulkInterview/send', 'Admin\AdminInterviewController@bulkInterviewSend')->name('bulkIntrerview.send');
    Route::get('jobseeker/interview/{id}', 'Admin\AdminJobsController@jobseekerInterviews')->name('jobseekerInterviews');
    Route::post('ajax/conduct/interview','Admin\AdminJobsController@adminConductInterview')->name('adminConductInterview');
    Route::get('correspondance/interviews/{user_id}/{jobApp_id}', 'Admin\AdminInterviewController@corresInterviewJobApplciation')->name('corresInterviewJobApplciation');
    Route::get('users/list', 'Admin\UserController@verifiedUsers')->name('userslist');

    // ====================================== Admin Online Test iteration-9 ====================================== 

    Route::get('online/test', 'Admin\AdminTestController@onlinetest')->name('onlinetest');
    Route::get('online/test/getList', 'Admin\AdminTestController@onlineTestDataTable')->name('onlineTest.dataTable');
    Route::get('onlineTest/create', 'Admin\AdminTestController@onlineTestCreate')->name('onlineTest.create');
    Route::post('onlineTest/store', 'Admin\AdminTestController@storeOnlineTest')->name('onlineTest.store');
    Route::get('onlineTest/edit/{id}', 'Admin\AdminTestController@onlineTestEdit')->name('onlineTestEdit');
    Route::post('ajax/onlineTest/question/delete', 'Admin\AdminTestController@testQuestionDelete')->name('testQuestionDelete');
    Route::post('ajax/onlineTest/addQuestion', 'Admin\AdminTestController@addOnlineTestQuestion')->name('addOnlineTestQuestion');
    Route::post('onlineTest/update/{id}', 'Admin\AdminTestController@onlineTestUpdate')->name('onlineTest.update');
    Route::get('bulk/bulkTesting', 'Admin\AdminTestController@bulkTesting')->name('bulk.bulkTesting');
    Route::post('ajax/online/bulkTest','Admin\AdminTestController@bulkTestView')->name('bulkTestView');
    Route::post('ajax/online/bulkTest/send', 'Admin\AdminTestController@bulkTestSend')->name('bulkTestView.send');
    Route::get('bulk/bulkTestingJobApp', 'Admin\AdminTestController@bulkTestingJobApp')->name('bulk.bulkTestingJobApp');
    Route::post('ajax/online/bulkTestJobAppSend', 'Admin\AdminTestController@bulkTestJobAppSend')->name('bulkTestJobAppSend.send');
    Route::get('jobApplications/onlineTests', 'Admin\AdminTestController@getOnlineTestJobApplications')->name('getOnlineTestJobApplications');


    // Route::get('users/pool', 'Admin\TalentPoolController@talentPool')->name('talentPool');

    // ====================================== Admin iteration-10+ ======================================

    Route::post('ajax/make-employer-paid', 'Admin\AdminEmployerController@makeEmployerPaid')->name('makeEmployerPaid');
    Route::post('ajax/make-employer-unpaid', 'Admin\AdminEmployerController@makeEmployerUnPaid')->name('makeEmployerUnPaid');

    // ====================================== Admin iteration-11 ====================================== admin/ajax/make-employer-paid

    Route::get('jobseekers/reports', 'Admin\AdminReportsController@jobseeker_reports')->name('jobseekerreports');
    Route::get('employers/reports', 'Admin\AdminReportsController@employer_reports')->name('employer_reports');
    Route::get('job_reports', 'Admin\AdminReportsController@job_reports')->name('job_reports');
    Route::get('job_report/getList', 'Admin\AdminReportsController@getDatatableReport')->name('jobsReport.dataTable');
    Route::get('job_report/{id}', 'Admin\AdminReportsController@viewJobReport')->name('viewJobReport');


    Route::post('ajax/delete/pool', 'Admin\TalentPoolController@deleteTalentPool')->name('deleteTalentPool');
    Route::post('ajax/delete/onlineTest', 'Admin\AdminTestController@deleteOnlineTest')->name('deleteOnlineTest');


    // ====================================== Admin iteration-12 ====================================== admin/ajax/make-employer-paid


    Route::get('jobApplications/application-answers','Admin\AdminJobsController@application_answers')->name('application_answers');



    
});

    // Front End without Authentication
    // User Registeration.
    Route::post('register', 'Site\HomeController@register')->name('register'); // user_register
    // Route::get('step2', 'Site\HomeController@step2')->name('step2');
    Route::post('login', 'Site\HomeController@loginUser')->name('login');

	Route::post('loginUserInterviewInvitation', 'Site\HomeController@loginUserInterviewInvitation')->name('loginUserInterviewInvitation');


    // =============================================== Forget Password ===============================================

    Route::get('forgetPassword', 'Site\HomeController@forgetPassword')->name('forgetPassword');

    // =============================================== Forget Password ===============================================

	//Employer Registeration.
	Route::post('register/employer', 'Site\HomeController@registerEmployer')->name('registerEmployer');
	Route::get('employer/verification', 'Site\HomeController@employerNotVerified')->name('employerNotVerified');
	Route::post('employer/verification', 'Site\HomeController@resendVerificationCode')->name('resendVerificationCode');
	Route::get('employer/verify/{id}/{code}', 'Site\HomeController@accountVerification')->name('accountVerification');

    // Desktop layout only.
    Route::group(array('middleware' => ['devicecheck']), function(){
    Route::get('/', 'Site\HomeController@index')->name('homepage'); 
    Route::get('sign-in', 'Site\HomeController@signIn')->name('signIn'); 
    Route::get('register', 'Site\HomeController@showRegisterPage')->name('register'); 


	// Login.
	Route::get('login', function () { return redirect('/'); });
    Route::post('join', 'Site\HomeController@join')->name('join');
    Route::get('join', function () { return redirect('/'); });

    Route::get('privacy-policy', 'Site\HomeController@privacy')->name('privacy');


    //Employer Registeration.
    // Route::post('register/employer', 'Site\HomeController@registerEmployer')->name('registerEmployer'); // user_register
    // Route::get('employer/verification', 'Site\HomeController@employerNotVerified')->name('employerNotVerified');
    // Route::post('employer/verification', 'Site\HomeController@resendVerificationCode')->name('resendVerificationCode');
    // Route::get('employer/verify/{id}/{code}', 'Site\HomeController@accountVerification')->name('accountVerification');

    Route::get('/unauthorized', function () { return view('unauthorized'); });
    Route::post('ajax/geo_states', 'Site\HomeController@geo_states')->name('ajax_geo_states');
    Route::post('ajax/geo_cities', 'Site\HomeController@geo_cities')->name('ajax_geo_cities');

});
// Front End  with Authentication
Route::group(array('middleware' => ['auth' ,'devicecheck']), function(){
//  jobSeekerProfile  'controlUser'
    Route::get('useridforcontroling/{id}', 'Site\SiteUserController@useridforcontroling')->name('useridforcontroling');
    Route::get('employeridforcontroling/{id}', 'Site\SiteUserController@employeridforcontroling')->name('employeridforcontroling');
    Route::get('logoutRouteForAdmin', 'Site\SiteUserController@logoutRouteForAdmin')->name('logoutRouteForAdmin');
    // InterviewTemplateAddingAsEmployer
    Route::post('ajax/interview/template','Site\EmployerController@interviewTemplate')->name('interviewTemplate');
    Route::post('ajax/conduct/interview','Site\EmployerController@conductInterview')->name('conductInterview');
    Route::post('ajax/live/interview','Site\EmployerController@liveInterview')->name('liveInterview');
    Route::post('ajax/reject/interview/invitation','Site\EmployerController@rejectInterviewInvitation')->name('rejectInterviewInvitation');
    Route::post('ajax/accept/interview/invitation','Site\EmployerController@acceptInterviewInvitation')->name('acceptInterviewInvitation');
    Route::post('ajax/confirmInterInvitation',    'Site\InterviewController@confirmInterInvitation')->name('confirmInterInvitation');
    Route::post('ajax/confirmInterInvitation/js',    'Site\InterviewController@confirmInterInvitationJs')->name('confirmInterInvitationJs');
    Route::post('/ajax/interview-response/uploadVideo','Site\InterviewController@interview_video_reponse')->name('interview_video_reponse');
    Route::post('/ajax/interview-response/delete_video/{id}','Site\InterviewController@interview_delete_video')->name('interview_delete_video');
    Route::post('save/interview/invitation',    'Site\InterviewController@save_jobSeeker_response_interview')->name('save_jobSeeker_response_interview'); 
    // ==========================================================================
    // jobseekerprofile
    // ==========================================================================

    Route::get('profile', function () { return redirect('user/'.Auth::user()->username); })->name('profile');
    Route::get('user/{username}', 'Site\SiteUserController@index')->name('username');
    Route::post('saveUserProfile', 'Site\SiteUserController@updateUserProfile')->name('saveUserProfile');
    Route::post('saveUserPersonalSetting', 'Site\SiteUserController@saveUserPersonalSetting')->name('saveUserPersonalSetting');
    // ======================================= For Updating User Setting =======================================
    Route::get('updateUserPersonalSetting', 'Site\SiteUserController@updateUserPersonalSetting')->name('updateUserPersonalSetting');
    Route::post('ajax/changeUserStatusText', 'Site\SiteUserController@changeUserStatusText');
    Route::post('ajax/update/about_me', 'Site\SiteUserController@updateAboutField');
    Route::post('ajax/update/interested_in', 'Site\SiteUserController@updateInterestedIn');
    
    Route::post('ajax/update/recentJob', 'Site\SiteUserController@updateRecentJob');
    // Added by ALi
    Route::post('ajax/addNewLocation', 'Site\SiteUserController@addNewLoaction');
    // Added by Hassan
    Route::post('ajax/updateSalaryRange', 'Site\SiteUserController@updateSalaryRange');
    Route::post('ajax/updateQualification', 'Site\SiteUserController@updateQualification')->name('updateQualification');
    Route::post('ajax/updateQuestions', 'Site\SiteUserController@updateQuestions');
    Route::post('ajax/booking/deleteInterviewBooking',    'Site\SiteUserController@deleteInterviewBooking')->name('deleteInterviewBooking');
    // ========================== Update Employer Questions ===========================================
    Route::post('ajax/updateEmployerQuestions', 'Site\SiteUserController@updateEmployerQuestions');
    // ========================== Update Employer Questions ===========================================
    Route::post('ajax/updateIndustryExperience', 'Site\SiteUserController@updateIndustryExperience')->name('updateIndustryExperience');
    Route::post('ajax/updateNewJobIndustryExperience', 'Site\EmployerController@updateNewJobIndustryExperience')->name('updateNewJobIndustryExperience');
    Route::post('ajax/updateEmail', 'Site\SiteUserController@updateEmail');
    Route::post('ajax/updatePhone', 'Site\SiteUserController@updatePhone');
    Route::post('ajax/updatePassword', 'Site\SiteUserController@updatePassword');
    Route::post('ajax/deleteuser', 'Site\SiteUserController@deleteuser');
    // Added by Hassan
    Route::get('ajax/getUserPersonalInfo', 'Site\SiteUserController@getUserPersonalInfo');
    Route::post('ajax/uploadUserGallery', 'Site\SiteUserController@uploadUserGallery');
    Route::post('ajax/deleteGallery/{id}', 'Site\SiteUserController@deleteGallery');
    Route::post('ajax/setGalleryPrivateAccess/{id}', 'Site\SiteUserController@setGalleryPrivateAccess');
    Route::post('ajax/setImageAsProfile/{id}', 'Site\SiteUserController@setImageAsProfile');
    Route::post('ajax/userUploadResume', 'Site\SiteUserController@userUploadResume')->name('userUploadResume');
    Route::get('ajax/removeAttachment/', 'Site\SiteUserController@removeAttachment')->name('removeAttachment');
    Route::get('ajax/purchaseUserInfo/', 'Site\SiteUserController@purchaseUserInfo')->name('purchaseUserInfo');
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

    Route::get('ajax/editMultipleFields', 'Site\SiteUserController@editMultipleFields')->name('editMultipleFields');


	// User Step2
	Route::get('step2',       'Site\SiteUserController@step2User')->name('step2User');
	Route::post('step2',      'Site\SiteUserController@Step2');


    // ==========================================================================
    // employerprofile
    // ==========================================================================

    Route::get('employer/profile', function () { return redirect('employer/'.Auth::user()->username); })->name('employerProfile');
    Route::get('employer/step2',       'Site\EmployerController@step2Employer')->name('step2Employer');
    Route::post('employer/step2',      'Site\EmployerController@Step2');
    Route::get('jobSeekers',        'Site\EmployerController@jobSeekers')->name('jobSeekers');
    Route::post('jobSeekersFilter', 'Site\EmployerController@jobSeekersFilter')->name('jobSeekersFilter');
    Route::post('ajax/blockJobSeeker/{id}', 'Site\EmployerController@blockJobSeeker')->name('blockJobSeeker');
    Route::post('ajax/likeJobSeeker/{id}', 'Site\EmployerController@likeJobSeeker')->name('likeJobSeeker');
	Route::get('employers',         'Site\JobSeekerController@employers')->name('employers');
	Route::post('employers',         'Site\JobSeekerController@employerspost')->name('employers');
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
    // jobslisting
    Route::get('jobs', 'Site\SiteUserController@jobs')->name('jobs');
    Route::get('step2Jobs', 'Site\SiteUserController@step2Jobs')->name('step2Jobs');
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

    // employerprofiler
    Route::get('employer/{username}',   'Site\EmployerController@index');
    Route::get('premium-account',       'Site\EmployerController@premiumAccount')->name('premiumAccount');

    //Interview concierge
    Route::get('interviewconcierge',       'Site\InterviewController@index')->name('interviewconcierge');
    Route::get('interviewconcierge/new',       'Site\InterviewController@new')->name('interviewconcierge.new');
    Route::get('interviewconcierge/edit',       'Site\InterviewController@edit')->name('interviewconcierge.edit');
    Route::get('interviewconcierge/edit/{id}',       'Site\InterviewController@editOneBooking')->name('interviewconciergeEdit');
    Route::get('interviewconcierge/created',       'Site\InterviewController@created')->name('interviewconcierge.created');
    Route::get('interviewconcierge/created/url',       'Site\InterviewController@bookingurl')->name('interviewconcierge.url');
    Route::get('interviewconcierge/manualjobseekers',       'Site\InterviewController@manualjobseekers')->name('interviewconcierge.manualjobseekers');
    Route::get('interviewconcierge/formedit','Site\InterviewController@editbookingform')->name('interviewconcierge.formedit');
    Route::get('interviewconcierge/created/unidigitEdit','Site\InterviewController@unidigitEdit')->name('unidigitEditUrl');
    Route::get('interviewconcierge/getlikedlistjobseekers','Site\InterviewController@getlikedjobseekers')->name('interviewconcierge.getlikedlistjobseekers');
    Route::get('interviewconcierge/getlikedlistjobseekersdatatable','Site\InterviewController@getlikedlistjobseekersdatatable')->name('interviewconcierge.getlikedlistjobseekersdatatable');

    //adding new interview booking to the system
    Route::post('ajax/booking/new',    'Site\InterviewController@newInterviewBooking')->name('addNewInterview');
    Route::post('ajax/booking/update',    'Site\InterviewController@updateInterviewBooking')->name('updateInterview');
    Route::post('ajax/booking/firstlogin',    'Site\InterviewController@editInterviewLogin')->name('editInterviewlogin');
    Route::post('ajax/booking/sendnotification',    'Site\InterviewController@sendnotification')->name('sendnotificationInterview');
    Route::post('ajax/booking/manualsendnotification',    'Site\InterviewController@manualsendnotification')->name('manualsendnotification');
    Route::get('interviewconcierge/user',       'Site\InterviewController@userindex')->name('interviewconcierg.user');
    Route::post('ajax/userbooking/login',    'Site\InterviewController@userbookinglogin')->name('userbooking.login');
    Route::post('ajax/update/unidigitEditUpdate','Site\InterviewController@unidigitEditUpdate')->name('unidigitEditUpdate');

    // JobseekerInterviewInvitation

    Route::get('intetview-invitations',       'Site\InterviewController@interviewInvitataion')->name('intetviewInvitation');
    Route::get('intetview-invitation/emp/',       'Site\InterviewController@intetviewInvitationEmp')->name('intetviewInvitationEmp');
    Route::get('unhide/interviews',       'Site\InterviewController@unhideInterviews')->name('unhideInterviews');
    Route::post('ajax/userInterview/hide','Site\InterviewController@hideUserInterview')->name('hideUserInterview');
    Route::post('ajax/userInterview/hide/js','Site\InterviewController@hideUserInterviewJs')->name('hideUserInterviewJs');
    Route::post('ajax/userInterview/unhide','Site\InterviewController@unhideUserInterview')->name('unhideUserInterview');

    // =============================================== Cross Reference ===============================================

    Route::get('crossreference.user','Site\ReferenceController@crossreferenceIndex')->name('crossreference.user');
    Route::post('ajax/crossReference/sendEmailReferee','Site\ReferenceController@sendEmailReferee')->name('sendEmailReferee');

    // =============================================== Save Notes as Admin ===============================================  
    
    Route::post('ajax/saveNote','Site\SiteUserController@saveNote')->name('saveNote');
    Route::post('ajax/deleteNote/{id}', 'Site\SiteUserController@deleteNote')->name('deleteNote');

    // =============================================== Completed Interview as Admin iteration-8  =============================================== 

    Route::get('completed/interviews/{id}', 'Site\InterviewController@completedInterviews')->name('completedInterviews');

    // =============================================== Advertise job iteration-9  =============================================== 

    Route::get('advertise/job/{id}', 'Site\EmployerController@advertiseJob')->name('advertise');
    Route::post('ajax/sendOnlineTest/', 'Site\OnlineTestController@sendOnlineTest')->name('sendOnlineTest');
    Route::get('testing', 'Site\OnlineTestController@testing')->name('testing');
    Route::get('proceed/test/{id}', 'Site\OnlineTestController@proceedTesting')->name('proceedTesting');
    Route::post('ajax/saveQuestion/nextQuestion/{time}', 'Site\OnlineTestController@SaveandNextQuestion')->name('nextQuestion');
    Route::post('ajax/saveQuestion/result/{time}', 'Site\OnlineTestController@saveTestAndResult')->name('saveTestAndResult');
    Route::get('ajax/jobApplication/proceed/{id}', 'Site\OnlineTestController@jobAppProceedTest')->name('jobAppProceedTest');
    Route::get('completed/onlineTests/{id}', 'Site\OnlineTestController@completedOnlineTests')->name('completedOnlineTests');
    Route::post('ajax/reject/test', 'Site\SiteUserController@rejectTest')->name('rejectTest');
    Route::post('ajax/use-previous-result', 'Site\SiteUserController@userPreviousResult')->name('userPreviousResult');
    Route::post('employer/bulk/generatePDF', 'Site\EmployerController@empGeneratePDF')->name('empBulk.GeneratePDF');

    // ================================================ itertaion-11 Talent Matcher ================================================

    Route::get('talent-matcher', 'Site\TalentController@talent_matcher')->name('talent_matcher');
    



});

// Front End With Authentication except step2
// Route::group(array('middleware' => ['auth' ,'devicecheck']), function(){

// 					// Route::get('profile', function () { return redirect('user/'.Auth::user()->username); })->name('profile');
// 					// Route::get('user/{username}', 'Site\SiteUserController@index')->name('username');
// 	    // User
// 					Route::get('step2',       'Site\SiteUserController@step2User')->name('step2User');
// 					Route::post('step2',      'Site\SiteUserController@Step2');

// 					// Jobs
// 					Route::get('step2Jobs', 'Site\SiteUserController@step2Jobs')->name('step2Jobs');

// 					Route::post('ajax/userUploadResume', 'Site\SiteUserController@userUploadResume')->name('userUploadResume');

// 					// Tags
// 					Route::get('ajax/getTags/{category}/{offset?}', 'Site\SiteUserController@getTags');
// 					Route::get('ajax/searchTags', 'Site\SiteUserController@searchTags')->name('searchTags');
// 					Route::post('ajax/addNewTag', 'Site\SiteUserController@addNewTag')->name('addNewTag');
// });

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
Route::get('userinterviewconciergeloggedin/url', 'Site\InterviewController@userurl')->name('userinterviewconciergeloggedin.url');
Route::get('advertise/indeed/{id}', 'Site\HomeController@advertiseOnIndeed')->name('advertiseOnIndeed');
Route::get('advertise/jura/{id}', 'Site\HomeController@advertiseOnJura')->name('advertiseOnJura');


Route::get('phpinfo', function () {

    phpinfo();
     
});





 /*   width: 100%;
    height: 100%;
    background-color: #2f2d2d94;
    position: absolute;
}*/