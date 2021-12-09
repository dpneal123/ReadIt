<div>
    {{--    <form action="{{ route('reply.add', ['post' => $post->id, 'comment' => $comm->id]) }}"--}}
    {{--          method="POST">--}}
    {{--        @csrf--}}
    <div>
        <div class="grid grid-cols-8 m-2 hidden" id="replyArea{{ $comm->id }}">
            <div class="flex flex-col col-span-7">
                <label for="reply">
                <textarea wire:model.defer="reply_input" class="form-control shadow-sm" id="reply" name="reply"></textarea>
                </label>
            </div>
            <div class="flex flex-col col-span-1">
                <div class="flex-col grid grid-cols-2">
                    <a id="cancelReply" class="btn btn-secondary col-span-1 m-1"
                       onclick="toggleReply({{ $comm->id }});">Cancel</a>
                    <button wire:click="addReply({{ $comm->id }})" id="addReply" name="addReply"
                            class="btn btn-primary col-span-1 m-1">Submit
                    </button>
                </div>
            </div>
        </div>
        {{--    </form>--}}
        @foreach($comm->reply as $reply)
            <hr>
            <div class="grid grid-cols-5">
                <div class="mx-10 my-2 col-span-4">
                    <p class="text-lg">{{ $reply->author->name }}</p>
                    <p class="text-md m-2">{{ $reply->reply }}</p>
                    <p class="text-xs">{{ $reply->created_at }}</p>
                </div>
                <div class="m-2 col-span-1">
                    @if (Auth::user() && Auth::user()->id === $reply->user_id)
                        {{--                    <form action="{{ route('reply.remove', ['post' => $post->id, 'reply' => $reply->id]) }}" method="POST">--}}
                        {{--                        @csrf--}}
                        {{--                        @method('POST')--}}
                        <button wire:click="removeReply({{ $reply->id }})" class="btn btn-danger m-1">Delete</button>
                        {{--                    </form>--}}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
