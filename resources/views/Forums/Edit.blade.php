@section('title', 'Edit Forum')
@extends('layouts.app', ['header' => 'Edit Forum'])

@section('content')
    <div class="flex-auto m-4">
        <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ url('/forums') }}">&#8592;
            Back to Forums</a>
        <div class="flex-col mx-10 items-center text-center">
            <form action="{{ route('forums.update', $forum) }}" method="post">
                {{ method_field('patch') }}
                @csrf
                <div class="flex flex-col m-10">
                    <label for="name">Name</label>
                    <textarea rows="2" class="form-control shadow-sm" name="name" id="name">{{ $forum->name }}</textarea>
                </div>
                <div class="flex flex-col m-10">
                    <label for="description">Description</label>
                    <textarea rows="8" class="form-control shadow-sm" name="description" id="description">{{ $forum->description }}</textarea>
                </div>
                <div class="flex flex-col m-10 items-center">
                    <label for="active">Active Forum</label>
                    <input type="hidden" name="active" id="active" value="0">
                    <input class="form-checkbox shadow-sm" type="checkbox" name="active" id="active" value="1" @if($forum->active==1) checked @endif>
                </div>
                <div class="flex justify-center m-10">
                    <input @class('btn btn-primary') type="submit" name="UpdateForumButton" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
