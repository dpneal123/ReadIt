@section('title', $current_forum->mame)
@extends('layouts.app', ['header' => $current_forum->name])

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 ml-10 mr-10">
        <div class="flex-col col-span-1 lg:col-span-3 m-4 p-4">
            <h2>{{ $current_forum->description }}</h2>
            @foreach($posts as $post)
                <div class="flex-1 m-2 p-8 rounded shadow-xl w-full text-left">
                    <div class="m-4 mb-0">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div class="m-2">
                        <p>{{ $post->body }}</p>
                    </div>
                    <a class="bg-blue-300 text-black rounded p-2 m-2" href="{{ route('posts.show', $post->id) }}">Show</a>
                    @if (Auth::user() && Auth::user()->id === $post->user_id)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            <a class="bg-blue-300 text-black rounded p-2 m-2" href="{{ route('posts.edit', $post->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="bg-red-300 text-black rounded p-2 m-2">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="flex-col hidden lg:flex lg:col-span-1 m-8">
            <h1>Forums</h1>
            @foreach($forums as $forum)
                <a href="{{ route('forums.show', $forum) }}" class="rounded shadow-lg p-4 m-4">
                    <h2>{{ $forum->name }}</h2>
                </a>
            @endforeach
        </div>
    </div>
@endsection
