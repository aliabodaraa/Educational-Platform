<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chooseYearDept(){
        return view('courses.choose_year_dept');
    }
    public function storeChooseYearDept(Request $request){
        $request->validate([
            'yearC' => 'required',
            'department_idC' => 'required',
            'semesterC' => 'required'
        ]);
        $selected_semester=$request->semesterC;
        $selected_year=$request->yearC;
        $selected_departmentId=$request->department_idC;
        if($selected_departmentId == 0 && $selected_year == 0 && $selected_semester == 0){//that means all departments and all years and both semester
            $mssg='Hello '.Auth::user()->username .'You do not specify any department and any year and both semester,We wish you Enjoying with Our App';
            return redirect()->route('courses.index')
            ->with('mssg',$mssg);
        }elseif($selected_departmentId != 0 && $selected_year == 0 && $selected_semester == 0){//that means all departments and spesific year and both semester
            $mssg='Hello '.Auth::user()->username .'You spesify a department and both semester,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexDept',['dept'=>$selected_departmentId])
            ->with('mssg',$mssg);
        }elseif($selected_departmentId == 0 && $selected_year != 0 && $selected_semester == 0){//that means spesific department and all years and both semester
            $mssg='Hello '.Auth::user()->username .'You spesify a year and both semester,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexYear',['year'=>$selected_year])
            ->with('mssg',$mssg);
        }elseif($selected_departmentId == 0 && $selected_year == 0 && $selected_semester != 0){//that means all department and all years and spesific semester
            $mssg='Hello '.Auth::user()->username .'You spesify all department and all years and spesific semester ,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexSemester',['semester'=>$selected_semester])
            ->with('mssg',$mssg);
        }elseif($selected_departmentId != 0 && $selected_year != 0 && $selected_semester == 0){
            $mssg='Hello '.Auth::user()->username .'You spesify a department and a year and and both semester ,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexDeptYear',['dept'=>$selected_departmentId, 'year'=>$selected_year])
            ->with('mssg',$mssg);
        }elseif($selected_departmentId != 0 && $selected_year == 0 && $selected_semester != 0){
            $mssg='Hello '.Auth::user()->username .'You spesify a department and all years and and spesific semester ,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexDeptSemester',['dept'=>$selected_departmentId, 'semester'=>$selected_semester])
            ->with('mssg',$mssg);
        }elseif($selected_departmentId == 0 && $selected_year != 0 && $selected_semester != 0){
            $mssg='Hello '.Auth::user()->username .'You spesify a year and years and all semester ,We wish you Enjoying with Our App';
            return redirect()->route('courses.indexYearSemester',['year'=>$selected_year, 'semester'=>$selected_semester])
            ->with('mssg',$mssg);
        }else{
            $mssg='Hello '.Auth::user()->username .'You spesify department/year/semester';
            return redirect()->route('courses.indexDeptYearSemester',['dept'=>$selected_departmentId, 'year'=>$selected_year, 'semester'=>$selected_semester])
            ->with('mssg',$mssg);
        }
        //$mssg='Hello '.Auth::user()->username .'We wish you Enjoying with Our App';
        //return view('courses.index',compact('courses','mssg','selected_year','selected_departmentId'));
    }
    public function index()
    {
        $allCourses=Course::with(['departments','users'])->get();
        return view('courses.index',compact('allCourses'));
    }
    public function indexDept($dept)
    {
        $coursesDept=Course::with(['users'])->whereHas('departments', function($q) use($dept){
            $q->where('department_id','=',$dept);
        })->get();
        return view('courses.indexDept',compact('coursesDept'));
    }
    public function indexYear($year)
    {
        $coursesYear=Course::with(['users','departments'])->where('year',$year)->get();
        return view('courses.indexYear',compact('coursesYear'));
    }
    public function indexSemester($semester)
    {
        $coursesSemester=Course::with(['users','departments'])->where('semester',$semester)->get();
        return view('courses.indexYear',compact('coursesSemester'));
    }
    public function indexDeptYear($dept, $year)
    {
        $coursesDeptYear=Course::with(['users'])->whereHas('departments', function($q) use($dept){
            $q->where('department_id', '=', $dept);
        })->where('year',$year)->get();
        return view('courses.indexDeptYear',compact('coursesDeptYear'));
    }
    public function indexDeptSemester($dept, $semester)
    {
        $coursesDeptSemester=Course::with(['users'])->whereHas('departments', function($q) use($dept){
            $q->where('department_id', '=',$dept);
        })->where('semester',$semester)->get();
        return view('courses.indexDeptSemester',compact('coursesDeptSemester'));
    }
    public function indexYearSemester($year, $semester)
    {
        $coursesYearSemester=Course::with(['users','departments'])->where('year',$year)->where('semester',$semester)->get();
        return view('courses.indexYearSemester',compact('coursesYearSemester'));
    }
    public function indexDeptYearSemester($dept, $year, $semester)
    {
        $coursesDeptYearSemester=Course::with(['users'])->whereHas('departments', function($q) use($dept){
            $q->where('department_id', '=', $dept);
        })->where('year',$year)->where('semester',$semester)->get();
        return view('courses.indexDeptYearSemester',compact('coursesDeptYearSemester'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
