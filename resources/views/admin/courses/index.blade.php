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
          
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('courses.create') }}"> Create New course</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>details</th>
            
               <th>course_classrooms </th>
               <th>course_student_num </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($courses as $course)
        <tr>
                <td>{{$course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->detail }}</td>
            <td>
              @foreach ($course->classrooms as $classroom)
             {{ $classroom->name }} |
                  @endforeach</td>
             <td>
           {{count($course->students) }}
            </td>

            <td>
                <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('courses.show',$course->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('courses.edit',$course->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $courses->links() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
