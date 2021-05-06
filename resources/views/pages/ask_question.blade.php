@extends('layouts.layout')

@section('title', 'Ask Question')
@section('pageType', 'website')

@section('content')
<main class="container p-3">
<h2><b>Add Question</b></h2>
<hr class="mt-3">
<form action="">
  <div class="container py-1">
    <div class="col-auto input-group">
      <label for="question-title" class="form-label"><b>Question Title</b><span class="text-danger"> *</span></label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="question-title" placeholder="Enter question title... (ex: How to sort an array in c?)" required>
        <div class="invalid-feedback">
          Question title is required.
        </div>
      </div>
    </div>

    <div class="col-auto input-group py-2">
      <label for="question-details" class="form-label"><b>Question details</b><span class="text-danger"> *</span></label>
      <div class="input-group has-validation">
        <textarea class="form-control" id="question-details" placeholder="Enter question details..." rows=10 required></textarea>
        <div class="invalid-feedback">
          Question details is required.
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid row input-group justify-content-center py-2 my-3">
    <div class="col-md-2 card p-1">
      <div class="card-body col-auto">
        <span class="card-title"><b>Bounty</b></span>
        <hr class="my-1">
        <div class="text-center my-1">
          <label for="bountyRange" class="form-labelr" id="bountyRangeValue">0</label>
          <input type="range" class="form-range" value="0" min="0" max="100" step="1" id="bountyRange" onmousemove="document.getElementById('bountyRangeValue').innerText = document.getElementById('bountyRange').value">
        </div>
      </div>
    </div>
    <div class="col-auto card p-1">
      <div class="card-body col-auto">
        <span class="card-title"><b>Topics</b></span>
        <hr class="my-1">
        <div class="mt-3 has-validation">
          <input type="text" class="form-control" rows=2 id="topics" placeholder="Enter topic tags..." data-role="tagsinput" required>
          <div class="invalid-feedback">
              At least one tag is required.
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-auto text-end">
    <button type="submit" class="btn btn-success mx-2">Submit Question</button>
    <button type="button" class="btn btn-danger">Cancel</button>
  </div>
</form>
<script src="form-validation.js"></script>
</main>
@stop
