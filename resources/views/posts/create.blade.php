@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Add new post</h2>
        <div class="lead">
            Add new post.
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input value="{{ old('title') }}"
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
                    <input value="{{ old('description') }}"
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
                    <textarea class="form-control"
                        name="body"
                        placeholder="Body" required>{{ old('body') }}</textarea>

                    @if ($errors->has('body'))
                        <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="department_id">Determine The Department :</label>
                    <select class="form-control" name="department_id" class="form-control" required>
                        @if(Auth::user()->hasRole('Admin'))
                        @foreach (\App\Models\Department::all() as $dept )
                        <option value='{{$dept->id}}'>{{$dept->dept_name}}</option>
                        @endforeach
                        @else
                        <option value='{{Auth::user()->department_id}}'>{{Auth::user()->department->dept_name}}</option>
                        @endif
                    </select>
                    @if ($errors->has('department_id'))
                        <span class="text-danger text-left">{{ $errors->first('department_id') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
