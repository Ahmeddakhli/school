@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">courses</div>

                <div class="card-body">
                
 
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit course</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
  <div class="alert alert-success" id="success_msg" style="display: none;">
            تم التعديل بنجاح
        </div>
  
    <form  id="courseForm" action="{{ route('courses.update',$course->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $course->name }}" class="form-control" placeholder="Name">


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>details:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="age">{{ $course->detail }}</textarea>
                 <small id="detail_error" class="form-text text-danger"></small>

                </div>
            </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>students numper:</strong>
                    <input type="text" value="    {{count($course->students) }}" class="form-control" placeholder="Name" disabled>
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
                        <strong>classroom multi select:</strong>
                <select class="form-select" name="classroom_id[]" multiple aria-label="multiple select example">
            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">  {{ $classroom->name }}</option>
                        @endforeach
        </select>
           <small id="classroom_id_error" class="form-text text-danger"></small>

     </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button id="save_course" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

    <script>
        $(document).on('click', '#save_course', function (e) {
            e.preventDefault();
            $('#age_error').text('');
            $('#name_error').text('');
            $('#classroom_id_error').text('');
            $('#course_id_error').text('');
            var formData = new FormData($('#courseForm')[0]);
            $.ajax({
                type: 'post',
                //enctype: 'multipart/form-data',
                url: "{{route('courses.update',$course->id)}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>

@endsection