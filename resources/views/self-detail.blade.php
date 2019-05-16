@extends('layouts.home')

@section('content')
    <div class="container" style="margin-bottom:310px;margin-top:80px;">
        <h2>{{$type}}</h2>
        <p>
            {{$data->$type}}
        </p>

        @if(auth()->guard('student')->check() || auth()->guard('teacher')->check() || auth::check())
            <a href="{{route('project.edit', ['project'=>$data,'type'=>$type])}}"
               class="btn btn-light mb-5">EDIT</a>
        @endif
       
    </div>
@endsection