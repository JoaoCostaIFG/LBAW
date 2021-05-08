@extends('layouts.layout')

@section('title', 'Question')
@section('pageType', 'article')

@section('content')
<div class="container">
    @include('partials.posts.question')
    <hr>
    @each('partials.posts.answer', $question->answers, 'answer')
</div>

<hr>
<div class="container">
  <h2>Your answer</h2>
  <form method="post" action="{{ url("/question/" . $question->id . "/answer") }}">
    @csrf
    @method('PUT')
    <textarea class="form-control" id="Textarea" name="body" rows="7"></textarea>
    <label class="visually-hidden" for="Textarea">Answer</label>
    <button type="submit" class="btn btn-primary">Submit answer</button>
  </form>
</div>
@stop
