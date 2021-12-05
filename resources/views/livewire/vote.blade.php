<div wire:poll.1s class="grid grid-cols-2">
    <div class="grid-span-1">
        <button wire:click="upVote({{ $post }})" id="upvote" name="upvote"
                class="text-xl cursor-pointer mx-2 @if($post->vote->where(['isUp' => 1, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->count() > 0) text-green-600 @else text-black @endif">
            &#8593; {{ $post->vote->where('isUp', true)->count() }}</button>
    </div>
    <div class="grid-span-1 mx-2">
        <button wire:click="downVote({{ $post }})" id="downvote" name="downvote"
                class="text-xl cursor-pointer @if($post->vote->where(['isUp' => 0, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->count() > 0) text-red-600 @else text-black @endif">
        &#8595; {{ $post->vote->where('isUp', false)->count() }}</button>
    </div>
</div>

