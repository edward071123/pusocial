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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');
Route::get('/mypage', 'PostController@mypage')->name('mypage');
Route::get('/userpage/{id}', 'PostController@userpage')->name('userpage');
Route::get('/myfriend', 'PostController@myfriend')->name('myfriend');
Route::post('/search', 'PostController@dosearch');
Route::get('/search', 'PostController@searchview')->name('search');
Route::get('/friend/{id}', 'PostController@friend')->name('friend');
Route::get('/userfriend/{id}', 'PostController@userfriend')->name('userfriend');
Route::get('/myinterest', 'PostController@myinterest')->name('myinterest');
Route::get('/interestcompare', 'PostController@interestcompare')->name('interestcompare');
Route::get('/myalbum', 'PostController@myalbum')->name('myalbum');
Route::get('/album/{id}', 'PostController@album')->name('album');
Route::get('/myalbumphoto/{id}', 'PostController@myalbumphoto')->name('myalbumphoto');
Route::get('/albumphoto/{userid}/{id}', 'PostController@albumphoto')->name('albumphoto');
Route::get('/poll', 'PostController@mypoll')->name('mypoll');

Route::get('/new-post','PostController@create')->name('new-post');
Route::post('/new-post','PostController@store');
Route::get('/edit/{slug}','PostController@edit');
Route::post('/update','PostController@update');

Route::get('/delete/{id}','PostController@destroy');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/my-all-posts','UserController@user_posts_all');
// display user's drafts
Route::get('/my-drafts','UserController@user_posts_draft');
// add comment
Route::post('/comment/add','CommentController@store')->name('comment-add');
// delete comment
Route::get('/comment/delete/{id}','CommentController@destroy');

Route::get('/auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('/show/{id}','ShowController@show');
Route::post('/sendpost','PostController@send_post');
Route::post('/sendcomment','PostController@send_comment');
//users profile
Route::get('/user/{id}','UserController@profile')->where('id', '[0-9]+');
Route::post('/profile','UserController@update_avatar');
Route::post('/addphoto','UserController@addphoto');
// display list of posts
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// display single post
