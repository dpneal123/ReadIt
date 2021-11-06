@section('title', 'Create Post')
@extends('layouts.app', ['header' => 'New Post'])

@section('content')
    <div class="flex-auto m-4">
        <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ url('/posts') }}">&#8592;
            Back to Posts</a>
        <div class="flex-col mx-10 items-center text-center">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="flex flex-col m-10">
                <label for="title">Title</label>
                <textarea rows="2" class="form-control shadow-sm" name="title" id="title"></textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="body">Main Text</label>
                <textarea rows="8" class="form-control shadow-sm" name="body" id="body"></textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="forum_id">Forum</label>
                <select class="form-select shadow-sm" name="forum_id" id="forum_id">
                    @foreach($forums as $forum)
                        <option value="{{ $forum->id }}">{{ $forum->name }}</option>
                    @endforeach
                </select>
                <a class="btn btn-secondary" href="{{ route('forums.create') }}">New Forum</a>
            </div>
            <div class="flex justify-center m-10">
                <input @class('btn btn-primary') type="submit" name="CreatePostButton" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection
