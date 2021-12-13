@section('title', 'Posts')
@extends('layouts.app', ['header' => 'Posts'])

@section('content')
    <div class="grid grid-cols-1 md:ml-10 md:mr-10">
        <div class="flex-col col-span-1 m-2 md:m-4 p-4">
            <div class="text-center m-6 mt-0">
                <a class="btn btn-primary" href="{{ route('posts.create') }}">New Post</a>
                <a class="btn btn-primary" href="{{ route('forums.create') }}">New Forum</a>
            </div>
            @foreach($posts as $post)
                <div class="flex-1 m-2 p-8 bg-gray-200 border-gray-600 border-2 rounded shadow-lg w-full text-left">
                    <a class="" href="{{ route('forums.show', $post->forum) }}">
                        <h2 class="text-sm m-2 mb-0">{{ $post->forum->name }}</h2>
                    </a>
                    <div class="m-2 mb-0">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    </div>
                    <div class="m-2">
                        <p class="line-clamp-10 md:line-clamp-none">{{ $post->body }}</p>
                    </div>
                    <div class="grid grid-cols-8 mt-4">
                        <div class="col-span-1">
{{--                            <form class="grid-span-1" action="{{ route('posts.upvote', $post->id) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <button id="upvote" name="upvote" type="submit"--}}
{{--                                        class="text-xl cursor-pointer mx-2 @if(DB::table('post_votes')->where(['post_id' => $post->id, 'isUp' => 1, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->exists()) text-green-600 @else text-black @endif">--}}
{{--                                    &#8593; {{ $post->vote->where('isUp', true)->count() }}</button>--}}
{{--                            </form>--}}
{{--                            <form class="grid-span-1" action="{{ route('posts.downvote', $post->id) }}"--}}
{{--                                  method="POST">--}}
{{--                                @csrf--}}
{{--                                <button id="downvote" name="downvote" type="submit"--}}
{{--                                        class="text-xl cursor-pointer @if(DB::table('post_votes')->where(['post_id' => $post->id, 'isUp' => 0, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->exists()) text-red-600 @else text-black @endif">--}}
{{--                                    &#8595; {{ $post->vote->where('isUp', false)->count() }}</button>--}}
{{--                            </form>--}}
                            @livewire('vote', ['post' => $post], key($post->id))
                        </div>
                        <div class="col-end-8 col-span-2">
                            @if (Auth::user() && Auth::user()->id === $post->user_id)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @endif

                                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">Show</a>

                                    @if (Auth::user() && Auth::user()->id === $post->user_id)
                                        <a class="btn btn-secondary"
                                           href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
        {{--        <div class="flex-col hidden lg:flex lg:col-span-1 m-8">--}}
        {{--            <h1>Suggested Forums</h1>--}}
        {{--            @foreach($forums as $forum)--}}
        {{--                <a href="{{ route('forums.show', $forum) }}" class="m-4 p-4 flex-row bg-gray-200 border-gray-600 border-2 rounded shadow-lg w-full text-left">--}}
        {{--                    <h2>{{ $forum->name }}</h2>--}}
        {{--                </a>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
    </div>
    @livewireScripts
@endsection
