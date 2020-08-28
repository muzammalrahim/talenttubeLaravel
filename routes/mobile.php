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

		// ======================================= For Updating User Setting =======================================

		// User
				Route::get('step2', 'Mobile\MobileUserController@step2User')->name('mStep2User');
				Route::post('step2', 'Mobile\MobileUserController@Step2');


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
 



 



 


 