@extends('layouts.home')

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

    <link rel="stylesheet" href="{{asset('css/detail-home.css')}}"/>
    <form action="/student/upload/project" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="content" style="background: #f0f0f0">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="title" style="margin-bottom:30px;">
                            <h2>
                                {{$project->name}}
                            </h2>
                        </div>

                        <div class="selected" style="margin: 0 auto;  text-align: center">
                            <a href="/project/self-detail?project_id={{$project->id}}&type=read_me"
                               class="btn btn-light">READ ME</a>
                            <a href="/project/self-detail?project_id={{$project->id}}&type=data" class="btn btn-light">DATA</a>
                            <a href="/project/self-detail?project_id={{$project->id}}&type=citation"
                               class="btn btn-light">CITATION</a>
                        </div>

                        <div style="margin: 25px auto;  text-align: center">
                            <h4>Files :</h4>
                            @foreach($project->file as $file)
                                <a href="{{asset(''.$file->filename.'')}}">{{$file->filename}}</a>
                            @endforeach
                        </div>
                        @if(auth()->guard('student')->check() || auth()->guard('teacher')->check() || auth::check())
                            <div style="width:400px;margin: 0 auto">
                                <input type="text" class="form-control" name="project" value="{{$project->id}}" hidden/>
                                <input type="file" class="form-control" name="files[]" multiple/>
                                <input type="submit" class="btn btn-light" value="Submit Query"/>
                            </div>
                        @endif

                        <div class="title">
                            <h3>
                                Mọi chi tiết xin liên hệ: {{$project->teacher->name}}
                            </h3>
                            <h3>
                                {{$project->department->department}} - Trường Đại Học Bách Khoa Hà Nội
                            </h3>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection