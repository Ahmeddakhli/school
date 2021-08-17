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
          
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create New student</a>
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
            <th>ages</th>
             <th>classroom_name </th>
               <th>student_courses </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($students as $student)
        <tr>
                <td>{{$student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->classroom->name }}</td>
             <td>
             @if ( count($student->courses)>0)
                   @foreach ($student->courses as $course)
             {{ $course->name }} |
                  @endforeach
             @else
                 no courses yet
             @endif
           
            </td>

            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $students->links() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
