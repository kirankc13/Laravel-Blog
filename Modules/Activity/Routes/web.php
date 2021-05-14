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

Route::prefix('admin/'.env('ADMIN_URL_SECRET'))->middleware(['auth','CheckUserStatus'])->group(function() {
    Route::get('/activity', 'ActivityController@index')->name('activity.index');
    Route::get('activity/{id}/show','ActivityController@show')->name('activity.show');
    Route::get('activity-data','ActivityController@DatatableAjax')->name('activity.data');
    Route::post('activity/destroy','ActivityController@destroy')->name('activity.destroy');    
});
