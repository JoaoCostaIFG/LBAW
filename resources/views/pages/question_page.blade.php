@extends('layouts.layout')

@if (isset($question))
@section('titleTab', "Q: ".($question->title))
@endif
@section('title', 'Question')
@section('pageType', 'article')

@section('content')

<!-- Report Modal -->
@include('partials.posts.report')

<!-- Feedback Message -->
@if (session('status'))
<div class="alert alert-success mt-2">
  {{ session('status') }}
</div>
@endif

@if (session('fail'))
<div class="alert alert-danger mt-2">
  {{ session('fail') }}
</div>
@endif

<!-- questions -->
@include('partials.posts.question')
<!-- answers -->
@each('partials.posts.answer', $question->answers, 'answer')

@auth
  <script src="{{ asset('js/edit_comment_answer.js') }}"></script>
  <script src="{{ asset('js/add_comment.js') }}"></script>

  <hr>
  <div class="container">
    <h2>Your answer</h2>
    <form method="post" action="{{ url("/question/" . $question->id . "/answer") }}">
      @csrf
      @method('PUT')
      <textarea id="Textarea" class="form-control no-resize-ta" name="body"></textarea>
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
