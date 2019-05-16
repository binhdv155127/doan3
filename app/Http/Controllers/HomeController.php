<?php

namespace App\Http\Controllers;

use App\Department;
use App\Project;
use App\Student;
use App\Teacher;
use DB;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use PhpParser\Node\Stmt\TryCatch;
use Schema;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-home');
    }

    public function student()
    {
        $students = DB::table('students')
//            ->join('departments', 'departments.id', '=', 'students.id')
//            ->join('courses', 'courses.id', '=', 'students.id')
            ->get();
        return view('admin.admin-student', [
            'students' => $students
        ]);
    }

    public function teacher()
    {
        $teachers = DB::table('teachers')->get();
        return view('admin.admin-teacher', [
            'teachers' => $teachers
        ]);
    }

    public function edit()
    {
        $id = Input::get('id');
        $type = Input::get('type');
        switch ($type) {
            case 'student':
                $student = Student::find($id);
                return view('admin.admin-edit', [
                    'student' => $student
                ]);
                break;
            case 'teacher':
                $teacher = Student::find($id);
                return view('admin.admin-edit', [
                    'teacher' => $teacher
                ]);
                break;
            case 'project':
                $project = Project::find($id);
                $teachers = Teacher::all();
                $students = Student::all();
                $departments = Department::all();
                return view('admin.admin-edit', [
                    'project' => $project,
                    'teachers' => $teachers,
                    'students' => $students,
                    'departments' => $departments,
                ]);
                break;
            default:
                break;
        }

        return null;
    }

    public function delete()
    {
        $id = Input::get('id');
        $type = Input::get('type');
        switch ($type) {
            case 'student':
                try {
                    Schema::disableForeignKeyConstraints();
                    DB::table('students')->where('id', '=', $id)->delete();
                    Schema::enableForeignKeyConstraints();
                    return redirect()->back()->with('message', 'SUCCESS');
                } catch (QueryException $exception) {
                    return redirect()->back()->with('message', 'Fail to Delete');
                }
            case 'teacher':
                try {
                    Schema::disableForeignKeyConstraints();
                    DB::table('teachers')->where('id', '=', $id)->delete();
                    Schema::enableForeignKeyConstraints();
                    return redirect()->back()->with('message', 'SUCCESS');
                } catch (QueryException $exception) {
                    return redirect()->back()->with('message', 'Fail to Delete');
                }
            case 'project':
                try {
                    Schema::disableForeignKeyConstraints();
                    DB::table('projects')->where('id', '=', $id)->delete();
                    Schema::enableForeignKeyConstraints();
                    return redirect()->back()->with('message', 'SUCCESS');
                } catch (QueryException $exception) {
                    return redirect()->back()->with('message', 'Fail to Delete');
                }
            default:
                break;
        }

        return null;
    }

    public function editStudent(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'
            ]
        );

        $id = Input::get('id');

        $student = Student::find($id);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        return redirect()->back()->with('message', 'SUCCESS');
    }

    public function editTeacher(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'
            ]
        );

        $id = Input::get('id');

        $teacher = Teacher::find($id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;

        return redirect()->back()->with('message', 'SUCCESS');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,
            [
                'code_or_email' => 'required',
                'new_password' => 'required',
                'gridRadios' => 'required'
            ]
        );

        $gridRadios = $request->gridRadios;

        switch ($gridRadios) {
            case 'student':
                try {
                    DB::table('students')
                        ->where(
                            'code', '=', $request->code_or_email
                            // ['email', '=', $request->code_or_email]
                        )
                        ->update(['password' => bcrypt($request->new_password)]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('message', 'Fail Update');
                }
            case 'teacher':
                try {
                    DB::table('teachers')
                        ->where(
                            'code', $request->code_or_email
                            //['email', '=', $request->code_or_email]
                        )
                        ->update(['password' => bcrypt($request->new_password)]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('message', 'Fail Update');
                }
            case 'admin':
                try {
                    DB::table('users')
                        ->where(
                            'email', '=', $request->code_or_email
                        )
                        ->update(['password' => bcrypt($request->new_password)]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('message', 'Fail Update');
                }
            default:
                break;
        }

        return null;

    }

    public function createUser(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required|email',

            ]
        );
        $type = $request->type;

        switch ($type) {
            case 'student':
                $this->validate($request,
                    [

                        'code' => 'required',
                        'department' => 'required',
                        'course' => 'required',
                    ]
                );
                try {
                    DB::table('students')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' =>  bcrypt($request->password),
                        'code'=> $request->code,
                        'department_id' => $request->department,
                        'course_id' => $request->course,
                        'phone' => $request->phone,
                        'remember_token' => str_random(10),
                    ]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('error', 'Fail Create'.$ex);
                }
            case 'teacher':
                $this->validate($request,
                    [
                        'code' => 'required',
                        'department' => 'required',
                    ]
                );
                try {
                    DB::table('teachers')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' =>  bcrypt($request->password),
                        'code'=> $request->code,
                        'department_id' => $request->department,
                        'phone' => $request->phone,
                        'remember_token' => str_random(10),
                    ]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('error', 'Fail Create');
                }
            case 'admin':
                try {
                    DB::table('users')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' =>  bcrypt($request->password), // 123456
                        'remember_token' => str_random(10),
                    ]);
                    return redirect()->back()->with('message', 'SUCCESS');

                } catch (QueryException $ex) {

                    return redirect()->back()->with('error', 'Fail Create');
                }
            default:
                break;
        }

        return null;
    }

}
