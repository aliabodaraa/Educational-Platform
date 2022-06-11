<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
class LecturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lectures.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lectures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]/*,['mimes'=>'adasdasd']*/);
        $fileName = 'lecture-'.time().'.'.$request->file_path->extension();//choose name of file via time() function to be identical each time i want to create a new file
        if($request->file_path->move(public_path('downloaded-lectures'), $fileName)){//move the file to public folder in this project
                $lecture= Lecture::create([
                    'lecture_name' => $request->lecture_name,
                    'file_path' => $fileName,
                    'publisher' => Auth::user()->username,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                 ]);
             }

            $depts = $lecture->course->departments->pluck('id','id');
            //dd($depts);
            User::whereIn('department_id', $depts)->where('studing_year', $lecture->course->year)->where('id','<>',Auth::user()->id)->increment('num_new_lectures_not_shown' , 1);
            foreach (User::all() as $admin){
                if($admin->hasRole("Admin"))
                   $admin->increment('num_new_lectures_not_shown' , 1);
               }
            //dd(User::whereIn('department_id', $depts)->where('studing_year', $lecture->course->year)->get());

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file_path', $fileName);
    }


    public function download($file){//http://127.0.0.1:8000/lectures/lecture-1654189222.pdf/download
        $path = public_path("downloaded-lectures/".$file);
        $isExists = file_exists($path);
        if($isExists)
        return response()->download($path);
        else
        return abort(403,"File Does'nt Exist in Public Folder");
    }

    // public function display($id) {
    //     $dbFile = Lecture::findOrFail($id);
    //     $path = public_path("downloaded-lectures/".$dbFile);
    //     $isExists = file_exists($path);
    //     if($isExists){
    //   // file path
    //   $path = public_path("downloaded-lectures/".$dbFile->file_path);
    //   // header
    //  $header = [
    //    'Content-Type' => 'application/pdf',
    //    'Content-Disposition' => 'inline; filename="' . $dbFile . '"'
    //  ];
    // return response()->file($path, $header);}
    // else
    // return abort(403,"File Does'nt Exist in Public Folder");
    // }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
       $lecture->delete();
       unlink('downloaded-lectures/'.$lecture->file_path);
       return redirect()->back()->with('mssg','You have successfully Delete Lecture.');
    }
}
// public function update(Request $request, Course $course)
// {
//     $rules=[
//         'title'=> 'required|min:5|max:150',
//         'status'=> 'required|integer|in:0,1',
//         'link'=> 'required|url',
//         'track_id'=> 'required|integer',];
//     $this->validate($request,$rules);
//     if($course->update($request->all())){
//       if($file=$request->image){
//            $fullname=$file->getClientOriginalName();
//            $extension=$file->getClientOriginalExtension();
//            $fullname_store_in_DB=time().'_'.explode('.',$fullname)[0].'_'.$extension;
//            if($file->move('img',$fullname_store_in_DB)){
//                if($course->photo){
//                   //delete old photo
//                 $fileName=$course->photo->filename;//old photo fileName
//                 unlink('img/'.$fileName);//swap old photo in new photo
//                     $course->photo->filename=$fullname_store_in_DB;
//                     $course->photo->save();
//                 }else{
//                     Photo::create([
//                         'filename'=>$fullname_store_in_DB,
//                         'photoable_id'=>$course->id,
//                         'photoable_type'=>'App\Models\Course',
//                     ]);
//                 }

//             }
//       }
