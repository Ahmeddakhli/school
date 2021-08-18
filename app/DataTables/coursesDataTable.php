<?php

namespace App\DataTables;

use App\Models\course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class coursesDataTable extends DataTable
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
                return '<a href="'.route('courses.show', $row->id).'">'.$row->name.'</a>';
            })
            ->rawColumns(['action', 'name','course_classrooms','course_students_num'])
            ->addColumn('action',  function($row){
                $actionBtn = '
                 <a href="'. route('courses.edit', $row->id) .'" class="edit btn btn-success btn-sm">تعديل</a>
                 <form action="'. route('courses.destroy', $row->id) .'" method="POST">
                 '.csrf_field().'
                 '.method_field("DELETE").'
                 <button course_id="'.$row->id.'" class=" delete_btn delete btn btn-danger btn-sm"
                     onclick="return confirm(\'سوف يتم حذف المسؤل نهائينا هل تريد الحذف؟\')">حذف</a>
                 </form>';
                return $actionBtn;
            })
            ->addColumn('course_students_num',  function($row){
              
                return     count($row->students)  ;

                
            })
           
            ->addColumn('course_classrooms',  function($row){
              
                if ( count($row->classrooms)>0){
                   foreach ($row->classrooms as $classroom){
                       $classroom->name  ;
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
     * @param \App\Models\course $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(course $model)
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
                    ->setTableId('courses-table')
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
             Column::make('course_students_num')
             ->title("الطلاب المشتركين")
             ,  Column::make('course_classrooms')
             ->title("الفصول")
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
        return 'courses_' . date('YmdHis');
    }
}
