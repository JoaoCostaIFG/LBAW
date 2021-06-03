@extends('layouts.layout')

@if (isset($question))
@section('titleTab', "Q: ".($question->title))
@endif
@section('title', 'Question')
@section('pageType', 'article')

@section('content')
<script src="{{ asset('js/add_markdown.js') }}" onload="parseQuestionPage()" defer></script>

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
  <script src="{{ asset('js/edit_markdown.js') }}" defer></script>

  <hr>
  <div class="container">
    <form method="post" action="{{ route('answer.add', ["id" => $question->id]) }}">
      @csrf
      @method('PUT')
      <label for="form-answer-body" class="form-label fs-3">Your answer</label>
      <div class="input-group">
        <textarea id="form-answer-body" class="form-control no-resize-ta rounded-2" rows=10 name="body">{{ old('body') }}</textarea>
        <a id="edit-markdown" class="position-absolute fs-4" role="button" href="javascript:void(0)" onclick="openEditorAnswer()">
          <i class="bi bi-markdown"></i>
        </a>
      </div>
      <label class="visually-hidden" for="Textarea">Answer</label>
      <div class="row justify-content-between mt-1 gx-0">
        <span class="col-auto text-danger">
          @if ($errors->has('body'))
            {{ $errors->first('body') }}
          @endif
        </span>
        <input class="col-auto btn btn-primary" type="submit" value="Submit answer">
      </div>
    </form>
  </div>
@endauth
@stop
