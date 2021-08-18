<!DOCTYPE html>
<html dir="rtl">
<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
</head>
<body>
      
<div class="container">
    <h1>Laravel Yajra Datatables  classrooms</h1>
    <div class="row">
        <div class="col-lg-12 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('classrooms.create') }}"> Create New classroom</a>
            </div>
        </div>
        <div class="col-lg-12 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('home') }}"> home</a>
            </div>
        </div>
    </div>
  
     {!! $dataTable->table(['class' => 'table   table-striped   row-border table-hover ' ,'style'=>'
  border: 1px solid black; width:100%;text-align:center; '],true) !!}
</div>
     
</body>
     
{!! $dataTable->scripts() !!}
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
              var classroom_id =  $(this).attr('classroom_id');
            $.ajax({
                type: 'DELETE',
                 url: "{{ route('classrooms.destroy', 1)}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :classroom_id
                },
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('#'+data.id).remove();
                     $('.child').remove();
                }, error: function (reject) {
                }
            });
        });
    </script>
</html>