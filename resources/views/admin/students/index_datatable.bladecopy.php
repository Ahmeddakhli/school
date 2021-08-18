@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            


      

    <h1>Laravel Yajra Datatables </h1>
  
     {!! $dataTable->table(['class' => 'table   table-striped   row-border table-hover ' ,'style'=>'
  border: 1px solid black; width:100%;text-align:center; '],true) !!}

     

          
          
    </div>
</div>
@push('js')
{!! $dataTable->scripts() !!}

  
@endpush
@endsection
