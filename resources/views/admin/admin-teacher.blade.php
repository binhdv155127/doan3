@extends('adminlte::page')


@section('title', 'Dashboard')
@section('content_header')
    <h1>Teacher</h1>
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
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Code</th>
            {{-- <th scope="col">Edit</th> --}}
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{ $teacher->id }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->code }}</td>
            {{-- <td> --}}
                <a href="<?php 
            //echo route('admin.edit', ['id'=>$teacher->id,'type'=>'teacher']); 
             ?>">
             {{-- Edit</a></td> --}}
            <td><a href="<?php echo route('admin.delete', ['id'=>$teacher->id,'type'=>'teacher']); ?>">Delete</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection