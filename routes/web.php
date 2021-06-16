<?php

use Illuminate\Support\Facades\Route;

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





Route::group(['middleware' => 'auth'], function () {
    Route::resource('/quiz', 'QuizController');
    Route::resource('/quiz/{quiz}/question', 'QuestionController');
    Route::get('/change-question-order', 'QuestionController@ChangeOrder');
    Route::get('/login/logout','LoginController@logout')->name('logout');
    Route::resource('/invite','InviteController');
    Route::get('/results','ResultController@index')->name('results');
    Route::get('/result/{id}','ResultController@show')->name('result');
    Route::get('/profile','ProfileController@index')->name('profile');
    Route::post('/profile/passchange','ProfileController@passchange')->name('profile.passchange');
    Route::post('/profile/mailchange','ProfileController@mailchange')->name('profile.mailchange');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login','LoginController@index')->name("login");
    Route::post('/login/checklogin','LoginController@checklogin');

    Route::get('/register','RegisterController@index')->name("register");
    Route::post('/register/checkregister','RegisterController@checkregister');

    Route::get('/forgot-password','LoginController@passforgot')->name('password.request');
    Route::post('/forgot-password', 'LoginController@passforgotwithrequest')->name('password.email');
    Route::get('/reset-password/{token}', 'LoginController@passresetwithtoken')->name('password.reset');
    Route::post('/reset-password', 'LoginController@passreset')->name('password.update');
});




Route::get('/check_quiz','QuizController@check_quiz_page')->name('check_quiz');
Route::post('/checkcodeform','QuizController@check_quiz_withform');
Route::get('/checkcodeurl/{quizcode}','QuizController@check_quiz_withlink');
Route::get('/quizs/{quizcode}/join','QuizController@join')->name('join');
Route::post('/getjoinner','QuizController@getjoinner');

Route::get('/quizs/{quizcode}/start/{token}','QuizController@start')->name('start');

Route::get('/quizs/{quizcode}/finish/{token}','QuizController@finish')->name('finish');




Route::get('/','QuizController@index')->middleware('auth')->name('home');
