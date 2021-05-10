@extends('layouts.layout')

@section('title', 'Ask Question')
@section('pageType', 'website')

@section('content')

<main class="container p-3">
<h2><b>Add Question</b></h2>
<hr class="mt-3">
<form class="auth-form" method="POST" action="{{ route('ask') }}">
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
      <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" id="body" name="body" placeholder="Enter question details..." rows=10>{{ old('body') }}</textarea>
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
          <input type="range" name="bounty" class="form-range" value="{{ old('bounty', 0) }}" min="0" max="100" step="1" id="bounty" onmousemove="document.getElementById('bountyValue').innerText = document.getElementById('bounty').value">
        </div>
      </div>
    </div>
    <div id="topic-input" class="col-12 col-md-8 col-lg-6 card p-1">
      <div class="card-body">
        <span class="card-title"><b>Topics</b></span>
        <hr class="my-1">
        <div class="has-validation mt-3">
          <select class="js-example-basic-single form-control {{ $errors->has('topics') ? 'is-invalid' : ''}}"
             name="topics[]" value="{{ old('topics') }}" rows=2 id="topics" placeholder="Enter topic tags" multiple required>
             @foreach ($topics as $topic)
              <option value="{{$topic}}">{{$topic}}</option>
             @endforeach
          </select>
          <script>
            // Load select2 values
            $(document).ready(function() {
              $('.js-example-basic-single').select2();
            });
          </script>
          @if ($errors->has('topics'))
          <div class="invalid-feedback">
            {{ $errors->first('topics') }}
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
<script src="form-validation.js"></script>
</main>
@stop
