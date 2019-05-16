<?php

namespace App\Http\Controllers\Student;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index()
    {
        $student_id = auth()->guard('student')->user()->id;
        $projects = Student::find($student_id)->project()->paginate(9);
        $student = auth()->guard('student')->user();
        return view('student.student-home', [
            'projects' => $projects,
            'student'=>$student
        ]);

    }

}
