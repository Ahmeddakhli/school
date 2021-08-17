@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">students</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('students.update',$student->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $student->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>age:</strong>
                    <input class="form-control" type="number" name="age" placeholder="age" value="{{ $student->age }}">
                </div>
            </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>students_course:</strong>
                    <span>
                          @foreach ($student->courses as $course)
             {{ $course->name }} |
                  @endforeach</span>
               
                   
                </div>
            </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                        <strong>course multi select:</strong>
                <select class="form-select" name="course_id[]" multiple aria-label="multiple select example">
            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">  {{ $course->name }}</option>
                        @endforeach
        </select>
            
     </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>classroom:</strong>
                <select name="classroom_id" class="form-select" aria-label="Default select example">
                            @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">  {{ $classroom->name }}</option>
                            @endforeach
                </select>       
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
