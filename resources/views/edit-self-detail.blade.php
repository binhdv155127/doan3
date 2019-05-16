@extends('layouts.home')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <a href="{{url("/")}}">Trang chủ</a>
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

    <form action="/project/edit/self-detail" method="post" enctype="multipart/form-data">
        <div class="container ">
            {{csrf_field()}}
            <h2>{{$type}}</h2>
            <input class="form-control" name="type" value="{{$type}}" hidden>
            <input class="form-control" name="project" value="{{$project->id}}" hidden>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" rows="10" id="comment" name="comment">{{$project->$type}}</textarea>
            </div>
            <input type="submit" class="btn btn-light" value="Update"/>
        </div>
    </form>

@endsection