<?php

namespace App\Http\Controllers;

use App\ProjectFile;
use App\Student;
use App\Teacher;
use http\Exception\UnexpectedValueException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;

class ProjectController extends Controller
{

    public function uploadForm(){
        if( auth()->guard('student')->check())
        {
            $student_id = auth()->guard('student')->user()->id;
            $projects = DB::table('projects')->where('student_id',$student_id)->get();
            return view('student.student-upload', [
                'projects'=>$projects
            ]);
        }
        else
            return view('auth.student-login');

    }

    public function uploadSubmit(Request $request){

        $this->validate($request, [
                'project' => 'required',
                'files'=>'required',
            ]
        );
        $project_id = $request->project;

        if($request->hasFile('files')) {
            $allowedfileExtension=['jpg','png','zip','rar','JPG','PNG','ZIP','RAR'];
            $files = $request->file('files');
            $exe_flg = true;
            foreach($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check) {
                    $exe_flg = false;
                    break;
                }
            }
            if($exe_flg) {
                foreach ($request->file('files') as $file) {
//                    $filename = $file->storeAs('projects',$file->getClientOriginalName(),['disk' => 'projects']));
//                    $filename = $file-> Storage::putFileAs(
//                        'projects', $file->getClientOriginalName());

                    if(Storage::disk('projects')->putFileAs('image', $file,$file->getClientOriginalName())){
                        DB::table('project_files')->insert(
                            [
                                'project_id' => $project_id,
                                'filename' => 'projects/image/'.$file->getClientOriginalName() ,
                            ]
                        );
                    }

                }
                return redirect()->back()->with('message', 'SUCCESS');
            } else {
                return redirect()->back()->with('message', 'Falied to upload.');
            }
        }

        return redirect()->back()->with('message', 'Falied to upload.');

    }


    public function detail()
    {
        $project_id=Input::get('project_id');
        if($project_id != null){
            $project = Project::find($project_id);
            return view('project-detail',['project'=>$project]);
        }

        return null;


    }

    public function selfDetail(){
        $project_id=Input::get('project_id');
        $type = Input::get('type');
        if($project_id != null){
            switch ($type){
                case "read_me":
                    $data = Project::find($project_id);
                    break;
                case 'data':
                    $data = Project::find($project_id);
                    break;
                case 'citation':
                    $data = Project::find($project_id);
                    break;
                default:break;
            }

            return view('self-detail',['data'=>$data,'type'=>$type, 'project_id'=>$project_id]);
        }

        return null;
    }

    public function showEditSelfDetail(){
        $project= Input::get('project');
        $type = Input::get('type');
        return view('edit-self-detail',[
            'project' => Project::find($project),
            'type'=>$type
        ]);

    }

    public function editSelfDetail(Request $request){
        $this->validate($request,[
            'comment'=>'required',
            'type'=>'required',
            'project' => 'required'
        ]);

        $type = $request->type;
        $content = $request->comment;
        $project = $request->project;



        try{
            DB::table('projects') ->where('id', '=',$project)->update([
                $type=>$content
            ]);
            return redirect()->back()->with('message', 'SUCCESS');
        }catch (QueryException $exception){
            return redirect()->back()->with('message', 'Falied to updated');
        }

    }

    public function updatedSubmit(Request $request){

        $reade_me = $request->read_me;
        $data = $request->data;
        $citation = $request->citation;
        $progress = $request->progress;
        $description = $request->description;
        $project_id = $request->project_id;

        $project = Project::find($project_id);

        $project->read_me = $reade_me;
        $project->data = $data;
        $project->citation = $citation;
        $project->progress = $progress;

        $project->save();

        if($request->hasFile('files')) {
            $allowedfileExtension=['jpg','png','zip','rar','JPG','PNG','ZIP','RAR'];
            $files = $request->file('files');
            $exe_flg = true;
            foreach($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check) {
                    $exe_flg = false;
                    break;
                }
            }
            if($exe_flg) {
                $student_id = auth()->guard('student')->user()->id;
                foreach ($request->file('files') as $file) {
                    $filename = $file->storeAs('projects',$file->getClientOriginalName());
                    DB::table('project_files')->insert(
                        [
                            'project_id' => $project_id,
                            'student_id' => $student_id,
                            'filename' => $filename,
                            'description' => $description,
                        ]
                    );
                }
            } else {
                return redirect()->back()->with('message', 'Falied to upload. Only accept jpg, png photos.');
            }
        }

        return redirect()->back()->with('message', 'SUCCESS');
    }

    public function createProjectForm(){
        if( auth()->guard('teacher')->check())
        {
            $students = DB::table('students')->get();
            return view('teacher.teacher-create-project', [
                'students'=>$students
            ]);
        }
        else
            return view('auth.teacher-login');
    }

    public function createProject(Request $request){
        if(auth()->guard('teacher')->check()){
            $this->validate($request, [
                    'project_name' => 'required',
                    'student'=>'required',
                ]
            );
            $teacher = auth()->guard('teacher')->user();
        }else{
            $this->validate($request, [
                    'project_name' => 'required',
                    'student'=>'required',
                    'teacher'=>'required'
                ]
            );
            $teacher = Teacher::find($request->teacher);
        }

        try{
            DB::table('projects')->insert(
                [
                    'id' => $request->project_id,
                    'name' => $request->project_name,
                    'student_id' => $request->student,
                    'teacher_id' => $teacher->id,
                    'department_id' => $teacher->department->id,
                    'description' => $request->description,
                ]
            );
            return redirect()->back()->with('message', 'SUCCESS');

        }catch (QueryException $ex){

            return redirect()->back()->with('message', 'Fail Create Project');

        }

    }

    public function edit(Request $request){
        $this->validate($request,[
           'project_name' => 'required',
           'student' => 'required',
           'teacher' => 'required',
           'department' => 'required',

        ]);
        try{
            DB::table('projects')->where('id','=',$request->id)->insert(
                [
                    'name' => $request->project_name,
                    'student_id' => $request->student,
                    'teacher_id' => $request->teacher,
                    'department_id' => $request->department,
                    'description' => $request->description,
                    'read_me' => $request->read_me,
                    'data' => $request->data,
                    'citation' => $request->citation
                ]
            );
            return redirect()->back()->with('message', 'SUCCESS');

        }catch (QueryException $ex){

            return redirect()->back()->with('message', 'Fail Create Project');

        }
    }

}
