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
    return redirect('/home');   // redirect เป็นการบังคับวิ่งเข้าหน้า web
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/ExportPDF', 'DatacarController@ReportPDF');
    Route::get('/ExportPDFIndex', 'DatacarController@ReportPDFIndex');
    Route::get('/datacar/viewsee/{id}/{car_type}', 'DatacarController@viewsee')->name('datacar.viewsee');
    Route::get('/datacar/view/{type}', 'DatacarController@index')->name('datacar');
    Route::get('/datacar/create/{type}', 'DatacarController@create')->name('datacar.create');
    Route::post('/datacar/store', 'DatacarController@store')->name('datacar.store');
    Route::get('/datacar/edit/{id}/{car_type}', 'DatacarController@edit')->name('datacar.edit');
    Route::patch('/datacar/update/{id}', 'DatacarController@update')->name('datacar.update');
    Route::patch('/datacar/updateinfo/{id}', 'DatacarController@updateinfo')->name('datacar.updateinfo');
    Route::delete('/datacar/delete/{id}', 'DatacarController@destroy')->name('datacar.destroy');
    Route::get('/datacar/Savestore/{Str1}/{Str2}/{type}', 'DatacarController@Savestore')->name('datacar.Savestore');

    route::resource('reportBetween','ReportController');
    Route::get('/datacar/viewreport/{type}', 'ReportController@index')->name('datacarreport');
    Route::get('/ExportStockcar', 'ReportController@ReportStockcar');
    Route::get('/Report/Home/{type}', 'ReportController@index')->name('report');
    
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');
});