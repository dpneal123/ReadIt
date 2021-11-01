@section('title', 'Forums')
@extends('layouts.app', ['header' => 'Forums'])

@section('content')
    <div class="grid place-items-center grid-cols-1 auto-cols-max lg:grid-cols-4 m-4">
            @foreach($forums as $forum)
            <div class="flex col-span-1 m-2 w-full h-full">
                <div class="flex-1 m-2 p-8 rounded shadow-xl w-full h-full text-center">
                <a href="{{ route('forums.show', $forum) }}" class="p-4 m-4">
                    <h2>{{ $forum->name }}</h2>
                </a>
                    <div class="flex-1">
                <a class="bg-blue-300 text-black rounded p-2 m-2" href="{{ route('forums.show', $forum) }}">Show Posts</a>
                @if (Auth::user() && Auth::user()->id === $forum->user_id)
                    <form action="{{ route('forums.destroy', $forum) }}" method="POST" @class('m-2')>
                        <a class="bg-blue-300 text-black rounded p-2 m-2"
                           href="{{ route('forums.edit', $forum) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-300 text-black rounded p-2 m-2">Delete</button>
                    </form>
                @endif
                    </div>
                </div>
            </div>
            @endforeach

    </div>
@endsection
