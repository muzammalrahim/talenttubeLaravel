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

// ======================================== Added by Hassan ========================================

// ======================================== JOb Seeker's Profile ========================================

 Route::get('mJobApplications', 'Mobile\MobileUserController@mJobApplications')->name('mJobApplications');
 Route::get('Mjobs', 'Mobile\MobileUserController@Mjobs')->name('Mjobs');
 Route::get('Memployers','Mobile\MobileUserController@Memployers')->name('Memployers');
 Route::get('MemployerInfo/{id}', 'Mobile\MobileUserController@MemployerInfo')->name('MemployerInfo');

// ======================================== Employer's Profile ========================================

 Route::get('MjobSeekers',        'Mobile\MobileUserController@MjobSeekers')->name('MjobSeekers');
 Route::get('Memployer/jobs',    'Mobile\MobileUserController@MemployerJobs')->name('MemployerJobs');
 Route::get('employer/Mjob/new',    'Mobile\MobileUserController@MnewJob')->name('MnewJob');
 Route::get('Mblock',         'Mobile\MobileUserController@MblockList')->name('MblockList');
 Route::get('Mlike',         'Mobile\MobileUserController@MlikeList')->name('MlikeList');
 Route::get('Mmutual-likes',         'Mobile\MobileUserController@MmutualLikes')->name('MmutualLikes');
 Route::get('MupdateUserPersonalSetting', 'Mobile\MobileUserController@MupdateUserPersonalSetting')->name('MupdateUserPersonalSetting');
 Route::get('Mcredit',       'Mobile\MobileUserController@Mcredit')->name('Mcredit');




 });



});



// Front End without Authentication
// Route::get('login', function () { return redirect('/'); });
// Route::post('login', 'Site\HomeController@loginUser')->name('login');
// Route::post('join', 'Site\HomeController@join')->name('join'); 
// Route::get('join', function () { return redirect('/'); });
 



 



 


 