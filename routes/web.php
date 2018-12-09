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

Route::get("/login", "AuthController@authView")->name('login');
Route::post("/login", "AuthController@store");
Route::get("/logout", "AuthController@logout");

Route::get('/dashboard', "DashboardController@showMenu");

Route::get("/students", "StudentController@showStudents");
Route::post("/addstud/{data}", "StudentController@addStudents")->where('data', '.*');
Route::post("/modstud/{id}/{data}", "StudentController@modifyStudents")->where(['id' => '[0-9]+', 'data' => '.*']);
Route::post("/delstud/{id}", "StudentController@delStudents")->where('id', '[0-9]+');

Route::get("/students/scourses/{id}", "StudentController@showScourses")->where('id', '[0-9]+');
Route::post("/students/getCourses/{id}", "StudentController@getCourses")->where('id', '[0-9]+');
Route::post("/students/delcourse/{stud_id}/{course_id}", "StudentController@delCourse")->where(['stud_id' => '[0-9]+', 'course_id' => '[0-9]+']);

Route::get("/courses", "CourseController@showCourses");
Route::post("/addcourse/{name}", "CourseController@addCourses")->where('name', '[A-Za-z0-9]+');
Route::post("/modcourse/{id}/{name}", "CourseController@modifyCourses")->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);
Route::post("/delcourse/{id}", "CourseController@delCourses")->where('id', '[0-9]+');
Route::post("/students/addcourse/{stud_id}/{course_id}", "StudentController@addScourses")->where(['stud_id' => '[0-9]+', 'course_id' => '[0-9]+']);


Route::get("/courses/members/{id}", "CourseController@filterCourses")->where('id', '[0-9]+');
Route::post("/courses/delmember/{stud_id}/{course_id}", "CourseController@delMembers")->where(['stud_id' => '[0-9]+', 'course_id' => '[0-9]+']);
Route::post("/courses/addmember/{stud_id}/{course_id}", "CourseController@addMembers")->where(['stud_id' => '[0-9]+', 'course_id' => '[0-9]+']);
Route::post("/courseStudents/{id}", "CourseController@courseStudents")->where('id', '[0-9]+');

Route::get("/test", "CourseController@test");
