@extends('adminlte::page')


@section('title', 'Dashboard')



@section('content_header')

    <h1>Change Password</h1>

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

    <form action="/admin/change/password" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="code_or_email">Code or Email</label>
            <input type="text" name="code_or_email" class="form-control" placeholder="Code">
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="text" name="new_password" class="form-control" placeholder="New Password">
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="student" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Student
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="teacher">
                        <label class="form-check-label" for="gridRadios2">
                            Teacher
                        </label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="admin" >
                        <label class="form-check-label" for="gridRadios3">
                            Admin
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br>
        <input type="submit" class="btn btn-primary" value="Change"/>
    </form>

@endsection
