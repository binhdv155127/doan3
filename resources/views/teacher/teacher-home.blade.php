@extends('layouts.teacher')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="main">
                    <div class="container">
                        <div class="row mt-3">
                            @foreach($projects as $project)
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt-3">
                                    <div class="border" style="padding: 15px">
                                        <h6>
                                            @if(isset($project->student))
                                                {{$project->student->name}}
                                            @else
                                                null
                                            @endif
                                        </h6>
                                        <div class="caption">
                                            <hr>
                                            <div>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span style="font-weight: bold">Tên đồ án:</span>
                                                <div class="row">
                                                    <div class="col-12 text-truncate">
                                                        {{$project->name}}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span style="font-weight: bold">MSSV:</span>
                                                {{$project->teacher->code}}
                                            </div>
                                            <br>
                                            <div>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <sapn style="font-weight: bold">GVHD:</sapn>
                                                {{$project->teacher->name}}
                                            </div>
                                            <br>
                                            <div>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span style="font-weight: bold">Viện:</span>
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
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                 role="progressbar"
                                                 style="width: {{$project->progress}}%;"
                                                 aria-valuenow="{{$project->progress}}" aria-valuemin="0"
                                                 aria-valuemax="100">{{$project->progress}}%
                                            </div>
                                        </div>
                                        <br>
                                        <a href="{!! route('project.detail', ['project_id'=>$project->id]) !!}"
                                           class="btn btn-default">Details</a>
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
                    <div class="AHB">Mã số : {{$teacher->code}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Họ tên : {{$teacher->name}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Email : {{$teacher->email}}</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB">Điện thoại : {{$teacher->phone}}</div>
                </div>

                <div class="PGB">
                    <div class="LGB">THAO TÁC HỆ THỐNG</div>
                    <div class="fa fa-file-text-o"
                         style="color:#0DCBEA; float:left; margin-top: 9px;"></div>
                    <div class="AHB"><a href="{{url ('teacher/create/project')}}">Create Project</a></div>
                </div>

            </div>
        </div>

    </div>
@endsection