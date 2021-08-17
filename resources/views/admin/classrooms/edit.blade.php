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
            <div class="pull-left">
                <h2>Edit classroom</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('classrooms.index') }}"> Back</a>
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
  
    <form action="{{ route('classrooms.update',$classroom->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $classroom->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>details:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="age">{{ $classroom->detail }}</textarea>
                </div>
            </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>students numper:</strong>
                    <input type="text" name="name" value="    {{count($classroom->students) }}" class="form-control" placeholder="Name" disabled>
                </div>
            </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>classroom_courses:</strong>
                    <span>
                 @if(count($classroom->courses)>0)
                                  @foreach ($classroom->courses as $classroom)
                            {{ $courses->name }} |
                                @endforeach
                  @else
                   no courses yet

                  @endif
                  </span>
               
                   
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
