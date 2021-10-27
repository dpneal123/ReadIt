@section('title', 'Edit Post')
@extends('layouts.app', ['header' => 'Edit Post'])

@section('content')
<div class="flex flex-col">
    <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ url('/posts') }}">&#8592;
        Back to Posts</a>
    <div class="container items-center text-center m-6">
        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
            {{ method_field('patch') }}
            @csrf
            <div class="flex flex-col m-10">
                <label for="title">Title</label>
                <textarea rows="2" class="block rounded-lg" name="title" id="title">{{ $post->title }}</textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="subtitle">Subtitle</label>
                <textarea rows="4" class="block rounded-lg" name="subtitle"
                          id="subtitle">{{ $post->subtitle }}</textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="body">Main Text</label>
                <textarea rows="8" class="block rounded-lg" name="body" id="body">{{ $post->body }}</textarea>
            </div>
            <div class="flex flex-col m-10">
                <label for="forum_id">Forum</label>
                <select name="forum_id" id="forum_id">
                    @foreach($forums as $forum)
                        <option
                            value="{{ $forum->id }}" {{ $post->forum->name == $forum->name ? 'selected' : '' }}>{{ $forum->name }}</option>
                    @endforeach
                </select>
            </div>
{{--            <div class="flex flex-col m-10">--}}
{{--                <label for="user_id">Author</label>--}}
{{--                <select name="user_id" id="user_id">--}}
{{--                    @foreach($authors as $author)--}}
{{--                        <option--}}
{{--                            value="{{ $author->id }}" {{ $post->author->name == $author->name ? 'selected' : '' }}>{{ $author->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="flex flex-col m-10">
                <input type="submit" name="UpdatePostButton" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection
