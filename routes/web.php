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
    return redirect()->route('admin');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/index','SuiveTeController@index')->name('admin');

    Route::get('/index/Allrow','SuiveTeController@Allrow')->name('index.Allrow');

    Route::get('/index/search/{date1}/{date2}','SuiveTeController@search')->name('index.search');

    Route::get('/index/export','SuiveTeController@export')->name('index.export');

    Route::get('/admin',function () {
        return redirect()->route('admin');
    });

    Route::get('/ajouter', 'SuiveTeController@ajouter')->name('ajouter');

    Route::post('/create', 'SuiveTeController@create')->name('create');

    Route::get('/edit/{id}','SuiveTeController@edit')->name('edit');

    Route::put('/update/{id}','SuiveTeController@update')->name('update');

    Route::delete('/delete','SuiveTeController@destroy')->name('delete');

    Route::get('/export', 'SuiveTeController@export')->name('export');

    Route::get('/adduser','UserController@index')->name('adduser');
    
    Route::get('/listuser','UserController@listuser')->name('listuser');

    Route::post('/createuser','UserController@create')->name('createuser');

    Route::get('/newpassword','UserController@edit')->name('newpassword');

    Route::put('/updatepassword','UserController@update')->name('updatepassword');

    Route::delete('/deleteuser','UserController@destroy')->name('deleteuser');

    Route::get('/reinitialiserUserPassword/{id}','UserController@reinitialiserUserPassword')->name('reinitialiserUserPassword');

    Route::put('/reinitialiser/{id}','UserController@reinitialiser')->name('reinitialiser');

    Route::get('/edituser/{id}','UserController@edituser')->name('edituser');

    Route::get('/statistics','SuiveTeController@statistics')->name('statistics');

    Route::put('/updateuser/{id}','UserController@updateuser')->name('updateuser');

});

Auth::routes(['register' => false]);

