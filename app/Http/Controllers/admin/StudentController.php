<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

use App\Http\Requests\admin\students\StoreStudentRequest;
use App\Http\Requests\admin\students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\DataTables\StudentsDataTable;

class StudentController extends Controller
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
    public function index(StudentsDataTable $dataTable)
    {
        return $dataTable->render('admin.students.index_datatable');
    }
   
    /** public function index()
    {
        $students = Student::latest()->paginate(5);

    
        return view('admin.students.index',['students'=>$students]);
    }

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms= Classroom::all();
        $courses= Course::all();
        return view('admin.students.create',['classrooms'=>$classrooms,'courses'=>$courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->all());
        $student=Student::get()->last();
        $courses=$request->course_id;
        
        if($request->has('course_id')){
            foreach($courses  as $course){
                $student->courses()->syncWithoutDetaching( $course);
            }
        }
     
        if ($student)
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
        
        $student=Student::findorfail($id);
     
        return view('admin.students.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $student=Student::findorfail($id);
        $classrooms= Classroom::all();
        $courses= Course::all();
        return view('admin.students.edit',['student'=>$student,'classrooms'=>$classrooms,'courses'=>$courses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student =  Student::findorfail($id);
        
      
        if ($student)
        {
            $student->update($request->all());
            if($request->has('course_id')){
                foreach($request->course_id  as $course){
                    $student->courses()->syncWithoutDetaching( $course);
                }
                }
        return response()->json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح',
        ]);
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الطالب غير موجود',
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
       $student= Student::findorfail($request->id);
       if ($student)
       {
        $student->courses()->detach();
        $student->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request->id
        ]);
   }
   else
       return response()->json([
           'status' => false,
           'msg' => 'هذا الطالب غير موجود',
       ]);
      
    }
}
