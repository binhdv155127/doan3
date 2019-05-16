@extends('adminlte::page')


@section('title', 'Dashboard')



@section('content_header')

    <h1>Edit</h1>

@endsection



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

    @if(isset($student))
    <form action="/admin/edit/student?id={{$student->id}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h2>Student</h2>
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{$student->name}}">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{$student->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{$student->phone}}">
        </div>
        <br><br>
        <input type="submit" class="btn btn-primary" value="Updated"/>
    </form>

    @elseif(isset($teacher))
        <form action="/admin/edit/teacher?id={{$teacher->id}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2>Teacher</h2>
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$teacher->name}}">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{$teacher->email}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{$teacher->phone}}">
            </div>
            <br><br>
            <input type="submit" class="btn btn-primary" value="Updated"/>
        </form>
    @elseif(isset($project))
        <form action="/admin/edit/project?id={{$project->id}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2>Project</h2>
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" class="form-control" placeholder="Project" value="{{$project->name}}">
            </div>
            <div class="form-group">
                <label for="teacher">Select a Teacher</label>
                <div>
                    <select class="form-control" name="teacher" id="teacher">
                        <option value="">Select a Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ ucfirst($teacher->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="student">Select a Student</label>
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
                <label for="department">Select a Department</label>
                <div>
                    <select class="form-control" name="department" id="department">
                        <option value="">Select a Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ ucfirst($department->department) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" class="form-control"
                          placeholder="Description">{{$project->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="Read me">Read me</label>
                <textarea name="read_me" class="form-control"
                          placeholder="Read me">{{$project->read_me}}</textarea>
            </div>
            <div class="form-group">
                <label for="Data">Data</label>
                <textarea name="data" class="form-control"
                          placeholder="Data">{{$project->data}}</textarea>
            </div>
            <div class="form-group">
                <label for="Citation">Citation</label>
                <textarea name="description" class="form-control"
                          placeholder="Citation">{{$project->citation}}</textarea>
            </div>

            <br>
            <input type="submit" class="btn btn-primary" value="Update"/>
        </form>
    @endif

@endsection
