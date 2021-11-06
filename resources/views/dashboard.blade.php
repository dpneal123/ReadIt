@section('title', 'Posts')
@extends('layouts.app', ['header' => 'Recent Posts'])

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 ml-10 mr-10">
        <div class="flex-col hidden lg:flex lg:col-span-1 m-8">
            <h1>Suggested Forums</h1>
            @foreach($forums as $forum)
                <a href="{{ route('forums.show', $forum) }}"
                   class="m-4 p-4 flex-row bg-gray-200 border-gray-600 border-2 rounded shadow-lg w-full text-left">
                    <h2>{{ $forum->name }}</h2>
                </a>
            @endforeach
        </div>
        <div class="flex-col col-span-1 lg:col-span-3 m-4 p-4 scrolling-pagination">
            @foreach($posts as $post)
                <div class="flex-1 m-2 p-8 bg-gray-200 border-gray-600 border-2 rounded shadow-lg w-full text-left">
                    <div class="m-2 mb-0">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    </div>
                    <div class="m-2">
                        <p class="line-clamp-10 md:line-clamp-none">{{ $post->body }}</p>
                    </div>

                    <div class="m-2">

                        @if (Auth::user() && Auth::user()->id === $post->user_id)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @endif

                                <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">Show</a>

                                @if (Auth::user() && Auth::user()->id === $post->user_id)
                                    <a class="btn btn-secondary" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            @auth
                {{ $posts->links() }}
            @endauth
        </div>
    </div>
@endsection
