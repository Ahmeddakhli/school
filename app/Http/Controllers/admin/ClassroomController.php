<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

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
    public function index()
    {
        $classrooms = Classroom::latest()->paginate(5);

    
        return view('admin.classrooms.index',['classrooms'=>$classrooms]);
    }

    /**
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
    public function store(Request $request)
    {
        Classroom::create($request->all());
      
        return redirect()->route('classrooms.index')
                        ->with('success','classroom created successfully.');
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
    public function update(Request $request, $id)
    {
         Classroom::findorfail($id)->update($request->all());;
        
      
    
        return redirect()->route('classrooms.index')
                        ->with('success','classroom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $classroom= Classroom::findorfail($id);
        $classroom->courses()->detach();
        
        $classroom->delete();


        return redirect()->route('classrooms.index')
                        ->with('success','classroom deleted successfully');
    }
}
