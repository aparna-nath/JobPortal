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
Route::get('/index', function () {
    return view('index');
});

Route::get('/employerRegister', function () {
    return view('employer.employer_register');
});
Route::post('/employerRegister', 'App\Http\Controllers\EmployerController@Addemployer');

Route::get('/employerLogin', function () {
    return view('employer.employer_login');
});
Route::post('/employerLogin', 'App\Http\Controllers\EmployerController@login');

Route::get('/employerHome', function () {
    return view('employer.employer_home');
});
Route::get('/employerPostjob', function () {
    return view('employer.employer_postjob');
});
Route::post('/employerPostjob', 'App\Http\Controllers\EmployerController@Postjob');


Route::get('/userRegister', function () {
    return view('Jobseeker.user_register');
});
Route::post('/userRegister','App\Http\Controllers\UserController@Adduser');

Route::get('/userLogin', function () {
    return view('Jobseeker.user_login');
});
Route::post('/userLogin', 'App\Http\Controllers\UserController@Userlogin');

Route::get('/userHome', function () {
    return view('Jobseeker.user_home');
});
Route::get('/Recentjobs', 'App\Http\Controllers\UserController@Recentjobs');

/*Route::get('/advancedjobsearch', function () {
    return view('Jobseeker.user_searchjobs');
});*/
//Route::post('/advancedjobsearch', 'App\Http\Controllers\UserController@Advancedsearch');

Route::view('/user_searchjobs','Jobseeker.user_searchjobs');
Route::get('/searchjobs', 'App\Http\Controllers\UserController@searchjobs');


Route::get('Jobapply/{id}','App\Http\Controllers\UserController@Applyjob');

Route::get('/Jobdescription/{id}','App\Http\Controllers\UserController@Viewjobdescription');
Route::post('/Applyjobs', 'App\Http\Controllers\UserController@Applyjobfromanotherpage');

Route::get('/employerJoblist', 'App\Http\Controllers\EmployerController@Listjobs');

Route::get('/Viewapplicants/{id}','App\Http\Controllers\EmployerController@ViewApplicants');

Route::get('/Logout','App\Http\Controllers\AuthController@Logout');


