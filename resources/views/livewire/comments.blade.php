<div>
    <h1 class="text-xl mx-4">Comments</h1>
        <div class="flex flex-col">
            <div class="mx-4">
                <label for="comment"></label>
                <textarea wire:model="comment_input" rows="3" class="form-control shadow-sm" name="comment" id="comment"></textarea>
            </div>
            <div class="mx-4 my-4">
                <button wire:click="addComment({{ $post->id }})" id="addComment" name="addComment"
                        class="btn btn-primary">Add Comment</button>
            </div>
        </div>
    <div class="flex flex-col grid-cols-1 ml-4">
        @foreach($post->comment as $comm)
            <div class="border-gray-600 border-2 rounded-lg m-2 p-2">
                <div class="flex-col grid grid-cols-2 bg-gray-200 shadow-md p-2 m-2">
                    <div class="col-span-1">
                        <p class="text-lg">{{ $comm->author->name }}</p>
                        <p class="text-md m-2">{{ $comm->comment }}</p>
                        <p class="text-xs">{{ $comm->created_at }}</p>
                    </div>
                    <div id="commentButtonArea{{ $comm->id }}" class="col-span-1 m-2 pr-5 justify-self-end">
                        <button id="replyButton" class="btn btn-secondary m-1" onclick="toggleReply({{ $comm->id }})">
                            Reply
                        </button>
                        @if (Auth::user() && Auth::user()->id === $comm->user_id)
{{--                            <form action="{{ route('comments.destroy', $comm->id) }}" method="POST">--}}
{{--                                @csrf--}}
                                <button wire:click="removeComment({{ $comm->id }})" class="btn btn-danger m-1">Delete</button>
{{--                            </form>--}}
                        @endif
                    </div>
                </div>
                @livewire('replies', ['comm' => $comm], key($comm['id']))

            </div>
        @endforeach
    </div>
</div>



