@extends('layouts.layout')

@section('title', 'Leaderboard')
@section('pageType', 'website')

@section('content')

  <div class="page-title d-flex flex-row align-items-center justify-content-between">
    <h2>Leaderboard</h2>
    <button type="button" class="btn btn-secondary" title="Help: Leaderboard" data-bs-container="body"
      data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Here are the top users and posts of our website. Posts score is determined by the number of upvotes and downvotes it has.
          A user's score is determined by the scores of their posts.">
      Help <i class="bi bi-question-circle"></i>
    </button>
  </div>
  <hr />
  <div class="row">
    <!-- Users Leaderboard -->
    <div class="col-lg-6 col-12">
      <h3 class="border text-center rounded fs-5 p-2 bg-secondary">Top Users</h3>
      <div class="row gap-2">
        @foreach ($users as $user)
          <div class="col-12">
            @include('partials.search_results.user_card')
          </div>
        @endforeach
      </div>
    </div>

    <div class="d-block d-lg-none m-4">
    </div>

    <!-- Questions Leaderboard -->
    <div class="col-lg-6 col-12">
      <h3 class="border text-center rounded fs-5 p-2 bg-secondary">Top Questions</h3>
      @foreach ($questions as $question)
        @include('partials.question_card')
      @endforeach
    </div>
  </div>
@stop
