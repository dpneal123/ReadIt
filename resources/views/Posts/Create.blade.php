@section('title', 'Create Post')
@extends('layouts.app', ['header' => 'New Post'])

@section('content')
<div class="flex flex-col">
    <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ route('posts.index') }}">&#8592;
        Back to Posts</a>
    <div class="container items-center text-center m-6">

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="flex flex-col m-10">
                <label for="title">Title</label>
                <textarea rows="2" class="block rounded-lg" name="title" id="title"></textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="subtitle">Subtitle</label>
                <textarea rows="4" class="block rounded-lg" name="subtitle" id="subtitle"></textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="body">Main Text</label>
                <textarea rows="8" class="block rounded-lg" name="body" id="body"></textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="forum_id">Forum</label>
                <select name="forum_id" id="forum_id">
                    @foreach($forums as $forum)
                        <option value="{{ $forum->id }}">{{ $forum->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col m-10">
                <input type="submit" name="CreatePostButton" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection
