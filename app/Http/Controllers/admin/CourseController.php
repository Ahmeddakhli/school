<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Classroom;
use App\Http\Requests\admin\courses\StoreCourseRequest;
use App\Http\Requests\admin\courses\UpdateCourseRequest;
use App\DataTables\CoursesDataTable;


use Illuminate\Http\Request;

class CourseController extends Controller
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
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('admin.courses.index_datatable');
    }
   /**
* public function index()
   * {
    *    $courses = Course::latest()->paginate(5);

    
     *   return view('admin.courses.index',['courses'=>$courses]);
    *}

    
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms= Classroom::all();

        return view('admin.courses.create',['classrooms'=>$classrooms]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        
        $course= Course::create($request->all());

    if($request->has('classroom_id')){
        foreach($request->classroom_id  as $classroom){
            $course->classrooms()->syncWithoutDetaching( $classroom);
        }
    }
 
    if ($course)
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
        $course=Course::findorfail($id);
     
        return view('admin.courses.show',['course'=>$course]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course=Course::findorfail($id);
        $classrooms= Classroom::all();

        return view('admin.courses.edit',['course'=>$course,'classrooms'=>$classrooms]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $course =  Course::findorfail($id);
         
        if ($course)
        {
            $course->update($request->all());
            foreach($request->classroom_id  as $classroom){
                $course->classrooms()->syncWithoutDetaching( $classroom);
            }
        return response()->json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح',
        ]);
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الكورس  غير موجود',
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
        $course= Course::findorfail($request->id);
        if ($course)
        {
            $course->classrooms()->detach();
            $course->students()->detach();
            $course->delete();
         return response()->json([
             'status' => true,
             'msg' => 'تم الحذف بنجاح',
             'id' =>  $request->id
         ]);
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الكورس غير موجود',
        ]);
    
    }
}
