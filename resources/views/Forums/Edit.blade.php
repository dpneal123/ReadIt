@section('title', 'Edit Forum')
@extends('layouts.app', ['header' => 'Edit Forum'])

@section('content')
    <div class="flex-auto m-4">
        <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ url('/forums') }}">&#8592;
            Back to Forums</a>
        <div class="flex-col mx-10 items-center text-center">
            <form action="{{ route('forums.update', $forum) }}" method="post">
                @method('patch')
                @csrf
                <div class="flex flex-col m-10">
                    <label for="name">Name</label>
                    <textarea rows="2" class="block rounded-lg shadow-sm" name="name" id="name">{{ $forum->name }}</textarea>
                </div>
                <div class="flex flex-col m-10">
                    <label for="description">Description</label>
                    <textarea rows="8" class="block rounded-lg" name="description" id="description">{{ $forum->description }}</textarea>
                </div>
                <div class="flex flex-col m-10 items-center">
                    <label for="active">Active Forum</label>
                    <input type="hidden" name="active" id="active" value="0">
                    <input name="active" id="active" type="checkbox" value="1" @if($forum->active==1) checked @endif>
                </div>
                <div class="flex justify-center m-10">
                    <input @class('px-10 py-4') type="submit" name="UpdateForumButton" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
