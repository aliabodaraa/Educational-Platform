@extends('layouts.app-master')

@section('content')

    <div class="panel panel-primary bg-light p-4 rounded row">
        <h1 class="mb-3">
            Custom Showing @role('Admin')<div class="lead">You Can Make Custom Showing For any Department For Any Years For Any Semester Or Both .</div> @endrole
                      @role('Teacher')Teacher <div class="lead">You Can Make Custom Showing Only For Your <mark>{{Auth::user()->department->dept_name}}</mark> department With Any Years Or All With Any Semester Or Both .</div> @endrole
                      @role('Student')Student <div class="lead">You Can Make Custom Showing Only For Your <mark>{{Auth::user()->department->dept_name}}</mark> department With Only Your Current Year <mark>{{Auth::user()->studing_year}}</mark> With Any Semester Or Both .</div> @endrole
        </h1>
        <div class="panel-body">

          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <strong>{{ $message }}</strong>
              </div>
          @endif

          <form action="{{ route('courses.chooseYearDept') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="department" class="form-label">Department :</label>
                <select class="form-control" name="department_idC" class="form-control" required>
                    @if(Auth::user()->hasRole('Admin'))
                        <option value='0'>All Departments</option>
                        @foreach (\App\Models\Department::all() as $department )
                            <option value='{{$department->id}}'>{{$department->dept_name}}</option>
                        @endforeach
                    @else
                        <option value='{{Auth::user()->department->id}}'>{{Auth::user()->department->dept_name}}</option>
                    @endif
                </select>
                @if ($errors->has('department_idC'))
                    <span class="text-danger text-left">{{ $errors->first('department_idC') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Studing Year :</label>
                <select class="form-control" name="yearC" class="form-control" required>
                    @if(Auth::user()->hasRole('Student'))
                        <option value='{{Auth::user()->studing_year}}'>
                            @if(Auth::user()->studing_year == 1)
                            First Year
                            @elseif(Auth::user()->studing_year == 2)
                            Second Year
                            @elseif(Auth::user()->studing_year == 3)
                            Third Year
                            @elseif(Auth::user()->studing_year == 4)
                            Fourth Year
                            @elseif(Auth::user()->studing_year == 5)
                            Fifth Year
                            @endif</option>
                    @else
                        <option value='0'>All Year</option>
                        <option value='1'>First Year</option>
                        <option value='2'>Secound Year</option>
                        <option value='3'>Third Year</option>
                        <option value='4'>Fourth Year</option>
                        <option value='5'>Fifth Year</option>
                    @endif
                </select>
                @if ($errors->has('yearC'))
                    <span class="text-danger text-left">{{ $errors->first('yearC') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">Semester :</label>
                <select class="form-control" name="semesterC" class="form-control" required>
                        <option value='0'>All Semester</option>
                        <option value='1'>First Semester</option>
                        <option value='2'>Second Semester</option>
                </select>
                @if ($errors->has('semesterC'))
                    <span class="text-danger text-left">{{ $errors->first('semesterC') }}</span>
                @endif
            </div>

            <div class="mb-3">
                  <button type="submit" class="btn btn-success">Find Your Courses</button>
            </div>

          </form>

        </div>
      </div>
@endsection
