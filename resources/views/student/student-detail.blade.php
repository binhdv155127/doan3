@extends('layouts.student')

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
    <style>
        #btn-group {
            margin: 20px auto;
            text-align: center;
            width: inherit;
            display: inline-block;
        }
        .file {
            margin: 20px auto;
        }
    </style>
    <form action="/student/updated/project" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container">
            <div class="btn-group" id="btn-group" role="group" aria-label="Details">
                <h2>{{$project->name}}</h2>
                <input type="text" name="project_id" value="{{$project->id}}" hidden>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#readmeModal">READ ME
                </button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#dataModal">DATA
                </button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#citationModal">
                    CITATION
                </button>
                <br>
                <br>
                Progress : <input type="text" name="progress" value="{{$project->progress}}" style="width: 35px;"> %
            </div>
            <div class="file">
                <h2>File Uploading</h2>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                </div>
                <label for="File Name">File (can upload multi file):</label>
                <ul>
                    @foreach($project->file as $file)
                        <li>{{$file->filename}}</li>
                    @endforeach
                </ul>
                <br>
                <input type="file" class="form-control" name="files[]" multiple/>
                <br><br>
                <input type="submit" class="btn btn-secondary" value="Update"/>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="readmeModal" tabindex="-1" role="dialog" aria-labelledby="readmeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">READ ME</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" rows="5" id="comment"
                                          name="read_me">{{$project->read_me}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">READ ME</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" rows="5" id="comment"
                                          name="data">{{$project->data}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="citationModal" tabindex="-1" role="dialog" aria-labelledby="citationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">READ ME</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" rows="5" id="comment"
                                          name="citation">{{$project->citation}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection