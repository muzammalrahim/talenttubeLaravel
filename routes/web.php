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
 

Auth::routes();
Route::get('/clear', function() {
    $cache = Artisan::call('cache:clear');
    $view = Artisan::call('view:clear');
    dump(' cache = '.$cache);
    dd(' view = '.$view);
});


 

// Route::get('images/user/{userid}/{any}', [
//     'as'         => 'images.show',
//     'uses'       => 'Site\HomeController@imgshow',
//     'middleware' => 'auth',
// ])->where('any', '.*');

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

    Route::get('users', 'Admin\UserController@index')->name('users');
    Route::get('users/create', 'Admin\UserController@create')->name('users.create');
    Route::get('users/edit/{id}', 'Admin\UserController@edit')->name('users.edit');
    Route::post('users/create', 'Admin\UserController@store')->name('users.store');
    Route::patch('users/update/{id}', 'Admin\UserController@update')->name('users.update');

    Route::get('users/getList', 'Admin\UserController@getDatatable')->name('users.dataTable');

    Route::get('employers', 'Admin\UserController@employers');
    Route::get('employers/edit/{id}', 'Admin\UserController@editEmployer')->name('employers.edit');
    Route::patch('employers/update/{id}', 'Admin\UserController@updateEmployer')->name('employers.update');

    Route::get('employers/getList', 'Admin\UserController@getEmployerDatatable')->name('employers.dataTable');


});




// Front End  with Authentication
Route::group(array('middleware' => 'auth'), function(){
    // Route::get('profile', 'Site\HomeController@profile')->name('profile');
    // Route::get('profile', 'Site\HomeController@profile')->name('profile');
    Route::get('profile', function () { 
        // dd();
        return redirect(Auth::user()->username);
    })->name('profile');
     
    Route::get('{username}', 'Site\SiteUserController@index')->name('username');
    Route::post('saveUserProfile', 'Site\SiteUserController@updateUserProfile')->name('saveUserProfile');
    Route::post('saveUserPersonalSetting', 'Site\SiteUserController@saveUserPersonalSetting')->name('saveUserPersonalSetting');
    
   

    Route::post('ajax/changeUserStatusText', 'Site\SiteUserController@changeUserStatusText');
    Route::get('ajax/getUserPersonalInfo', 'Site\SiteUserController@getUserPersonalInfo');
    Route::post('ajax/update_about_field', 'Site\SiteUserController@updateAboutField');
    Route::post('ajax/uploadUserGallery', 'Site\SiteUserController@uploadUserGallery');
    Route::post('ajax/deleteGallery/{id}', 'Site\SiteUserController@deleteGallery');
    Route::post('ajax/setGalleryPrivateAccess/{id}', 'Site\SiteUserController@setGalleryPrivateAccess');
    Route::post('ajax/setImageAsProfile/{id}', 'Site\SiteUserController@setImageAsProfile');

    Route::post('ajax/userUploadResume', 'Site\SiteUserController@userUploadResume')->name('userUploadResume');
    Route::post('ajax/removeAttachment/', 'Site\SiteUserController@removeAttachment')->name('removeAttachment');

    // activity 
    Route::post('ajax/saveNewActivity', 'Site\SiteUserController@saveNewActivity')->name('saveNewActivity');

    // video 
    Route::post('ajax/uploadVideo', 'Site\SiteUserController@uploadVideo')->name('uploadVideo');
    Route::post('ajax/deleteVideo', 'Site\SiteUserController@deleteVideo')->name('deleteVideo');
    
});


// Front End without Authentication
Route::get('/', 'Site\HomeController@index')->name('homepage');
Route::post('login', 'Site\HomeController@loginUser')->name('login');
Route::post('join', 'Site\HomeController@join')->name('join');

Route::post('register', 'Site\HomeController@register')->name('register'); // user_register
Route::get('step2', 'Site\HomeController@step2')->name('step2');



Route::get('/unauthorized', function () { return view('unauthorized'); });
 

Route::post('ajax/geo_states', 'Site\HomeController@geo_states')->name('ajax_geo_states');
Route::post('ajax/geo_cities', 'Site\HomeController@geo_cities')->name('ajax_geo_cities');



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


