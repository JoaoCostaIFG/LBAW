@extends('layouts.layout')

@section('title', 'Edit Answer')
@section('pageType', 'website')

@section('content')

<h2 class="page-title">Edit Answer</h2>
<hr class="mt-3">
<form method="POST" action="{{ route('answer.edit', ["id" => $answer->id]) }}">
  @csrf
  @method("PATCH")

  <div class="input-group mt-2">
    <label for="form-answer-body" class="form-label"><b>Answer</b><span class="text-danger"> *</span></label>
    <div class="input-group has-validation">
      <textarea id="form-answer-body" class="no-resize-ta form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
       name="body" rows="30" placeholder="Enter your answer...">{{ old('body') ?? $answer->post->body }}</textarea>
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
  </div>

  <div class="text-end mt-2">
    <div class="d-inline-flex">
      <button type="submit" class="btn btn-success mx-2">Submit Answer</button>
    </div>
  </div>
</form>

<script src="{{ asset('js/form-validation.js') }}"></script>
@stop
