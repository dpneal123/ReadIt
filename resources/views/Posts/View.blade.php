@section('title', 'Posts')
@extends('layouts.app', ['header' => 'Posts'])

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-4 ml-10 mr-10">
    <div class="flex-col col-span-3 m-4 p-4">
    @foreach($posts as $post)
        <div class="rounded shadow-lg">
            <div class="m-4 mb-0">
                <h2>{{ $post->title }}</h2>
            </div>
            <div class="m-4 mt-0">
            <h5>{{ $post->subtitle }}</h5>
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
    <div class="flex-col hidden sm:flex md:col-span-1">
        <p>room for activities</p>
    </div>
</div>
@endsection
