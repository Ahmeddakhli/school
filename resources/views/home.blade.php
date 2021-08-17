@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

  
  <div class="row">
  @if (count($classrooms)>0)
         <div class="col-sm-4 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('students.index') }}"> all students</a>
            </div>
        </div>
        <div class="col-sm-4 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('courses.index') }}"> all courses</a>
            </div>
        </div>
         <div class="col-sm-4 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('classrooms.index') }}"> all classrooms</a>
            </div>
        </div>
  @else
      
        <div class="col-sm-4 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('classrooms.create') }}"> add  classrooms first of all</a>
            </div>
        </div>
  @endif
 
    </div>
  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
