@extends('layouts.layout')

@if (isset($question))
@section('titleTab', "Q: ".($question->title))
@endif
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
      <div class="row justify-content-between mt-1 gx-0">
        <span class="col-auto text-danger">
          @if ($errors->has('body'))
            Your answer can't be empty
          @endif
        </span>
        <input class="col-auto btn btn-primary" type="submit" value="Submit answer">
      </div>
    </form>
  </div>
@endauth

@stop
