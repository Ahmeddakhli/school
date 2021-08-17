@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">classrooms</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 <div class="row">
        <div class="col-lg-12 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('classrooms.create') }}"> Create New classroom</a>
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
            
               <th>classroom_courses </th>
               <th>classroom_student_num </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($classrooms as $classroom)
        <tr>
                <td>{{$classroom->id }}</td>
            <td>{{ $classroom->name }}</td>
            <td>{{ $classroom->detail }}</td>
            <td>
            @if(count($classroom->courses)>0)
 @foreach ($classroom->courses as $course)
             {{ $course->name }} |
                  @endforeach
            @else
            no courses yet
            @endif
             </td>
             <td>
           {{count($classroom->students) }}
            </td>

            <td>
                <form action="{{ route('classrooms.destroy',$classroom->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('classrooms.show',$classroom->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('classrooms.edit',$classroom->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $classrooms->links() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
