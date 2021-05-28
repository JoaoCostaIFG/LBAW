@extends('layouts.layout')

@section('title', 'Edit Question')
@section('pageType', 'website')

@section('content')
<script src="{{ asset('js/edit_markdown.js') }}" defer></script>

<h2 class="page-title">Edit Question</h2>
<hr class="mt-3">
<form method="POST" action="{{ route('question.edit', ["id" => $question->id]) }}">
  @csrf
  @method("PATCH")
  <div class="input-group">
    <label for="title" class="form-label"><b>Question Title</b><span class="text-danger"> *</span></label>
    <div class="input-group has-validation">
      <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
       value="{{ old('title') ?? $question->title}}" id="title"
       placeholder="Enter question title... (e.g.: How to sort an array in c?)" required>
      @if ($errors->has('title'))
      <div class="invalid-feedback">
          {{ $errors->first('title') }}
      </div>
      @endif
    </div>
  </div>

  <div class="input-group mt-2">
    <label for="question-body" class="form-label"><b>Question details</b><span class="text-danger"> *</span></label>
    <div class="input-group has-validation">
      <textarea id="question-body" class="no-resize-ta form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
       name="body" rows="16" placeholder="Enter question details...">
        {{ old('body') ?? $question->post->body }}
      </textarea>
      <a id="edit-markdown" class="position-absolute fs-4" role="button" href="javascript:void(0)" onclick="openEditor()">
        <i class="bi bi-markdown"></i>
      </a>
      @if ($errors->has('body'))
      <div class="invalid-feedback">
        {{ $errors->first('body') }}
      </div>
      @endif
    </div>
  </div>

  <div class="row input-group justify-content-center my-3 gx-0">
    <div id="topic-input" class="col-12 col-md-8 col-lg-6 card p-1 mt-3 mb-3">
      <div class="card-body">
        <span class="card-title"><b>Topics</b></span>
        <hr class="my-1">
        <div class="mt-3 has-validation">
          <select id="topics" class="no-resize-ta topic-list form-control {{ $errors->has('topics') ? 'is-invalid' : ''}}"
             name="topics[]" multiple required>
            @foreach ($topics as $topic)
              @php
                $selected = in_array($topic, $selected_topics);
              @endphp
              <option id="{{ $topic }}" {!! $selected ? 'selected="selected"' : ''!!} value="{{$topic}}">
                {{$topic}}
              </option>
            @endforeach
          </select>
          <script>
            // Load select2 values
            $(document).ready(function() {
              $('.topic-list').select2();
              $('.topic-list').select2("val", null); //a lil' bit more :)
            });
          </script>
          @if ($errors->has('topics'))
          <div class="invalid-feedback">
            {{ $errors->first('topics') }}
          </div>
          @endif

          <button type="button" class="btn btn-sm btn-outline-info mt-2" data-bs-toggle="modal" data-bs-target="#suggestTopicModal">
            Not seeing the tag you want? Suggest it.
          </button>
          @if ($errors->has('topic_name'))
            <div class="d-block invalid-feedback">
              {{ $errors->first('topic_name') }}
            </div>
          @endif
          @if ($errors->has('reason'))
            <div class="d-block invalid-feedback">
              {{ $errors->first('reason') }}
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>

  <div class="text-center">
    <div class="d-inline-flex">
      <button type="submit" class="btn btn-success mx-2">Submit Question</button>
    </div>
  </div>
</form>

<!-- Suggest topic modal -->
<form method="POST" action="{{ route('suggest_topic') }}">
  @csrf

  <div id="suggestTopicModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Suggest a topic</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="topicNameId" class="form-label"><b>Topic Name</b><span class="text-danger"> *</span></label>
          <div class="input-group has-validation">
            <input id="topicNameId" type="text" name="topic_name" class="form-control"
             placeholder="Enter the topic title... (e.g.: python)" required>
          </div>

          <label for="topicReasonId" class="form-label mt-2"><b>Topic reason</b><span class="text-danger"> *</span></label>
          <div class="input-group has-validation">
            <textarea class="form-control" id="topicReasonId" name="reason"
             placeholder="Why do you think this topic should exist..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Submit suggestion">
        </div>
      </div>
    </div>
  </div>
</form>

<script src="{{ asset('js/form-validation.js') }}"></script>
@stop
