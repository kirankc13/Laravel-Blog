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


Route::prefix('/admin/'.env('ADMIN_URL_SECRET'))->group(function() {
    Route::group(['middleware' => ['auth','CheckUserStatus']], function() {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('permissions-data','PermissionController@DatatableAjax')->name('permissions.data');
        Route::resource('users', UserController::class);
        Route::get('user-data','UserController@DatatableAjax')->name('users.data');
        Route::get('roles-data','RoleController@DatatableAjax')->name('roles.data');
        Route::post('permissions/destroy','PermissionController@destroy')->name('permissions.destroy');
        Route::post('roles/destroy','RoleController@destroy')->name('roles.destroy');
        Route::post('users/destroy','UserController@destroy')->name('users.destroy');

        //Update Profile
        Route::get('update-profile','ProfileController@MyProfile')->name('my.profile');
        Route::post('update-profile','ProfileController@UpdateProfile')->name('update.profile');
        Route::post('change_password','ProfileController@ChangePassword')->name('profile.change_password');
    });
});


