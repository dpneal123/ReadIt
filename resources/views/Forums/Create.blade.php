@section('title', 'New Forum')
@extends('layouts.app', ['header' => 'New Forum'])

@section('content')
    <div class="flex-auto m-4">
        <a class="font-sans font-semibold text-blue-500 hover:text-indigo-400 m-4" href="{{ url('/forums') }}">&#8592;
            Back to Forums</a>
        <div class="flex-col mx-10 items-center text-center">
            <form action="{{ route('forums.store') }}" method="post">
                @csrf
                <div class="flex flex-col m-10">
                    <label for="name">Name</label>
                    <textarea rows="2" class="block rounded-lg shadow-sm" name="name" id="name"></textarea>
                </div>
                <div class="flex flex-col m-10">
                    <label for="description">Description</label>
                    <textarea rows="8" class="block rounded-lg" name="description" id="description"></textarea>
                </div>
                <div class="flex flex-col m-10 items-center">
                    <label for="active">Active Forum</label>
                    <input type="hidden" name="active" id="active" value="0">
                    <input type="checkbox" name="active" id="active" value="1">
                </div>
                <div class="flex justify-center m-10">
                    <input @class('px-10 py-4') type="submit" name="CreateForumButton" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
