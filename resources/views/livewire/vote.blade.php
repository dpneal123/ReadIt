<div class="flex flex-row">
    <div wire:poll.visible class="flex flex-col">
        <button wire:click="upVote({{ $post['id'] }})" id="upvote" name="upvote"
                class="text-xl cursor-pointer mx-2 @if($upOrDown == 'up') text-green-600 @else text-black @endif">
            &#8593; {{ $post->vote->where('isUp', true)->count() }}</button>
    </div>
    <div class="flex flex-col">
        <button wire:click="downVote({{ $post['id'] }})" id="downvote" name="downvote"
                class="text-xl cursor-pointer @if($upOrDown == 'down') text-red-600 @else text-black @endif">
        &#8595; {{ $post->vote->where('isUp', false)->count() }}</button>
    </div>
</div>

