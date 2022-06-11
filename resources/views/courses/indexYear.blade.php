@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded row">
    @if ($message = Session::get('mssg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    @endif
    @if(count($coursesYear) !=0 )
    <h2>index courses for spesific Year</h2>
    <div class="lead">
        index for spesific Year.
    </div>
            @foreach ($coursesYear as $course)
                <div class="card mb-3 border-info">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src='{!! url('images/Information-Science-Engineering.png') !!}' alt='dog'  class="card-img-top" alt="...">
                        </div>
                        <div class="card-body bg-default border-danger col-md-5">
                            <h3 class="card-title text-dark">{{$course->course_name}}</h3>
                            <p class="card-text">departments that have this course:</p>
                            @foreach ($course->departments as $dept)
                                <h3 class="badge bg-info">{{$dept->dept_name}}</h3>
                                {{-- @foreach ($course->lectures as $lec)
                                <h3>{{!$lec->lecture_name?$lec->lecture_name:'no lectures'}}</h3>
                                @endforeach --}}
                            @endforeach
                            <p class="card-text">uses that have this course:</p>
                            @foreach ($course->users as $user)
                            <b>{{$user->username}}</b>
                                {{-- @foreach ($course->lectures as $lec)
                                <h3>{{!$lec->lecture_name?$lec->lecture_name:'no lectures'}}</h3>
                                @endforeach --}}
                            @endforeach
                            <?php
                                if(count($course->lectures)==0){
                                    $disableGo=true;
                                }else{
                                    $disableGo=false;
                                }
                            ?>
                            <p class="card-text">number of Lictures : <span class="badge bg-<?php if(count($course->lectures)!=0) echo 'success'; else echo'danger'; ?> rounded-pill">{{count($course->lectures) }} {{ Str::plural('lecture',count($course->lectures))}}</span></p>
                            <p class="card-text">semester:{{$course->semester}}</p>
                            <p class="card-text">Year:{{$course->year}}</p>
                            <a href="{{route('courses.show',$course->id)}}" class="btn btn-primary {{$disableGo?'disabled':''}}"> go to lectures</a>
                            <p class="card-text"><small class="text-muted" style="float: right;">Last updated {{$course->updated_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
            <div class="alert text-black alert-success" role="alert">
                <h4 class="alert-heading">Sorry<h4>
                <p>This course has not any lectures yet .</p>
                <hr>
                <p class="mb-0">Whenever you need to filter anything, notice to the count of lectuers before entering.</p>
               <h1><a href="{{url()->previous()}}" class="btn btn-secondary"> Back</a></h1>
               {{-- problem in back --}}
            </div>
          @endif
</div>

@endsection
