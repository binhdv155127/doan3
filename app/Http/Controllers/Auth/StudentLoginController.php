<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class StudentLoginController extends Controller
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
    protected $redirectTo = '/student/home';

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
      return auth()->guard('student');
    }

    public function showLoginForm()
    {
        if(auth()->guard('student')->check())
        {
            $student_id = auth()->guard('student')->user()->id;
            $projects = Student::find($student_id)->project()->paginate(9);
            $student = auth()->guard('student')->user();
            return view('student.student-home', [
                'projects' => $projects,
                'student'=>$student
            ]);
        }
        else
            return view('auth.student-login');
    }


}
