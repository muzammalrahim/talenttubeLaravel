<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Mobile Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





// Front End  with Authentication
Route::group(array('prefix' => 'm', 'middleware' => ['mobile']), function(){

 Route::get('/', 'Mobile\MobileController@index')->name('mHomepage');
 Route::post('join', 'Mobile\MobileController@join')->name('mJoin');
	Route::get('join', function () { return redirect('/m'); });

	 Route::group(array('middleware' => ['auth']), function(){

	 Route::get('profile', function () { return redirect('m/user/'.Auth::user()->username); })->name('mProfile');
	 Route::get('user/{username}', 'Site\SiteUserController@index')->name('mUsername');



		// User
				Route::get('step2', 'Mobile\MobileUserController@step2User')->name('mStep2User');
				Route::post('step2', 'Mobile\MobileUserController@Step2');

				// video user/employer
				Route::post('ajax/uploadVideo', 'Mobile\MobileUserController@uploadVideo')->name('mUploadVideo');



	// ========================================== Added by Hassan ==========================================

	// ======================================== JOb Seeker's Profile ========================================


	 Route::get('mJobApplications', 'Mobile\MobileUserController@mJobApplications')->name('mJobApplications');
		Route::get('Mjobs', 'Mobile\MobileUserController@Mjobs')->name('Mjobs');
		Route::post('MjobsFilter', 'Mobile\MobileUserController@jobsFilter')->name('MjobsFilter');
		Route::get('Memployers','Mobile\MobileUserController@Memployers')->name('Memployers');
		Route::post('Memployers','Mobile\MobileUserController@Memployerspost')->name('Memployers');
	 Route::get('Memployers/{id}', 'Mobile\MobileUserController@MemployerInfo')->name('MemployerInfo');

	// ======================================== Employer's Profile ========================================

		Route::get('MjobSeekers',        'Mobile\MobileUserController@MjobSeekers')->name('MjobSeekers');
		Route::post('MjobSeekersFilter', 'Mobile\MobileUserController@jobSeekersFilter')->name('MjobSeekersFilter');
	 Route::get('Memployer/jobs',    'Mobile\MobileUserController@MemployerJobs')->name('MemployerJobs');
		Route::get('employer/Mjob/new',    'Mobile\MobileUserController@MnewJob')->name('MnewJob');
		Route::post('ajax/job/mnew',    'Mobile\MobileUserController@addNewJob')->name('addMNewJob');
	 Route::get('Mblock',         'Mobile\MobileUserController@MblockList')->name('MblockList');
	 Route::get('Mlike',         'Mobile\MobileUserController@MlikeList')->name('MlikeList');
	 Route::get('Mmutual-likes',         'Mobile\MobileUserController@MmutualLikes')->name('MmutualLikes');
	 Route::get('MupdateUserPersonalSetting', 'Mobile\MobileUserController@MupdateUserPersonalSetting')->name('MupdateUserPersonalSetting');
	 Route::get('Mcredit',       'Mobile\MobileUserController@Mcredit')->name('Mcredit');
	 Route::get('Mjobs/{id}', 'Mobile\MobileUserController@MjobDetail')->name('MjobDetail');
	 Route::get('MjobSeekers/{id}', 'Mobile\MobileUserController@MjobSeekersInfo')->name('MjobSeekersInfo');

	// ============================================ Jobs ============================================
	// Job ApplyInfo Modal

	 Route::get('ajax/MjobApplyInfo/{id}', 'Mobile\MobileUserController@MjobApplyInfo')->name('MjobApplyInfo');

	 // Route::get('ajax/MjobApplyInfo/{id}', 'Mobile\MobileUserController@MjobApplyInfoAjax')->name('MjobApplyInfoAjax');

	 // Job Application Submission
	 Route::post('ajax/MjobApplySubmit', 'Mobile\MobileUserController@MjobApplySubmit')->name('MjobApplySubmit');

	 // ================================================= Job Seeker =================================================
     Route::post('ajax/MupdateInterested_in', 'Mobile\MobileUserController@MupdateInterested_in')->name('MupdateInterested_in');
     Route::post('ajax/Mabout_me', 'Mobile\MobileUserController@Mabout_me')->name('Mabout_me');
     Route::post('ajax/MupdateQualification', 'Mobile\MobileUserController@MupdateQualification')->name('MupdateQualification');
     Route::post('ajax/MupdateIndustryExperience', 'Mobile\MobileUserController@MupdateIndustryExperience')->name('MupdateIndustryExperience');
     Route::post('ajax/MupdateQuestions', 'Mobile\MobileUserController@MupdateQuestions');

     //================================================= Ajax for liking/Blocking employer =================================================

    Route::post('ajax/MlikeEmployer/{id}', 'Mobile\MobileUserController@MlikeEmployer')->name('MlikeEmployer');
    Route::post('ajax/MunLikeUser/{id}', 'Mobile\MobileUserController@MunLikeUser')->name('MunLikeUser/{id}');
    Route::post('ajax/MblockEmployer/{id}', 'Mobile\MobileUserController@MblockEmployer')->name('MblockEmployer');
    Route::post('ajax/MunBlockUser/{id}', 'Mobile\MobileUserController@MunBlockUser')->name('MunBlockUser');

	 // ================================================= Employer =================================================

     Route::post('ajax/MupdateInterested_inEmp', 'Mobile\MobileEmployerController@MupdateInterested_inEmp')->name('MupdateInterested_inEmp');
     Route::post('ajax/Mabout_meEmp', 'Mobile\MobileEmployerController@Mabout_meEmp')->name('Mabout_meEmp');
     Route::post('ajax/MupdateQuestionsEmp', 'Mobile\MobileEmployerController@MupdateQuestionsEmp');

     //================================================= Ajax for liking/Blocking JS =================================================

     Route::post('ajax/MlikeJS/{id}', 'Mobile\MobileEmployerController@MlikeJS')->name('MlikeJS');
 	 Route::post('ajax/MunLikeJS/{id}', 'Mobile\MobileEmployerController@MunLikeJS')->name('MunLikeJS/{id}');
     Route::post('ajax/MblockJS/{id}', 'Mobile\MobileEmployerController@MblockJS')->name('MblockJS');

     // =========================================== Update Job Seeker Personal Setting ==============================================

    Route::post('ajax/MupdateEmail', 'Mobile\MobileUserController@MupdateEmail');
    Route::post('ajax/MupdatePhone', 'Mobile\MobileUserController@MupdatePhone');
    Route::post('ajax/MupdatePassword', 'Mobile\MobileUserController@MupdatePassword');
    Route::post('ajax/Mdeleteuser', 'Mobile\MobileUserController@Mdeleteuser');


	// ======================================= For Updating User Setting =======================================

	Route::get('step2', 'Mobile\MobileUserController@step2User')->name('mStep2User');
    Route::get('profile', function () { return redirect('m/user/'.Auth::user()->username); })->name('mProfile');
    Route::get('user/{username}', 'Site\SiteUserController@index')->name('mUsername');
    Route::get('jobs', 'Site\SiteUserController@jobs')->name('mJobs');
    Route::get('jobSeekers',        'Site\EmployerController@jobSeekers')->name('mJobSeekers');



 });

});



