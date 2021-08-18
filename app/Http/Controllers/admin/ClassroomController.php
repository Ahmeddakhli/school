<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\admin\classrooms\StoreClassroomRequest;
use App\Http\Requests\admin\classrooms\UpdateClassroomRequest;
use Illuminate\Http\Request;
use App\DataTables\ClassroomsDataTable;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClassroomsDataTable $dataTable)
    {
        return $dataTable->render('admin.classrooms.index_datatable');
    }
   
 /**    public function index()
    *{
     *   $classrooms = Classroom::latest()->paginate(5);

    
    *    return view('admin.classrooms.index',['classrooms'=>$classrooms]);
    *}

   
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        $classroom=  Classroom::create($request->all());
      
      
   if ($classroom)
        return response()->json([
            'status' => true,
            'msg' => 'تم الحفظ بنجاح',
        ]);
    
    else
        return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom=Classroom::findorfail($id);
     
        return view('admin.classrooms.show',['classroom'=>$classroom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom=Classroom::findorfail($id);
       

        return view('admin.classrooms.edit',['classroom'=>$classroom]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, $id)
    {
        $classroom= Classroom::findorfail($id);
        
       
         if ($classroom)
         {
             $classroom->update($request->all());
            
         return response()->json([
             'status' => true,
             'msg' => 'تم التحديث بنجاح',
         ]);
     }
     else
         return response()->json([
             'status' => false,
             'msg' => 'هذا الفصل غير موجود',
         ]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        
        $classroom= Classroom::findorfail($request->id);
  
        if ($classroom)
        {
            $classroom->courses()->detach();
        $classroom->delete();
         return response()->json([
             'status' => true,
             'msg' => 'تم الحذف بنجاح',
             'id' =>  $request->id
         ]);
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الفصل غير موجود',
        ]);
    
    }

    
}
