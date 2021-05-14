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

use App\Http\Controllers\Controller;

Route::prefix('admin/'.env('ADMIN_URL_SECRET'))->group(function() {
    Route::group(['middleware' => ['auth','CheckUserStatus']], function() {
        Route::resource('configuration-fields', ConfigurationFieldController::class);
        Route::post('configuration-fields/destroy','ConfigurationFieldController@destroy')->name('configuration-fields.destroy');
        Route::get('configuration-fields-data','ConfigurationFieldController@DatatableAjax')->name('configuration-fields.data');
        Route::get('configuration-update','UpdateSystemConfigurationController@index')->name('configuration-update.index');
        Route::post('configuration-update/update','UpdateSystemConfigurationController@update')->name('configuration-update.update');
        Route::post('configuration-update.destroy_file','UpdateSystemConfigurationController@DestroyFile')->name('configuration-update.destroy_file');
        Route::post('editor-image/upload', [Controller::class ,'UploadEditorImage'])->name('editor.upload_image');

        Route::resource('pages', PageController::class);
        Route::post('pages/destroy','PageController@destroy')->name('pages.destroy');
        Route::get('pages-data','PageController@DatatableAjax')->name('pages.data');


        Route::resource('messages', MessagesController::class);
        Route::get('messages-data','MessagesController@DatatableAjax')->name('messages.data');
        Route::post('messages/destroy','MessagesController@destroy')->name('messages.destroy');
        Route::resource('newsletter', NewsletterController::class);
        Route::get('newsletter-data','NewsletterController@DatatableAjax')->name('newsletter.data');
        Route::post('newsletter/destroy','NewsletterController@destroy')->name('newsletter.destroy');

        Route::prefix('dashboard')->group(function() {
            Route::get('/','DashboardController@index')->name('dashboard.index');
            Route::get('/fetch/sessions/views/users','DashboardController@FetchSessionsViewsUsers')->name('dashboard.fetch_sessions_views_users')->middleware('can:analytics-widgets');
            Route::get('/fetch/top/referrers','DashboardController@FetchTopReferrers')->name('dashboard.fetch_top_referrers')->middleware('can:analytics-widgets');
            Route::get('fetch/most/visited/pages','DashboardController@FetchMostVisitedPage')->name('dashboard.fetch_most_visited_pages')->middleware('can:analytics-widgets');
            Route::get('fetch/user/types','DashboardController@FetchUserType')->name('dashboard.fetch_user_types')->middleware('can:analytics-widgets');
            Route::get('fetch/real/time/user','DashboardController@FetchRealTimeUser')->name('dashboard.fetch_real_time_user')->middleware('can:analytics-widgets');
        });
    });
});
