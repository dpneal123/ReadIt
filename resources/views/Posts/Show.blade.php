@section('title', $post->title)
@extends('layouts.app' , ['header' => $post->title])

@section('content')
    <div class="flex flex-col grid-cols-1">
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
                <div class="text-left">
                    @livewire('vote', ['post' => $post], key($post->id))
                </div>
            </div>
        </div>
{{--        <h1 class="text-xl mx-4">Comments</h1>--}}
{{--        <form action="{{ route('comments.store', $post->id) }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="flex flex-col">--}}
{{--                <div class="mx-4">--}}
{{--                    <label for="comment"></label>--}}
{{--                    <textarea rows="3" class="form-control shadow-sm" name="comment" id="comment"></textarea>--}}
{{--                </div>--}}
{{--                <div class="mx-4 my-4">--}}
{{--                    <button type="submit" class="btn btn-primary">Add Comment</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        <div class="flex flex-col grid-cols-1 ml-4">--}}
{{--            @foreach($post->comment as $comm)--}}
{{--                <div class="border-gray-600 border-2 rounded-lg m-2 p-2">--}}
{{--                <div class="flex-col grid grid-cols-2 bg-gray-200 shadow-md p-2 m-2">--}}
{{--                    <div class="col-span-1">--}}
{{--                        <p class="text-lg">{{ $comm->author->name }}</p>--}}
{{--                        <p class="text-md m-2">{{ $comm->comment }}</p>--}}
{{--                        <p class="text-xs">{{ $comm->created_at }}</p>--}}
{{--                    </div>--}}
{{--                    <div id="commentButtonArea{{ $comm->id }}" class="col-span-1 m-2 pr-5 justify-self-end">--}}
{{--                        <button id="replyButton" class="btn btn-secondary m-1" onclick="toggleReply({{ $comm->id }});">--}}
{{--                            Reply--}}
{{--                        </button>--}}
{{--                        @if (Auth::user() && Auth::user()->id === $comm->user_id)--}}
{{--                            <form action="{{ route('comments.destroy', $comm->id) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-danger m-1">Delete</button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                    <form action="{{ route('reply.add', ['post' => $post->id, 'comment' => $comm->id]) }}"--}}
{{--                          method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="grid grid-cols-8 m-2 hidden" id="replyArea{{ $comm->id }}">--}}
{{--                            <div class="flex flex-col col-span-7">--}}
{{--                                <label for="replyText">--}}
{{--                                <textarea placeholder="" class="form-control shadow-sm" id="replyText"--}}
{{--                                          name="replyText"></textarea>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col col-span-1">--}}
{{--                                <div class="flex-col grid grid-cols-2">--}}
{{--                                    <a id="cancelReply" class="btn btn-secondary col-span-1 m-1"--}}
{{--                                        onclick="toggleReply({{ $comm->id }});">Cancel</a>--}}
{{--                                    <button type="submit" id="sendReply" class="btn btn-primary col-span-1 m-1">Submit</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                @foreach($comm->reply as $reply)--}}
{{--                    <hr>--}}
{{--                    <div class="grid grid-cols-5">--}}
{{--                        <div class="mx-10 my-2 col-span-4">--}}
{{--                            <p class="text-lg">{{ $reply->author->name }}</p>--}}
{{--                            <p class="text-md m-2">{{ $reply->reply }}</p>--}}
{{--                            <p class="text-xs">{{ $reply->created_at }}</p>--}}
{{--                        </div>--}}
{{--                        <div class="m-2 col-span-1">--}}
{{--                            @if (Auth::user() && Auth::user()->id === $reply->user_id)--}}
{{--                                <form action="{{ route('reply.remove', ['post' => $post->id, 'reply' => $reply->id]) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('POST')--}}
{{--                                    <button type="submit" class="btn btn-danger m-1">Delete</button>--}}
{{--                                </form>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

        @livewire('comments', ['post' => $post], key($post->id))

    </div>
    <script>
        function toggleReply(commentid) {
            var replyArea = document.getElementById("replyArea" + commentid);
            var replyButton = document.getElementById("commentButtonArea" + commentid);

            if (replyArea.style.display !== "block") {
                replyArea.style.display = "block";
            } else {
                replyArea.style.display = "none";
            }

            if (replyButton.style.display !== "none") {
                replyButton.style.display = "none";
            } else {
                replyButton.style.display = "block";
            }
        }
    </script>
@endsection
