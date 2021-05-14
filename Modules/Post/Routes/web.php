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


Route::prefix('admin/'.env('ADMIN_URL_SECRET'))->group(function() {
    Route::group(['middleware' => ['auth','CheckUserStatus']], function() {
        Route::resource('categories', CategoryController::class);
        Route::post('categories/destroy','CategoryController@destroy')->name('categories.destroy');
        Route::post('categories/order_by','CategoryController@OrderBy')->name('categories.order_by');
        Route::get('categories-data','CategoryController@DatatableAjax')->name('categories.data');

        Route::resource('tags', 'TagsController');
        Route::post('tags/destroy','TagsController@destroy')->name('tags.destroy');
        Route::get('tags-data','TagsController@DatatableAjax')->name('tags.data');

        Route::get('posts', 'PostController@index')->name('posts.index');
        Route::get('posts/show/{id}', 'PostController@show')->name('posts.show');
        Route::post('posts/destroy','PostController@destroy')->name('posts.destroy');
        Route::post('posts/publish/{id}','PostController@PublishPost')->name('posts.publish');
        Route::post('posts/feature/{id}','PostController@TogglePostFeatured')->name('posts.feature');
        Route::post('posts/status/{id}','PostController@TogglePostStatus')->name('posts.status');
        Route::get('posts-data','PostController@DatatableAjax')->name('posts.data');
        Route::post('posts/upload/image', 'PostController@EditorUpload')->name('posts.upload_image');

        Route::resource('post-tasks', PostTaskController::class);
        Route::post('post-tasks/send-for-update','PostTaskController@SendForUpdate')->name('post-tasks.send-for-update');
        Route::post('post-tasks/change-task-status','PostTaskController@ChangeTaskStatus')->name('post-tasks.change-task-status');
        Route::get('post-tasks-data','PostTaskController@DatatableAjax')->name('post-tasks.data');
        Route::get('post-tasks/{id}/activity/{log_id}','PostTaskController@ActivityShow')->name('post-tasks.activity_show')->middleware('can:posts-view-task-logs');
        Route::get('post-tasks-current-task-status','PostTaskController@GetCurrentTaskStatus')->name('post-tasks.get_current_task_status');
        Route::post('post-tasks/destroy','PostTaskController@destroy')->name('post-tasks.destroy');
    });
});
