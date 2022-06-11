@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        @auth
            <h2>Hello From My Application</h2>
            <p class="lead">Only authenticated users can access this section.</p>
            @if(Auth::user()->num_new_lectures_not_shown !=0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><mark>{{Auth::user()->num_new_lectures_not_shown}} {{Str::plural('lecture',Auth::user()->num_new_lectures_not_shown)}}</mark> were added in the <mark>{{Auth::user()->studing_year}}'th</mark> in the <mark>{{Auth::user()->department->dept_name}}</mark> department</strong>
                    <button type="button" class="btn btn-warning mt-2" style="display:flex;"><a style="display:flex;text-decoration:none;color:white;" href="http://127.0.0.1:8000/courses/dept/{{Auth::user()->department_id}}/year/{{Auth::user()->studing_year}}">Go Direct</a></button>
                    <button type="button" class="btn-close mt-4" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(Auth::user()->num_new_posts_not_shown !=0)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong><mark>{{Auth::user()->num_new_posts_not_shown}} {{Str::plural('post',Auth::user()->num_new_posts_not_shown)}}</mark> were added in the <mark>{{Auth::user()->department->dept_name}}</mark> department</strong>
                <button type="button" class="btn btn-info mt-2" style="display:flex;"><a style="display:flex;text-decoration:none;color:white;" href="{{route('posts.index')}}">Go Direct</a></button>
                <button type="button" class="btn-close mt-4" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(count($someCoursesBelongToYourDepatment))
                <h4>@if(Auth::user()->hasRole('Teacher'))
                   Some Courses That You Teach :
                  @else
                   Some Of Your Courses :
                  @endif
                </h4>
                <div class="courses">
                    @foreach ($someCoursesBelongToYourDepatment as $course )
                        <div class="card1" style="display: inline-grid;
                                                grid-template-columns: repeat(2, 1fr);
                                                grid-template-rows: auto;
                                                width: min(100%, 410px);
                                                box-shadow: 0 20px 34px hsla(20deg, 1%, 52%, 0.29);
                                                background-color: #e4e4e4;
                                                overflow: hidden;
                                                border: 1px solid #bcbcbc;">
                            <img src='{!! url('images/Information-Science-Engineering.png') !!}' alt='dog' style="max-width: 100%;
                                                                                                                min-height: 100%;
                                                                                                                object-fit: cover;
                                                                                                                display: block;
                                                                                                                clip-path: polygon(-4px -4px, 100.4% -3px, 91.2% 102.57%, -0.8% 102.97%);">
                            <div class="card-details1" style="padding: 18px 9px;">
                            <b>{{$course->course_name}}</b>
                            @foreach ($course->departments as $depart)
                            <p class="badge bg-info">{{$depart->dept_name}}</p>
                            @endforeach
                            <p><b>Doctor: </b>{{$course->doctor_name}}</p>
                            <?php
                            if(count($course->lectures)==0){
                                $disableGo=true;
                            }else{
                                $disableGo=false;
                            }?>
                            <p class="card-text">Lictures : <span class="badge bg-<?php if(count($course->lectures)!=0) echo 'success'; else echo'danger'; ?> rounded-pill">{{count($course->lectures) }} {{ Str::plural('lecture',count($course->lectures))}}</span></p>
                            {{-- <p class="card-text">semester:{{$course->semester}}</p>
                            <p class="card-text">Year:{{$course->year}}</p> --}}
                            <a href="{{route('courses.show',$course->id)}}" class="btn btn-sm btn-secondary {{$disableGo?'disabled':''}}"> go to lectures</a>
                            <p class="card-text"><small class="text-muted" style="position: relative;
                                font-size: 11px;
                                bottom: -18px;
                                right: 18px;">Last updated {{$course->updated_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    @endforeach
                  </div>
             @endif
             @if(count($somePostsBelongToYourDepatment))
             <h4 style="margin-top:10px;">Some Of Your Posts :</h4>
                <div class="posts" style="    display: -webkit-box;
                overflow-x: scroll;
            ">
                    @foreach ($somePostsBelongToYourDepatment as $post)
                        <div class="post" style="width: 33.33%;margin-right: 5px;    overflow: hidden;box-shadow: 0 20px 34px hsl(20deg 1% 52% / 29%);
                        background-color: #dfdfdf;
                        border-radius: 8px;">
                                <div class="title" style="
                                text-align: center;
                                padding: 10px 0 0 0;">
                                <h4>{{$post->title}}</h4>
                                <span class="badge bg-primary" style="
                                    position: relative;
                                    top: -30px;
                                    right: 105px;">{{$post->user->username}}</span>
                                <span class="badge bg-warning" style="
                                    position: relative;
                                    top: -30px;
                                    left: 105px;">{{$post->department->dept_name}}</span>
                                </div>
                                <div class="body" style="     margin-top: -12px;   font-size: 18px;
                                width: 100%;
                                background-color: #0f4b85;
                                padding: 5px;
                                color: whitesmoke;
                                border-radius: 0 0 8px 8px;">
                                    <p>{{$post->body}} </p>
                                    <p>{{$post->description}}</p>
                                    <p class="card-text"><small class="text-muted" style="position: relative;
                                        font-size: 13px;float:right;
                                        left: 0;">Last updated {{$post->updated_at->diffForHumans()}}</small></p>
                                </div>
                        </div>
                    @endforeach
                </div>
            @endif


        @endauth

        @guest
        <h1>Homepage</h1>
        <h2>{{session('success')}}</h2>
        <p class="lead">Your viewing the home page. Please <mark>Login</mark> to view the restricted data Or click <mark>Sign-up</mark> button to create a new account for you</p>
        @endguest
    </div>
@endsection
