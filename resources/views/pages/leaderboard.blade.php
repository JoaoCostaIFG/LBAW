@extends('layouts.layout')

@section('title', 'Leaderboard')
@section('pageType', 'website')

@section('content')
<h2 class="page-title">Leaderboard</h2>
<hr />
<div class="container row justify-content-center mt-4">
  <!-- Users Leaderboard -->
  <div class="col-auto">
    <table class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th scope="col" colspan="3" class="text-center fs-5"><b>Top Users</b></th>
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
  <div class="col-auto align-self-center">
    <table class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th scope="col" colspan="3" class="text-center fs-5"><b>Top Questions</b></th>
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
