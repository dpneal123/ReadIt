@section('title', $post->title)
@extends('layouts.app' , ['header' => $post->title])

@section('content')
    <div class="flex flex-col grid-cols-1 ">
        <a class="btn btn-secondary m-2" href="{{ url('/posts') }}">&#8592;
            Back to Posts</a>
        <div class="bg-gray-200 border-gray-600 border-2 shadow-md m-4 rounded-lg">
            <div class="col-span-1 m-6">
                <h1 class="text-3xl font-semibold m-2">{{ $post->title }}</h1>

                <p class="m-2">{{ $post->body }}</p>

                <div class="flex-col lg:flex-row m-2 text-right">
                    <p class="text-sm">Posted at {{ date_format($post->created_at, 'd/m/Y H:i:s') }}</p>
                    @if($post->created_at < $post->updated_at)
                    <p class="text-sm">Last Updated at {{ date_format($post->updated_at, 'd/m/Y H:i:s') }}</p>
                    @endif
                    <p class="text-sm">By {{ $post->author->name }}</p>
                </div>
            </div>
        </div>
        <h1 class="text-xl mx-4">Comments</h1>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <div class="mx-4">
                    <label for="comment"></label>
                    <textarea rows="3" class="form-control shadow-sm" name="comment" id="comment"></textarea>
                </div>
                <div class="mx-4 my-4">
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
            </div>
        </form>
        <div class="flex flex-col grid-cols-1 ml-4">
            @foreach($post->comment as $comm)
                <div class="flex-col grid grid-cols-2 g-gray-200 border-gray-600 border-2 shadow-md p-2 m-2 rounded-lg">
                    <div class="col-span-1">
                        <p class="text-lg">{{ $comm->author->name }}</p>
                        <p class="text-md m-2">{{ $comm->comment }}</p>
                        <p class="text-xs">{{ $comm->created_at }}</p>
                    </div>
                    <div class="col-span-1 m-2 pr-5 justify-self-end">
                    @if (Auth::user() && Auth::user()->id === $comm->user_id)
                        <form action="{{ route('comments.destroy', $comm->id) }}" method="POST">
{{--                            <a class="btn btn-secondary" href="{{ route('comments.edit', $post->id) }}">Edit</a>--}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
