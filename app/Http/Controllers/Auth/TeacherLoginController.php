<?php

namespace App\Http\Controllers\Auth;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class TeacherLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/teacher/home';

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }


    /**
     * @return property guard use for login
     * 
     */ 
    public function guard()
    {
      return auth()->guard('teacher');
    }

    public function showLoginForm()
    {
        if(auth()->guard('teacher')->check())
        {
            $teacher_id = auth()->guard('teacher')->user()->id;
            $projects = Teacher::find($teacher_id)->project()->paginate(9);
            $teacher = auth()->guard('teacher')->user();

            return view('teacher.teacher-home', [
                'projects'=>$projects,
                'teacher' =>$teacher
            ]);
        }
        else
            return view('auth.teacher-login');
    }



}
