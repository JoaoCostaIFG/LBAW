@extends('layouts.layout')

@section('title', 'Question')
@section('pageType', 'article')

@section('content')

<!-- questions -->
@include('partials.posts.question')
<!-- answers -->
@each('partials.posts.answer', $question->answers, 'answer')

@auth
    <hr>
    <div class="container">
        <h2>Your answer</h2>
        <form method="post" action="{{ url("/question/" . $question->id . "/answer") }}">
            @csrf
            @method('PUT')
            <textarea class="form-control" id="Textarea" name="body" rows="7"></textarea>
            <label class="visually-hidden" for="Textarea">Answer</label>
            <div class="text-end mt-1">
                <input class="btn btn-primary" type="submit" value="Submit answer">
            </div>
            @if ($errors->has('body'))
                <span class="text-danger">Your answer can't be empty</span>
            @endif
        </form>
    </div>
@endauth

@stop
