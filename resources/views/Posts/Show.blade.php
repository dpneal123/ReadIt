@section('title', $post->title)
@include('layouts.app')

@section('content')
<div class="flex flex-col">
    <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ route('post.index') }}">&#8592;
        Back to Posts</a>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 mx-10">
        <div class="flex flex-col md:col-span-7 lg:col-span-8">
            <p class="font-sans text-2xl m-4">{{ $post->title }}</p>
            <p class="font-sans text-xl m-4">{{ $post->subtitle }}</p>
            <p class="font-sans text-2xl m-4">{{ $post->body }}</p>
            <p class="font-sans text-xl m-4">{{ $post->created_at }}</p>
        </div>
    </div>
</div>
@endsection
