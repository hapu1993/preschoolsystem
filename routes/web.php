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
    return redirect('/home');
});
Auth::routes();
Route::post('/login', [
    'uses'          => 'Auth\LoginController@login',
    'middleware'    => 'checkrole',
]);



Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/absent', 'AbsentController@index')->name('absent')->middleware('absent');
    Route::post('/absent/store', 'AbsentController@store')->name('absent.store')->middleware('absent');
    Route::get('/absent/list', 'AbsentController@list')->name('absent.list')->middleware('absent-list');

    Route::get('/record-attendence', 'AttendenceController@index')->name('attendence')->middleware('attendence.record');
    Route::post('/record-attendence/store', 'AttendenceController@store')->name('attendence.store');
    Route::get('/load-attendence', 'AttendenceController@loadAttendence')->name('attendence.load')->middleware('attendence.record');
    Route::get('/attendence-table', 'AttendenceController@loadAttendenceTableView')->name('attendence.table.list')->middleware('attendence.view');
    Route::get('/attendence-view', 'AttendenceController@attendenceViewCalender')->name('attendence.calender.list')->middleware('attendence.calender.view');


    Route::get('/attendence-load-by-student', 'AttendenceController@loadAttendencebyReg')->name('attendence.load.reg')->middleware('attendence.calender.view');

});

