@extends('layouts.app-master')

@section('content')
@if(count($course->lectures))
<div class="bg-light p-4 rounded row">
    @if ($message = Session::get('mssg'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2>show Courses</h2>
    <span><a href="{{url()->previous()}}" class="btn btn-warning" style="float: right;margin-right: 33px;"> Back</a></span>
    <p class="lead">
        All Lectures For The Course <b class="badge bg-primary">{{$course->course_name}}</b>
      </p>
    <div class="row p-4">
        @foreach ($course->lectures as $lecture)
            <div class="card text-white bg-secondary mx-2 mb-3" style="max-width: 18rem;">
                <div class="card-header"><h3>Lecture {{$lecture->id}}</h3></div>
                <div class="card-body">
                    <p class="card-text">Title : {{$lecture->lecture_name}}</p>
                    <p class="card-text">Description : {{$lecture->description}}</p>
                    <p class="card-text">Publisher Name : <b class="badge bg-primary">{{$lecture->publisher}}</b></p>
                    {{-- <a href="{{route('lectures.destroy',$lecture->id)}}" class="btn btn-danger" style="float: right;"> Delete</a> --}}
                    {{-- http://127.0.0.1:8000/lectures/lecture-1654189222.pdf/download --}}

                        <form method="POST" action="{{route('lectures.destroy',$lecture->id)}}">
                            @csrf
                            @method('DELETE')
                            {{-- <a href="{{route('lectures.display',$lecture->id)}}" class="btn btn-warning" target="_blank">PreView</a> --}}
                                <a href="{{route('lectures.download',$lecture->file_path)}}" class="btn btn-success"> Download</a>
                                @if(!Auth::user()->hasRole('Student'))
                                    <a class="btn btn-danger" style="float: right;" onclick="confirm('Are You Sure you want to Delete this Lecture')?this.parentElement.submit():'' ">
                                    Delete </a>
                                @endif
                        </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else
<div class="alert text-black alert-success" role="alert">
    <h4 class="alert-heading">Sorry<h4>
    <p>This course has not any lectures yet .</p>
    <hr>
    <p class="mb-0">Whenever you need to enter to any course, notice to the count of lectuers before entering.</p>
   <h1><a href="{{url()->previous()}}" class="btn btn-secondary"> Back</a></h1>
   {{-- problem in back --}}
</div>
@endif
@endsection
