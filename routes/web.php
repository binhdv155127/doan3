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

use App\Project;

Route::get('/', function () {

    $projects = Project::paginate(6);

    return view('welcome', [
        'projects' => $projects
    ]);
});

Auth::routes();

Route::get('/admin/home', 'HomeController@index')->name('admin-home');
Route::get('/admin/student', 'HomeController@student');
Route::get('/admin/teacher', 'HomeController@teacher');
Route::get('/admin/edit', 'HomeController@edit')->name('admin.edit');
Route::get('/admin/delete','Homecontroller@delete')->name('admin.delete');
Route::post('/admin/edit/student', 'HomeController@editStudent');
Route::get('/admin/edit/teacher', 'HomeController@editTeacher');
Route::get('/admin/change/password', function () {
    return view('admin.admin-change-password');
});
Route::post('/admin/change/password', 'HomeController@changePassword');

Route::get('/admin/create/project', function () {
    $students = DB::table('students')->get();
    $teachers = DB::table('teachers')->get();
    return view('admin.admin-create-project', [
        'students' => $students,
        'teachers' => $teachers
    ]);
});
Route::post('/admin/create/project', 'ProjectController@createProject');

Route::get('/admin/edit/project', function () {
    $projects = Project::paginate(12);
    return view('admin.admin-project',[
        'projects' => $projects
    ]);
});
Route::post('/admin/edit/project', 'ProjectController@edit');

Route::get('/admin/create/user', function () {
    $departments = \App\Department::all();
    $courses = \App\Course::all();
    return view('admin.admin-create-user', [
        'departments' => $departments,
        'courses' => $courses
    ]);
});
Route::post('/admin/create/user', 'HomeController@createUser');

/**
 * teacher login route
 */
Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login')->name('teacher.login.post');
Route::post('/teacher/logout', 'Auth\TeacherLoginController@logout')->name('teacher.logout');


/**
 * route only for teacher profile
 */
Route::group(['middleware' => 'teacher'], function () {

    Route::get('/teacher/home', 'Teacher\HomeController@index');
    Route::get('/teacher/create/project', 'ProjectController@createProjectForm');
    Route::post('/teacher/create/project', 'ProjectController@createProject');


});


/**
 * student login route
 */
Route::get('/student/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('/student/login', 'Auth\StudentLoginController@login')->name('student.login.post');
Route::post('/student/logout', 'Auth\StudentLoginController@logout')->name('student.logout');


/**
 * route only for student profile
 */
Route::group(['middleware' => 'student'], function () {

    Route::get('/student/home', 'Student\HomeController@index');
    Route::get('/student/upload/project', 'ProjectController@uploadForm');
    Route::post('/student/upload/project', 'ProjectController@uploadSubmit');

});


Route::get('/project/detail', 'ProjectController@detail')->name('project.detail');

Route::get('/project/self-detail', 'ProjectController@selfDetail');

Route::get('/project/edit/self-detail', 'ProjectController@showEditSelfDetail')->name('project.edit');

Route::post('/project/edit/self-detail', 'ProjectController@editSelfDetail');

// language
Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});