@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row">
            <div class="main col-xs-12 col-sm-12 col-md-9">
                <div class="main">
                    <div class="container">
                        <div class="row mt-3">
                            @foreach($projects as $project)
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt-3">
                                    <div class="border" style="padding: 15px">
                                        <h6>{{$student->name}}</h6>
                                        <div class="caption">
                                            <hr>
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
                                                {{$project->student->code}}
                                            </div>
                                            <br>
                                            <div>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <sapn style="font-weight: bold">@lang('messages.lecturers')</sapn>
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
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                                 style="width: {{$project->progress}}%;"
                                                 aria-valuenow="{{$project->progress}}" aria-valuemin="0"
                                                 aria-valuemax="100">{{$project->progress}}%
                                            </div>
                                        </div>
                                        <br>
                                        <a href="{!! route('project.detail', ['project_id'=>$project->id]) !!}"
                                           class="btn btn-default">@lang('messages.view')</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row mt-3 p-3">
                            {{$projects->links('pagination')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="PGB">
                    <div class="LGB">THÔNG TIN CÁ NHÂN</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Mã số : {{$student->code}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Họ tên : {{$student->name}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Hệ: Cử nhân Công Nghệ</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Khoá: 60</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Email : {{$student->email}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Điện thoại : {{$student->phone}}</div>
                </div>

                <div class="PGB">
                    <div class="LGB">THAO TÁC HỆ THỐNG</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB"><a href={{'/student/upload/project'}}>Upload File</a></div>
                </div>

            </div>
        </div>
    </div>
@endsection