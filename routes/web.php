<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'auth'],function(){
    
//Users routes
Route::prefix('users')->group(function(){
    Route::get('/view', 'Backend\UserController@view')->name('users.view');
    Route::get('/add', 'Backend\UserController@add')->name('users.add');
    Route::post('/store', 'Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
    Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
});


//profile routes
Route::prefix('profiles')->group(function(){
    Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
    Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
    Route::post('/update', 'Backend\ProfileController@update')->name('profiles.update');
    Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
    Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
});


//Setup Manage
Route::prefix('setups')->group(function(){
    Route::get('/student/class/view', 'Backend\UserController@view')->name('setups.student.class.view');
    Route::get('/student/class/add', 'Backend\UserController@add')->name('setups.student.class.add');
    Route::post('/student/class/store', 'Backend\UserController@store')->name('setups.student.class.store');
    Route::get('/student/class/edit/{id}', 'Backend\UserController@edit')->name('setups.student.class.edit');
    Route::post('/student/class/update/{id}', 'Backend\UserController@update')->name('setups.student.class.update');
    Route::get('/student/class/delete/{id}', 'Backend\UserController@delete')->name('setups.student.class.delete');
});

});

