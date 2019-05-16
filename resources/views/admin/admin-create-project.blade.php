@extends('adminlte::page')


@section('title', 'Dashboard')



@section('content_header')

    <h2>Create Project</h2>

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

    <form action="/admin/create/project" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="project_name">Project Name</label>
            <input type="text" name="project_name" class="form-control" placeholder="Project">
        </div>
        <div class="form-group">
            <label for="project_id">Select a Teacher</label>
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

@endsection
