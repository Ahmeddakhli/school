@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">students</div>

             
 
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
   
 <div class="alert alert-success" id="success_msg" style="display: none;">
            تم التعديل بنجاح
        </div>
  
    <form  id="offerForm" action="" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $student->name }}" class="form-control" placeholder="Name">
                     <small id="name_error" class="form-text text-danger"></small>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>age:</strong>
                    <input class="form-control" type="number" name="age" placeholder="age" value="{{ $student->age }}">
                                  <small id="age_error" class="form-text text-danger"></small>

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
                               <small id="course_id_error" class="form-text text-danger"></small>

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
                  <small id="classroom_id_error" class="form-text text-danger"></small>
     
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button id="save_offer" class="btn btn-primary">Submit</button>
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
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $('#age_error').text('');
            $('#name_error').text('');
            $('#classroom_id_error').text('');
            $('#course_id_error').text('');
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                //enctype: 'multipart/form-data',
                url: "{{route('students.update',$student->id)}}",
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