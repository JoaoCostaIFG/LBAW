@extends('layouts.layout')

@section('title', 'Leaderboard')
@section('pageType', 'website')

@section('content')

  <div class="d-flex flex-row align-items-center justify-content-between mt-2">
    <h2 class="page-title mb-0">Leaderboard</h2>
    <button type="button" class="btn btn-secondary" title="Help: Leaderboard" data-bs-container="body"
      data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Here are the top users and posts of our website. Posts score is determined by the number of upvotes and downvotes it has.
          A user's score is determined by the scores of their posts.">
      <i class="bi bi-question-circle"></i> Help
    </button>
  </div>
  <hr />
  <div class="container row justify-content-center m-0 p-0">
    <!-- Users Leaderboard -->
    <div class="col-lg-6 col-12">
      <h3 class="border text-center rounded">Top Users</h3>
      @foreach ($users as $user)
        @include('partials.search_results.user_card')
      @endforeach
    </div>

    <!-- Questions Leaderboard -->
    <div class="col-lg-6 col-12">
      <h3 class="border text-center rounded">Top Questions</h3>
      @foreach ($questions as $question)
        @include('partials.question_card')
      @endforeach
    </div>
  </div>
@stop
