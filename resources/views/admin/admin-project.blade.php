@extends('adminlte::page')


@section('title', 'Dashboard')



@section('content_header')

    <h1>Student</h1>

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
    <table class="table" style="overflow-x: scroll;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Student</th>
            <th scope="col">Teacher</th>
            <th scope="col">Read me</th>
            <th scope="col">Data</th>
            <th scope="col">Citation</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->description }}</td>
                <td>
                    @if(isset($project->student))
                        {{$project->student->name}}
                    @else
                        null
                    @endif
                </td>
                <td>
                    @if(isset($project->teacher))
                        {{$project->teacher->name}}
                    @else
                        null
                    @endif
                </td>
                <td>{{ $project->read_me }}</td>
                <td>{{ $project->data }}</td>
                <td>{{ $project->citation }}</td>
                <td><a href="<?php echo route('admin.edit', ['id' => $project->id, 'type' => 'project']); ?>">Edit</a>
                </td>
                <td>
                    <a href="<?php echo route('admin.delete', ['id' => $project->id, 'type' => 'project']); ?>">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="pagination">
        {{$projects->links('.pagination')}}
    </ul>
@endsection


