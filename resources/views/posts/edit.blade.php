@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Update post</h2>
        <div class="lead">
            Edit post.
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input value="{{ $post->title }}"
                        type="text"
                        class="form-control"
                        name="title"
                        placeholder="Title" required>

                    @if ($errors->has('title'))
                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                {{-- <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input value="{{ $post->description }}"
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Description" required>

                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div> --}}

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea
                        type="text"
                        class="form-control"
                        name="body"
                        placeholder="Body" required>{{ $post->body }}</textarea>

                    @if ($errors->has('body'))
                        <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="department_id">Determine The Department :</label>
                    <select class="form-control" name="department_id" class="form-control" required>
                        @if(Auth::user()->hasRole('Teacher'))
                            <option value='{{Auth::user()->department->id}}'>{{Auth::user()->department->dept_name}}</option>
                        @else
                        @foreach (\App\Models\Department::all() as $dept )
                            <option value='{{$dept->id}}'>{{$dept->dept_name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('department_id'))
                        <span class="text-danger text-left">{{ $errors->first('department_id') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('posts.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection

