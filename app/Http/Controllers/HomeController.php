<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()){
        $dept=Auth::user()->department->id;
        $someCoursesBelongToYourDepatment=Course::with(['departments'])->whereHas('departments', function($q) use($dept){
        $q->where('department_id', '=',$dept);})->where('year',Auth::user()->studing_year)->orderBy('created_at','ASC')->limit(3)->get();

        $somePostsBelongToYourDepatment=Auth::user()->posts;
        return view('home.index',compact('someCoursesBelongToYourDepatment','somePostsBelongToYourDepatment'));
    }else
    return back();
    }
}
