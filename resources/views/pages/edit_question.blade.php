@extends('layouts.layout')

@section('title', 'Edit Question')
@section('pageType', 'website')

@section('content')
<h2 class="page-title">Edit Question</h2>
<hr class="mt-3">
<form class="auth-form" method="POST" action="{{ route('question.edit', ["id" => $question->id]) }}">
  @csrf
  @method("PATCH")
  <div class="input-group">
    <label for="title" class="form-label"><b>Question Title</b><span class="text-danger"> *</span></label>
    <div class="input-group has-validation">
      <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
        value="{{ old('title') ?? $question->title}}" id="title" placeholder="Enter question title... (e.g.: How to sort an array in c?)" required>
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
      <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" id="body" name="body" placeholder="Enter question details...">{{ old('body') ?? $question->post->body }}</textarea>
      @if ($errors->has('body'))
      <div class="invalid-feedback">
        {{ $errors->first('body') }}
      </div>
      @endif
    </div>
  </div>

  <div class="row input-group justify-content-center my-3 gx-0">
    @if($question->bounty == 0)
    <div id="bounty-slider" class="col-12 col-md-4 col-lg-3 card p-1">
      <div class="card-body col-auto">
        <span class="card-title"><b>Bounty</b></span>
        <hr class="my-1">
        <div class="text-center mt-1">
          <label for="bounty" class="form-labelr" id="bountyValue">{{ old('bounty') ?? $question->bounty }}</label>
          <input type="range" name="bounty" class="form-range {{ $errors->has('bounty') ? 'is-invalid' : ''}}" value="{{ old('bounty') ?? $question->bounty }}"
           min="{{$question->body}}" max="{{ min(500, Auth::user()->reputation) }}" step="1" id="bounty"
            onmousemove="document.getElementById('bountyValue').innerText = document.getElementById('bounty').value">
          @if ($errors->has('bounty'))
          <div class="invalid-feedback">
            {{ $errors->first('bounty') }}
          </div>
          @endif
        </div>
      </div>
    </div>
    @endif
    {{-- <div id="topic-input" class="col-12 col-md-8 col-lg-6 card p-1">
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
      </div>
    </div> --}}
  </div>


  <div class="text-center">
    <div class="d-inline-flex">
      <button type="submit" class="btn btn-success mx-2">Submit Question</button>
    </div>
  </div>
</form>
<script src="form-validation.js"></script>
@stop
