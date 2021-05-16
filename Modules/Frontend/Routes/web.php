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

Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.xml');
Route::get('/sitemap_{id}.xml', 'SitemapController@sitemap');
Route::get('/rss.xml', 'SitemapController@RSS');

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/search','FrontendController@Search')->name('search');
Route::get('page/{slug}','FrontendController@Page')->name('page');
Route::get('/{category_slug}','FrontendController@Category')->name('category');
Route::get('author/{username}','FrontendController@Author')->name('author');
Route::get('tag/{tag}','FrontendController@Tag')->name('tag');
Route::get('/{category_slug}/{slug}','FrontendController@Post')->name('post');
Route::get('/amp/{category_slug}/{slug}','FrontendController@AmpPost')->name('amp.post');
Route::post('subscribe','FrontendController@Subscription')->name('subscribe');
Route::post('amp/subscribe','FrontendController@AmpSubscription')->name('amp.subscribe');



Route::prefix('admin/'.env('ADMIN_URL_SECRET'))->group(function() {
    Route::group(['middleware' => ['auth','CheckUserStatus']], function() {
        Route::get('preview/post/{id}','FrontendController@Preview')->name('preview');
        Route::get('preview/{category_slug}/{slug}','FrontendController@PreviewPost')->name('preview.post');
    });
});


Route::get('add/to/category','FrontendController@AddToCategory');
Route::get('add/to/post','FrontendController@AddToPost');
Route::get('add/to/user','FrontendController@AddToUsers');
Route::get('add/to/contacts','FrontendController@AddToContacts');


