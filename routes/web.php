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
use \App\Models\User;
use \App\Models\Question;
use \App\Models\Post;
use \App\Models\Comment;

Route::view('/', 'pages.index');
// Pages
Route::view('/home', 'pages.index')->name('home');
Route::view('/about', 'pages.about');
Route::get('/news', 'NewsController@show');
Route::get('/leaderboard', 'LeaderboardController@show');
Route::get('/question/{id}', 'QuestionController@show');
Route::get('/profile/{id}', 'UserController@show')->name('profile');
Route::get('administration', 'AdministrationController@show')->middleware('role:moderator');

// Posts
Route::post('/ask', 'QuestionController@store')->name('ask');
Route::get('/ask', 'QuestionController@create')->middleware('auth');
Route::post('/question/{id}/close', 'QuestionController@close')->middleware('auth');
Route::put('/question/{id}/answer', 'AnswerController@create');
Route::get('/search', 'SearchResultsController@search');
Route::get('/search/tag/{name}', 'SearchResultsController@searchTag');
Route::post('/question/{id}/delete', 'QuestionController@delete')->middleware('auth');

// API
Route::get('/api/questions', 'SearchResultsController@searchApi'); // TODO
Route::get('/api/user', 'UserController@showApi');
Route::post('api/comments', 'CommentController@create');
Route::patch('api/comments/{id}', 'CommentController@update');
Route::put('api/{id}/vote/', 'VoteController@create');
Route::delete('api/{id}/vote/', 'VoteController@delete');
Route::delete('/api/notifications/{id}', 'NotificationController@delete');

//Ajax
Route::post('ajax/comment', 'AjaxController@add_comment');
Route::post('ajax/edit_proposal', 'AjaxController@proccess_edit_proposal');
Route::post('ajax/topic_proposal', 'AjaxController@proccess_topic_proposal');

// User
Route::delete('user', 'UserController@delete')->name('user');
Route::get('user', 'UserController@showOwn');
Route::get('user/edit', 'UserController@edit')->middleware('auth');
Route::patch('user', 'UserController@update')->name('update_user');
Route::post('users/{id}/ban', 'UserController@ban')->middleware('role:administrator')->name('ban_user');
Route::post('/user/{post_id}/report', 'UserController@report')->middleware('auth');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // TODO
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// TODO remove
Route::get('/test', function() {
  $a = Question::search("python array");
  dd($a->get());
});

Route::fallback(function() {
  /** This will check for the 404 view page unders /resources/views/errors/404 route */
  return view('errors.404');
});

Route::get('/linkstorage', function () {
  Artisan::call('storage:link');
});