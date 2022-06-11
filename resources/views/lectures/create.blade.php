@extends('layouts.app-master')

@section('content')

    <div class="panel panel-primary bg-light p-4 rounded row">

        <div class="panel-heading">
          <h2>You Can Upload A New Lecture From Here</h2>
        </div>

        <div class="panel-body">

          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <strong>{{ $message }}</strong>
              </div>
          @endif

          <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="publisher" class="form-label">Publisher :</label>
                <input class="form-control"
                    type="text"
                    class="form-control"
                    name="publisher"
                    placeholder="publisher" value="{{ Auth::user()->username}}" disabled>

                @if ($errors->has('publisher'))
                    <span class="text-danger text-left">{{ $errors->first('publisher') }}</span>
                @endif
              </div>

              <div class="mb-3">
                <label for="lecture_name" class="form-label">lecture_name :</label>
                <input class="form-control"
                    type="text"
                    class="form-control"
                    name="lecture_name"
                    placeholder="lecture_name" required>

                @if ($errors->has('lecture_name'))
                    <span class="text-danger text-left">{{ $errors->first('lecture_name') }}</span>
                @endif
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <input value="{{ old('description') }}"
                    type="text"
                    class="form-control"
                    name="description"
                    placeholder="Description" required>

                @if ($errors->has('description'))
                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="mb-3">
                  <label class="form-label" for="inputFile">File :</label>
                  <input
                      type="file"
                      name="file_path"
                      id="inputFile"
                      class="form-control @error('file_path') is-invalid @enderror">

                  @error('file_path')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <div class="mb-3">
                    <label class="form-label" for="course_id">Determine The Course :</label>
                    <select class="form-control" name="course_id" class="form-control" required>
                        <option value=''></option>
                        @if(Auth::user()->hasRole('Teacher'))
                        <?php $dept=Auth::user()->department->id;
                        $year=Auth::user()->studing_year;?>
                        <optgroup label="One Year">
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->where('year',1)->get() as $course )
                             <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Two Year">
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->where('year',2)->get() as $course )
                            <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Third Year">
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->where('year',3)->get() as $course )
                            <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Fourth Year">
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->where('year',4)->get() as $course )
                            <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Fifth Year">
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->where('year',5)->get() as $course )
                            <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        @else
                        <optgroup label="One Year">
                                @foreach (\App\Models\Course::where('year',1)->get() as $course )
                                 <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                                @endforeach
                        </optgroup>
                        <optgroup label="Two Year">
                            @foreach (\App\Models\Course::where('year',2)->get() as $course )
                             <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Third Year">
                            @foreach (\App\Models\Course::where('year',3)->get() as $course )
                             <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Fourth Year">
                            @foreach (\App\Models\Course::where('year',4)->get() as $course )
                             <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Fifth Year">
                            @foreach (\App\Models\Course::where('year',5)->get() as $course )
                             <option value='{{$course->id}}'>&nbsp;&nbsp;&nbsp;&nbsp; {{$course->course_name}}</option>
                            @endforeach
                        </optgroup>
                        {{-- <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Software"> --}}
                        @endif
                    </select>
                    @if ($errors->has('course_id'))
                        <span class="text-danger text-left">{{ $errors->first('course_id') }}</span>
                    @endif
                </div>
               {{-- <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#Software" class="nav-link active" data-bs-toggle="tab">Software</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Network" class="nav-link" data-bs-toggle="tab">Network</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Artifical" class="nav-link" data-bs-toggle="tab">Artifical</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Software">
                        <label for="course" class="form-label">Software Department Courses :</label>
                        <select class="form-control" name="course_id" class="form-control" required>
                            <option value=''></option>
                            @if(Auth::user()->hasRole('Teacher'))
                            <?php $dept=Auth::user()->department->id;
                            $year=Auth::user()->studing_year;?>
                            @foreach (\App\Models\Course::whereHas('departments', function($q) use($dept){
                                $q->where('department_id', '=', $dept);
                            })->get() as $course )
                                <option value='{{$course->id}}'>{{$course->course_name}}</option>
                            @endforeach
                            @else
                            @foreach (\App\Models\Course::all() as $course )
                                <option value='{{$course->id}}'>{{$course->course_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @if ($errors->has('course_id'))
                            <span class="text-danger text-left">{{ $errors->first('course_id') }}</span>
                        @endif
                    </div>
                     <div class="tab-pane fade" id="Network">
                        <label for="course" class="form-label">Network Department Courses :</label>
                        <select class="form-control" name="course_id" class="form-control" required>
                                <option value=''></option>
                            @foreach (\App\Models\Course::whereHas('departments', function($q){
                                $q->where('department_id', '=', 2);})->get() as $course )
                                <option value='{{$course->id}}'>{{$course->course_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                            <span class="text-danger text-left">{{ $errors->first('course_id') }}</span>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="Artifical">
                        <label for="course" class="form-label">Artifical intelligence Department Courses :</label>
                        <select class="form-control" name="course_id" class="form-control" required>
                            <option value=''></option>
                            @foreach (\App\Models\Course::whereHas('departments', function($q){
                                $q->where('department_id', '=', 3);})->get() as $course )
                                <option value='{{$course->id}}'>{{$course->course_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                            <span class="text-danger text-left">{{ $errors->first('course_id') }}</span>
                        @endif
                    </div>
                </div>--}}
            </div>

              <div class="mb-3">
                  <button type="submit" class="btn btn-success">Create Lecture</button>
              </div>

          </form>

        </div>
      </div>
@endsection
