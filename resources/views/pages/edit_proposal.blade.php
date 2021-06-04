
@extends('layouts.layout')

@section('title', 'Edit Question')
@section('pageType', 'website')

@section('content')

@if ($post->type == "question")
<h2 class="page-title">Propose Edit Question</h2>
@else
<h2 class="page-title">Propose Edit Answer</h2>
@endif
<hr class="mt-3">
<form method="POST" action="{{ route('propose.edit.insert', ["id" => $post->id]) }}">
  @csrf
  <input type="hidden" name="id_post" value="{{ $post->id }}">

  <div class="input-group mt-2">
    @if ($post->type == "question")
    <label for="form-question-body" class="form-label"><b>Question details</b><span class="text-danger"> *</span></label>
    @else
    <label for="form-answer-body" class="form-label"><b>Answer details</b><span class="text-danger"> *</span></label>
    @endif

    @if ($post->type == "question")
      <div class="input-group has-validation">
        <textarea id="form-question-body" class="no-resize-ta form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
        name="body" rows="30" placeholder="Enter question details...">{{ old('body') ?? $post->body }}</textarea>
        <a id="edit-markdown" class="position-absolute fs-4" role="button" href="javascript:void(0)" onclick="openEditorQuestion()">
          <i class="bi bi-markdown"></i>
        </a>
        <script src="{{ asset('js/edit_markdown.js') }}"></script>
        @if ($errors->has('body'))
        <div class="invalid-feedback">
          {{ $errors->first('body') }}
        </div>
        @endif
      </div>
    @else
      <div class="input-group has-validation">
        <textarea id="form-answer-body" class="no-resize-ta form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
        name="body" rows="30" placeholder="Enter your answer...">{{ old('body') ?? $post->body }}</textarea>
        <a id="edit-markdown" class="position-absolute fs-4" role="button" href="javascript:void(0)" onclick="openEditorAnswer()">
          <i class="bi bi-markdown"></i>
        </a>
        <script src="{{ asset('js/edit_markdown.js') }}"></script>
        @if ($errors->has('body'))
        <div class="invalid-feedback d-inline">
          {{ $errors->first('body') }}
        </div>
        @endif
      </div>
    @endif
  </div>

  <div class="text-center">
    <div class="d-inline-flex">
      @if ($post->type == "question")
      <button type="submit" class="btn btn-success mx-2">Submit Question Edit</button>
      @else
      <button type="submit" class="btn btn-success mx-2">Submit Answer Edit</button>
      @endif
    </div>
  </div>
</form>

<script src="{{ asset('js/form-validation.js') }}"></script>
@stop
