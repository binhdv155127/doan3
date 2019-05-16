@extends('layouts.teacher')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="/teacher/create/project" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h2>Create Project</h2>
                    <div class="form-group">
                        <label for="project_name">Project Name</label>
                        <input type="text" name="project_name" class="form-control" placeholder="Project">
                    </div>
                    <div class="form-group">
                        <label for="project_id">Select a Student</label>
                        <div>
                            <select class="form-control" name="student" id="student">
                                <option value="">Select a Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ ucfirst($student->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea name="description" class="form-control"
                                  placeholder="Description"></textarea>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Create"/>
                </form>
            </div>
        </div>
    </div>
@endsection