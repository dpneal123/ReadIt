@section('title', $post->title)
@extends('layouts.app' , ['header' => $post->title])

@section('content')
    <div class="flex flex-col grid-cols-1 ">
        <a class="btn btn-secondary m-2" href="{{ url('/posts') }}">&#8592;
            Back to Posts</a>
        <div class="bg-gray-200 border-gray-600 border-2 shadow-md m-4">
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

    </div>
@endsection