// Front End without Authentication
// Route::get('login', function () { return redirect('/'); });
// Route::post('login', 'Site\HomeController@loginUser')->name('login');
// Route::post('join', 'Site\HomeController@join')->name('join');
// Route::get('join', function () { return redirect('/'); });




// Akmal routes work.

// Front End modile layout only
Route::group(array('prefix' => 'm', 'middleware' => ['mobile']), function(){

	// Front End  mobile with Authentication
 Route::group(array('middleware' => ['auth']), function(){

	});

	Route::post('ajax/userUploadResume', 'Mobile\MobileUserController@userUploadResume')->name('mUserUploadResume');

	// Tags
	Route::get('ajax/getTags/{category}/{offset?}', 'Site\SiteUserController@getTags');
	Route::get('ajax/searchTags', 'Site\SiteUserController@searchTags')->name('mSearchTags');
	Route::post('ajax/addNewTag', 'Site\SiteUserController@addNewTag')->name('mAddNewTag');

	// Jobs
	Route::get('step2Jobs', 'Mobile\MobileUserController@step2Jobs')->name('mStep2Jobs');

	// Employer
	Route::get('employer/profile', function () { return redirect('employer/'.Auth::user()->username); })->name('mEmployerProfile');
	Route::get('employer/step2',       'Site\EmployerController@step2Employer')->name('mStep2Employer');
	Route::post('employer/step2',      'Site\EmployerController@Step2');




});

// Akmal routes work.







