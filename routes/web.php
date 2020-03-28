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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/absent', 'AbsentController@index')->name('absent')->middleware('absent');
    Route::post('/absent/store', 'AbsentController@store')->name('absent.store')->middleware('absent');


    Route::get('/record-attendence', 'AttendenceController@index')->name('attendence')->middleware('attendence.record');
    Route::post('/record-attendence/store', 'AttendenceController@store')->name('attendence.store');
    Route::get('/load-attendence', 'AttendenceController@loadAttendence')->name('attendence.load')->middleware('attendence.record');


});

