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
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="/student/upload/project" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h2>File Uploading</h2>
                    <div class="form-group">
                        <label for="project_id">Select a Project</label>
                        <div>
                            <select class="form-control" name="project" id="project">
                                <option value="">Select a Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ ucfirst($project->name) }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                    </div>
                    <label for="File Name">File (can upload multi file):</label>
                    <br>
                    <input type="file" class="form-control" name="files[]" multiple/>
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="Upload"/>
                </form>
            </div>
        </div>
    </div>
@endsection