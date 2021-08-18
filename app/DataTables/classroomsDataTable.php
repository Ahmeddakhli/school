<?php

namespace App\DataTables;

use App\Models\classroom;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class classroomsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($row) {
                return '<a href="'.route('classrooms.show', $row->id).'">'.$row->name.'</a>';
            })
            ->rawColumns(['action', 'name','classroom_courses','classroom_students_num'])
            ->addColumn('action',  function($row){
                $actionBtn = '
                 <a href="'. route('classrooms.edit', $row->id) .'" class="edit btn btn-success btn-sm">تعديل</a>
                 <form action="'. route('classrooms.destroy', $row->id) .'" method="POST">
                 '.csrf_field().'
                 '.method_field("DELETE").'
                 <button classroom_id="'.$row->id.'" class=" delete_btn delete btn btn-danger btn-sm"
                     onclick="return confirm(\'سوف يتم حذف المسؤل نهائينا هل تريد الحذف؟\')">حذف</a>
                 </form>';
                return $actionBtn;
            })
            ->addColumn('classroom_students_num',  function($row){
              
                return     count($row->students)  ;

                
            })
           
            ->addColumn('classroom_courses',  function($row){
                if ( count($row->courses)>0){
                   foreach ($row->courses as $course){
                    return    $course->name .'|' ;
            }}
             else{
                return ' no classrooms yet';}
             
                
            })
       
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->setRowAttr([
                'text-align' => 'center',
                
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\classroom $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(classroom $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('classrooms-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->language([
                        'buttoms' => [
                            'Excel' =>'إكسيل',
                            'print' =>'طباعه',
                            'Export' =>'تحميل',
                            'Reload' =>'تحميل البيانات الجديده',
                            'Reset' =>'الغاء البحث',
                
                        ],
                        'url' => url('//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json')
                    ])
                    ->columnDefs(' width: "10px", targets: [0,1,2]') 
                 
                    ->parameters([
                      
                        
                        'initComplete' => "function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ])
                    
                    ->responsive(true)
                    ->serverSide(true)
                    ->processing(True)
                    ->autoWidth( true)
                       
                
                    ->buttons(
                      
                        Button::make('export')
                        ->title("تحميل")
                        ,
                        Button::make('print')
                        ->title("طباعة"),
                        Button::make('reset')
                        ->title("حذف البحث"),
                        Button::make('reload')
                        ->title("تحميل المنتجات الجديدة")
                        ,

                       

                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
            ->width(10)
            ->title("رقم")
             ,
             Column::make('name')
             ->title("الاسم")
             ,
             Column::make('detail')
             ->title("التفاصيل")
             ,
             Column::make('classroom_students_num')
             ->title("الطلاب المشتركين")
             ,  Column::make('classroom_courses')
             ->title("الكورسات")
             ,
      
             Column::make('created_at')->title("تاريخ الاضافة"),
      Column::make('updated_at')->title("تاريخ التعديل"),
      Column::computed('action')
      ->title(" عمليات")
      
      ->exportable(true)
      ->printable(true)
      ->width(60),
  ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'classrooms_' . date('YmdHis');
    }
}
