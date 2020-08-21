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

use App\User;
use App\Models\Exam;
Route::group(['namespace'=>'Quiz','middleware'=>'auth'],function(){
    Route::get('Start','QuizController@showExamName')->name('Test.Start');
    //Route::get('Quiz','QuizController@getindex')->name('Test.Quiz');
    Route::any('Quiz','QuizController@index')->name('Test.Quiz');
    Route::post('Save','QuizController@store')->name('Test.store');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

