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
Route::get('/search', 'SearchResultsController@search');
Route::get('/news', 'NewsController@show');
Route::get('/leaderboard', 'LeaderboardController@show');
Route::get('/question/{id}', 'QuestionController@show');
Route::get('/profile/{id}', 'UserController@show')->name('profile');
Route::get('administration', 'AdministrationController@show')->middleware('role:moderator');

// Posts
Route::post('/user/ask', 'QuestionController@store')->name('ask');
Route::get('/user/ask', 'QuestionController@create')->middleware('auth');

// API
Route::get('/api/questions', 'SearchResultsController@searchApi');
Route::get('/api/user', 'UserController@showApi');
Route::post('api/comments', 'CommentController@create');
Route::patch('api/comments/{id}', 'CommentController@update');
Route::put('api/{id}/vote/', 'VoteController@create');
Route::delete('api/{id}/vote/', 'VoteController@delete');

//Ajax
Route::post('ajax/comment', 'AjaxController@add_comment');

// User
Route::delete('user', 'UserController@delete')->name('user');
Route::get('user', 'UserController@showOwn');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // TODO
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// TODO remove
Route::get('/test', function() {
  $questions = Question::search("python")->orderBy('bounty', 'DESC')->get();
  foreach($questions as $q) {
    echo($q);
    echo "<br>";
  }
});
