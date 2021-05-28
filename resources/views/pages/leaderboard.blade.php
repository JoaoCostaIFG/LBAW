@extends('layouts.layout')

@section('title', 'Leaderboard')
@section('pageType', 'website')

@section('content')
<div class="d-flex flex-row align-items-center justify-content-between mt-2">
  <h2 class="page-title mb-0">Leaderboard</h2>
  <button type="button" class="btn btn-secondary" title="Help: Leaderboard" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" 
  data-bs-content="Here are the top users and posts of our website. Posts score is determined by the number of upvotes and downvotes it has.
  A user's score is determined by the scores of their posts.">
    <i class="bi bi-question-circle"></i> Help
  </button>
</div>
<hr />
<div class="container row justify-content-evenly mt-4">
  <!-- Users Leaderboard -->
  <div class="col-auto">
    <table class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th scope="col" colspan="3" class="text-center fs-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Users of the website with the highest scores."><b>Top Users</b></th>
        </tr>
        <tr class="text-center">
          <th scope="col" class="text-center fs-6">Pos</th>
          <th scope="col" class="text-center fs-6">Username</th>
          <th scope="col" class="text-center fs-6">Score</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        @include('partials.leaderboard.leaderboard_user_entry', ['place' =>
        $loop->index + 1]) @endforeach
      </tbody>
    </table>
  </div>

  <!-- Questions Leaderboard -->
  <div class="col-auto">
    <table class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th scope="col" colspan="3" class="text-center fs-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Questions of the website with the highest scores."><b>Top Questions</b></th>
        </tr>
        <tr class="text-center">
          <th scope="col" class="text-center fs-6">Pos</th>
          <th scope="col" class="text-center fs-6">Question</th>
          <th scope="col" class="text-center fs-6">Score</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
        @include('partials.leaderboard.leaderboard_question_entry', ['place' =>
        $loop->index + 1]) @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
