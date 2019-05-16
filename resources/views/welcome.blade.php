@extends('layouts.home')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">@lang('messages.home') <span class="sr-only">(current)</span></a>
                    </li>
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.login') }}">@lang('messages.lecturers')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.login') }}">@lang('messages.student')</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">@lang('messages.instruction')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">@lang('messages.contact')</a>
                    </li>
                    <li class="nav-item navbar-right" style="margin-left:480px;" >
                        <a class="nav-link" href="locale/en">English</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="locale/vn">Tiếng Việt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100"
                     src="http://storage.googleapis.com/hust-edu.appspot.com/images/77118269-1553408670328-banner.jpg"
                     alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                     src="http://storage.googleapis.com/hust-edu.appspot.com/images/77118269-1553408670328-banner.jpg"
                     alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                     src="http://storage.googleapis.com/hust-edu.appspot.com/images/77118269-1553408670328-banner.jpg"
                     alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <div class="row mt-3">
            @foreach($projects as $project)
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt-3">
                    <div class="border" >
                        <div style="background-color:rgb(167, 17, 6); color: white;text-align: center; padding: 25px;">
                            @if(isset($project->student))
                                {{$project->student->name}}
                            @else
                                null
                            @endif
                        </div>
                        <div class="caption" Style="margin-top: 35px; margin-left: 25px;">
                            
                            <div>
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <span style="font-weight: bold">@lang('messages.project')</span>
                                <div class="row">
                                    <div class="col-12 text-truncate">
                                        {{$project->name}}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <span style="font-weight: bold">@lang('messages.code')</span>
                                @if(isset($project->student))
                                    {{$project->student->code}}
                                @else
                                    null
                                @endif
                            </div>
                            <br>
                            <div>
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <sapn style="font-weight: bold">@lang('messages.instructors')</sapn>
                                @if(isset($project->teacher))
                                    {{$project->teacher->name}}
                                @else
                                    null
                                @endif
                            </div>
                            <br>
                            <div>
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <span style="font-weight: bold">@lang('messages.institute')</span>
                                <div class="row">
                                    <div class="col-12 text-truncate">
                                        @if(isset($project->department))
                                            {{$project->department->department}}
                                        @else
                                            null
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{--<div class="progress">--}}
                        {{--<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"--}}
                        {{--style="width: {{$project->progress}}%;"--}}
                        {{--aria-valuenow="{{$project->progress}}" aria-valuemin="0"--}}
                        {{--aria-valuemax="100">{{$project->progress}}%--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <br>
                        <a href="{!! route('project.detail', ['project_id'=>$project->id]) !!}"
                           class="btn btn-success" style="padding: 10px 62px;
                           margin-left: 85px;
                           margin-bottom: 30px;">@lang('messages.view')</a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row mt-3 p-3">
            <ul class="pagination">
                {{$projects->links('pagination')}}
            </ul>

        </div>
    </div>
@endsection