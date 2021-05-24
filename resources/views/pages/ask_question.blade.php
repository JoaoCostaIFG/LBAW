@extends('layouts.layout')

@section('title', 'Ask Question')
@section('pageType', 'website')

@section('content')
<div class="d-flex flex-row align-items-center justify-content-between mt-2">
  <h2 class="page-title mt-0">Add Question</h2>
  <button type="button" class="btn btn-secondary" title="Help: Add Question" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" 
  data-bs-content="Use this page to make a question. Remember: Questions are permanent. Be explicit.
  You can add a bounty and tag it with topics.">
    <i class="bi bi-question-circle"></i> Help
  </button>
</div>
<hr class="mt-3">
<form method="POST" action="{{ route('ask') }}">
  @csrf
  <div class="input-group">
    <label for="title" class="form-label"><b>Question Title</b><span class="text-danger"> *</span></label>
    <div class="input-group has-validation">
      <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
        value="{{ old('title') }}" id="title" placeholder="Enter question title... (e.g.: How to sort an array in c?)" required>
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
      <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" id="body" name="body" placeholder="Enter question details...">{{ old('body') }}</textarea>
      @if ($errors->has('body'))
      <div class="invalid-feedback">
        {{ $errors->first('body') }}
      </div>
      @endif
    </div>
  </div>

  <div class="row input-group justify-content-center my-3 gx-0">
    <div id="bounty-slider" class="col-12 col-md-4 col-lg-3 card p-1">
      <div class="card-body col-auto">
        <span class="card-title"><b>Bounty</b></span>
        <hr class="my-1">
        <div class="text-center mt-1">
          <label for="bounty" class="form-labelr" id="bountyValue">{{ old('bounty', 0) }}</label>
          <input type="range" name="bounty" class="form-range {{ $errors->has('bounty') ? 'is-invalid' : ''}}" value="{{ old('bounty', 0) }}" min="0" max="500" step="1" id="bounty" onmousemove="document.getElementById('bountyValue').innerText = document.getElementById('bounty').value">
          @if ($errors->has('bounty'))
          <div class="invalid-feedback">
            {{ $errors->first('bounty') }}
          </div>
          @endif
        </div>
      </div>
    </div>
    <div id="topic-input" class="col-12 col-md-8 col-lg-6 card p-1">
      <div class="card-body">
        <span class="card-title"><b>Topics</b></span>
        <hr class="my-1">
        <div class="mt-3 has-validation">
          <select class="no-resize-ta topic-list form-control {{ $errors->has('topics') ? 'is-invalid' : ''}}"
             name="topics[]" value="" rows=2 id="topics" placeholder="Enter topic tags" multiple required>
            @foreach ($topics as $topic)
              @php
                $selected = is_array(old('topics')) && in_array($topic, old('topics'));
              @endphp
              <option id="{{ $topic }}" {{ $selected ? 'selected="selected"' : ''}} value="{{$topic}}">
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
        </div>
        <button type="button" class="btn btn-sm btn-outline-info mt-2" data-bs-toggle="modal" data-bs-target="#suggestTopicModal">
          Not seeing the tag you want? Suggest it.
        </button>
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

        </form>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Submit suggestion">
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/form-validation.js') }}"></script>
@stop
