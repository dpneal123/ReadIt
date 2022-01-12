@section('title', 'Forums')
@extends('layouts.app', ['header' => 'Forums'])

@section('content')
    <div class="text-center m-6 mt-12">
        <a class="btn btn-primary" href="{{ route('posts.create') }}">New Post</a>
        <a class="btn btn-primary" href="{{ route('forums.create') }}">New Forum</a>
    </div>
    <div class="grid place-items-center grid-cols-1 auto-cols-max lg:grid-cols-4 m-4">
            @foreach($forums as $forum)
            <div class="flex col-span-1 w-full h-full">
                <div class="flex-1 m-2 p-2 @if($forum->active==1) bg-gray-200 @else bg-red-200 @endif border-gray-600 border-2 rounded shadow-lg text-center">
                <a href="{{ route('forums.show', $forum) }}" class="p-4 m-4">
                    <h2>{{ $forum->name }}</h2>
                </a>
                    <a href="{{ route('forums.show', $forum) }}" class="p-4 m-4">
                        <h5>{{ $forum->description }}</h5>
                    </a>
                    <div class="flex-1">
                <a class="btn btn-primary m-2" href="{{ route('forums.show', $forum) }}">Show Posts</a>
                @if (Auth::user() && Auth::user()->id === $forum->user_id)
                    <form action="{{ route('forums.destroy', $forum) }}" method="POST">
                        <a class="btn btn-secondary"
                           href="{{ route('forums.edit', $forum) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                    </div>
                    <p>{{ $forum->post()->count() }} posts</p>
                </div>
            </div>
            @endforeach
        {{ $forums->links() }}
    </div>
@endsection
