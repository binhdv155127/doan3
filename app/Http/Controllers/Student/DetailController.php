<?php

namespace App\Http\Controllers\Student;

use App\Project;
use App\ProjectFile;
use App\Student;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DetailController extends Controller
{

    public function index()
    {
          $project_id=Input::get('project_id');
          if($project_id != null){
              $project = Project::find($project_id);
              return view('student.student-detail',['project'=>$project]);
          }

          return null;


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

}
