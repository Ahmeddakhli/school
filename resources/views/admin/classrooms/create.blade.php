@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">classrooms</div>

                <div class="card-body">
                <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>
 <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New classroom</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('classrooms.index') }}"> Back</a>
        </div>
    </div>
</div>
   

   
<form  id="classroomForm" action="{{ route('classrooms.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name"value="{{old('name')}}">
                   <small id="name_error" class="form-text text-danger"></small>

            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>details:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="detail">{{old('detail') }}</textarea>
                  <small id="detail_error" class="form-text text-danger"></small>

                </div>
            </div>
   
   
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button id="save_classroom" class="btn btn-primary">Submit</button>
      
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
        $(document).on('click', '#save_classroom', function (e) {
            e.preventDefault();
              $('#detail_error').text('');
            $('#name_error').text('');
            
            var formData = new FormData($('#classroomForm')[0]);
            $.ajax({
                type: 'post',
                //enctype: 'multipart/form-data',
                url: "{{route('classrooms.store')}}",
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