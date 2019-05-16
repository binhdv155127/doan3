@extends('adminlte::page')


@section('title', 'Dashboard')



@section('content_header')

    <h1>Create User</h1>

@endsection



@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
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

    <form action="/admin/create/user" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group" id="code-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" placeholder="Code">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Phone">
        </div>
        <div class="form-group" id="department-group">
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
        <div class="form-group" id="course-group">
            <label for="course">Select a Course</label>
            <div>
                <select class="form-control" name="course" id="course">
                    <option value="">Select a Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ ucfirst($course->course) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type_student" value="student"
                               checked>
                        <label class="form-check-label" for="gridRadios1">
                            Student
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type_teacher" value="teacher">
                        <label class="form-check-label" for="gridRadios2">
                            Teacher
                        </label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="type" id="type_admin" value="admin">
                        <label class="form-check-label" for="gridRadios3">
                            Admin
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br>
        <input type="submit" class="btn btn-primary" value="Create"/>
    </form>

@endsection


@section('js')

    <script>
        $(document).ready(function () {
            $('#type_student').on('click', function () {
                $('#department-group').show();
                $('#course-group').show();
            });
            $('#type_teacher').on('click', function () {
                $('#department-group').show();
                $('#course-group').hide();
            });
            $('#type_admin').on('click', function () {
                $('#department-group').hide();
                $('#course-group').hide();
                $('#code-group').hide();
            });
        });
    </script>

@endsection