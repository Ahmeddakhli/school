@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">courses</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show course</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $course->name }}
            </div>
        </div>
   
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>detail:</strong>
                {{ $course->detail }}
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>course_classroom:</strong>
                  <span>
                          @foreach ($course->classrooms as $classroom)
             {{ $classroom->name }} |
                  @endforeach</span>
            </div>
        </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>students num:</strong>
           {{count($course->students) }}
            </div>
        </div>
    </div>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
