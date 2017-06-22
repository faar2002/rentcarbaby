<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo "listo cache";
});

Route::get('/clear-config', function() {
    $exitCode = Artisan::call('config:clear');
     echo "listo config";
});

Route::get('/', [
    'uses'  =>'HomeController@index',
    'as'    =>'home'
    ]);

// Authentication routes...
//Route::get('login', 'Auth\AuthController@getLogin');
Route::get('login', [
    'uses'  =>'Auth\AuthController@getLogin',
    'as'    =>'login'  
]);

Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('register', 'Auth\AuthController@getRegister');
Route::get('register', [
    'uses'  =>'Auth\AuthController@getRegister',
    'as'    =>'register'
    ]);

Route::post('register', 'Auth\AuthController@postRegister');

Route::get('confirmation/{token}', [
    'uses'  =>'Auth\AuthController@getConfirmation',
    'as'    =>'confirmation'
    ]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' => 'auth'],function(){
    
    Route::get('account', function(){
       return view('account'); 
    });
    
    Route::get('account/password','AccountController@getPassword');
    
    Route::post('account/password','AccountController@postPassword');
    
    Route::get('account/edit-profile', 'AccountController@editProfile');
    
    Route::post('account/edit-profile', 'AccountController@updateProfile');
    
    Route::group(['middleware' => 'role:superadmin'],function(){
        
        Route::get('account/list-user', 'AccountController@listUser');
        
        Route::get('user/edite/{user}','AccountController@edituser')->where('user','[0-9]+');
        
        Route::get('admin/settings', function(){
            return view('admin/settings'); 
        });
        
    });
    
    Route::group(['middleware' => 'role:editor'],function(){
    
        Route::get('admin/posts', function(){
           return view('admin/posts'); 
        });
    });
    
    Route::group(['middleware' => 'verifield'],function(){
        
        Route::get('publish', function(){
           return view('publish'); 
        });
        
        Route::post('publish', function(){
           return Request::all(); 
        });
    });
});