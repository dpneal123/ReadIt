<div class="flex flex-col text-center m-8">
    <div class="flex flex-row">
        <input wire:model="search" class="form-control" type="text" placeholder="Search all posts & forums"/>
    </div>
    <div class="flex flex-row grid grid-cols-2 border-2 bg-gray-200">
        <div class="flex flex-col grid-span-1 align-top align-text-top">
            @if($posts != null)
                <p>Posts:</p>
                <div class="m-2">
                    @foreach($posts as $post)
                        <a class="flex bg-blue-100 border-2 border-black p-2 m-2 sm:m-4"
                           href="{{ route('posts.show', $post->id) }}">
                            <div class="flex flex-col">
                                <div class="flex flex-row">
                                    <p>{{ $post->title }}</p>
                                </div>
                                <div class="flex flex-row p-2">
                                    <p>{{ Str::limit($post->body, 200) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="flex flex-col grid-span-1 align-top align-text-top">
            @if($forums != null)
                <p>Forums:</p>
                <div class="m-2">
                    @foreach($forums as $forum)
                        <a class="flex bg-indigo-300 border-2 border-black p-2 m-2 sm:m-4"
                           href="{{ route('forums.show', $forum->id) }}">
                            <div class="flex flex-col">
                                <div class="flex flex-row">
                                    <p>{{ $forum->name }}</p>
                                </div>
                                <div class="flex flex-row">
                                    <p>{{ Str::limit($forum->description, 100) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
