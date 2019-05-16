<?php

namespace App\Http\Controllers\Teacher;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    

    public function index()
    {
        $teacher_id = auth()->guard('teacher')->user()->id;
        $projects = Teacher::find($teacher_id)->project()->paginate(9);
        $teacher = auth()->guard('teacher')->user();

        return view('teacher.teacher-home', [
            'projects'=>$projects,
            'teacher' =>$teacher
        ]);

    }
}
