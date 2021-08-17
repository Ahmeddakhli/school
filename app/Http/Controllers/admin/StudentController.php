<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\admin\students\StoreStudentRequest;
use App\Http\Requests\admin\students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Course;
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
    public function index()
    {
        $students = Student::latest()->paginate(5);

    
        return view('admin.students.index',['students'=>$students]);
    }

    /**
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
        foreach($request->course_id  as $course){
            $student->courses()->syncWithoutDetaching( $course);
        }
        return redirect()->route('students.index')
                        ->with('success','student created successfully.');
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
        $student->update($request->all());
       
        foreach($request->course_id  as $course){
            $student->courses()->syncWithoutDetaching( $course);
        }
    
        return redirect()->route('students.index')
                        ->with('success','student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $student= Student::findorfail($id);
        $student->courses()->detach();
        $student->delete();
        return redirect()->route('students.index')
                        ->with('success','student deleted successfully');
    }
}
