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
// Home

use \App\Models\User;
use \App\Models\Post;
Route::view('/', 'pages.index');
// Pages
Route::view('/home', 'pages.index');
Route::view('/about', 'pages.about');
Route::get('/search', 'SearchResultsController@search');
Route::get('/news', 'NewsController@show');
Route::get('/leaderboard', 'LeaderboardController@show');
Route::get('/question/{id}', 'QuestionController@show');
Route::get('/profile/{id}', 'ProfileController@show');
Route::get('administration', 'AdministrationController@show')->middleware('role:moderator');
Route::view('ask_question', 'pages.ask_question')->middleware('auth');

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// TODO remove
Route::get('/test', function() {
  $user = User::find(1);
  $post = Post::find(1);
  echo $user->getTopicParticipation();
  // echo $post->parentQuestion;
});