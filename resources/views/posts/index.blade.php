@extends('layouts.app-master')

@section('content')

    @php
    //$rolesCurrntUser=array();
    // foreach (auth()->user()->roles as $role)
    //     $rolesCurrntUser[]= $role->name;

        $rolesCurrntUser=auth()->user()->roles->pluck('name')->toarray();
    @endphp
            <h1 class="mb-3">
                Control's @role('Admin')Admin <div class="lead">You Can Manage Any Posts Here For Users Has A Role Student So You @can('post-edit') Can Edit ,@endcan @can('post-edit')Delete @endcan Any Post For Any User In Any Department @can('post-create') , Also You Can Add A New Post @endcan .</div>@endrole
                          @role('Teacher')Teacher <div class="lead">You Can Show Any Profile's Admin Or Any one Of Your Teacher Colleagues here Also you @can('post-edit') Can Edit ,@endcan @can('post-edit')Delete @endcan Any Post For Any Student In Your Department Only @can('post-create') , Also You Can Add A New Post @endcan . @endrole
                          @role('Student')Student <div class="lead">You Can Show Any Profile's Admin Or  Profile's Teacher Or Any one Of Your Student Colleagues here Also @can('post-edit')You Can Edit ,@endcan @can('post-edit')You Can Delete @endcan Any Post For Any Student In Your Department Only @can('post-create') , Also You Can Add A New Post @endcan . @endrole
            </h1>
            <div class="bg-light p-4 rounded">
                <h1>Posts
                    <div style="float: right;">
                        <a href="{{url()->previous()}}" class="btn btn-dark">Back</a>
                    </div>
                </h1>
                <div class="lead">
                    @if(Auth::user()->hasRole('Admin'))
                    Manage your posts For All Departments here.
                    @elseif(Auth::user()->hasRole('Teacher'))
                    Manage your posts For <mark>{{Auth::user()->department->dept_name}}</mark> Department here.
                    @endif
                    @can('post-create')
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">Add post</a>
                    @endcan
                </div>

                <div class="mt-2">
                    @include('layouts.partials.messages')
                </div>

            @if(count($posts))
                <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>Publisher</th>
                    <th>Role Of Publisher</th>
                    <th>Department</th>
                    <th>Title Of Post</th>
                    <th width="5%" colspan="5">Action</th>
                </tr>
                @if(Auth::user()->hasRole('Admin'))
                    @foreach ($posts as $key => $post)
                    <tr class="{{Auth::user()->id==$post->user->id? 'text-success':''}}">
                        <td>{{ $post->id }}</td>
                        <td>{{$post->user->username}}</td>
                        <td>
                            @foreach ($post->user->roles as $role)
                            <span class="badge {{$role->name=='Admin' ? 'bg-success':''}} {{$role->name=='Teacher' ? 'bg-warning':''}} {{$role->name=='Student' ? 'bg-primary':''}}">{{$role->name}}
                            @endforeach
                        </td>
                        <td><span class="badge bg-secondary">{{$post->department->dept_name}}</span></td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Show</a>
                        </td>
                        @if($post->user->hasRole('Admin')&& Auth::user()->id==$post->user->id)
                            @can('post-edit')
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                </td>
                            @endcan
                        @endif
                        @if((!$post->user->hasRole('Admin'))||($post->user->hasRole('Admin')&& Auth::user()->id==$post->user->id))
                            @can('post-delete')
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            @endcan
                        @endif
                    </tr>
                    @endforeach
                    @else
                        @foreach (Auth::user()->department->posts()->orderBy('created_at','DESC')->get() as $post)
                        <tr class="{{Auth::user()->id==$post->user->id ?'text-primary':''}}">
                            <td>{{ $post->id }}</td>
                            <td>{{$post->user->username}}</td>
                            <td>
                                @foreach ($post->user->roles as $role)
                                <span class="badge {{$role->name=='Admin' ? 'bg-success':''}} {{$role->name=='Teacher' ? 'bg-warning':''}} {{$role->name=='Student' ? 'bg-primary':''}}">{{$role->name}}</span>
                                @endforeach
                            </td>
                            <td><span class="badge bg-secondary">{{$post->department->dept_name}}</span></td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Show</a>
                            </td>
                            @if(Auth::id()==$post->user->id)
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                            @elseif($post->user->hasRole('Student'))
                                    @can('post-edit')
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        </td>
                                    @endcan
                                    @can('post-delete')
                                        <td>
                                            {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @endcan
                            @endif
                        </tr>
                        @endforeach
                    @endif
                </table>
        @else
            <div class="alert text-black alert-warning" role="alert">
                <h4 class="alert-heading">Sorry<h4>
                <p>Now There Are not Any Posts .</p>
                <hr>
                <p class="mb-0">Whenever Admin Or Teacher Add A New Posts You definetly Will See It.</p>
            <h1><a href="{{url()->previous()}}" class="btn btn-secondary"> Back</a></h1>
            {{-- problem in back --}}
            </div>
    @endif


    {{-- <div class="d-flex">
        {!! $posts->links() !!}
    </div> --}}
    </div>
@endsection
