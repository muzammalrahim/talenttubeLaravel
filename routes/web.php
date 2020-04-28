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
Auth::routes();


// Backend Admin with out Authentication
Route::get('admin', 'Admin\AdminController@index');
Route::post('admin/login', 'Admin\AdminController@login');


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
    Route::get('profile', 'Site\HomeController@profile')->name('profile');

});


// Front End without Authentication
Route::get('/', 'Site\HomeController@index')->name('homepage');
Route::post('login', 'Site\HomeController@loginUser')->name('login');
Route::post('join', 'Site\HomeController@join')->name('join');



Route::get('/unauthorized', function () { return view('unauthorized'); });
Route::get('/test', function () { return view('welcome'); });
// Route::get('/home', function() {  return view('home'); })->name('home')->middleware('auth');





// Localization
Route::get('/js/lang.js', function () {
    // $files   = glob(resource_path('lang/en/*.php'));
    // dd($files); exit;

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




Route::get('/clear', function() {
    $cache = Artisan::call('cache:clear');
    $view = Artisan::call('view:clear');

    dump(' cache = '.$cache);
    dump(' view = '.$view);
});
