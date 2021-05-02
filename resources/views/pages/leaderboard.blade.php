@extends('layouts.layout')

@section('title', 'Leaderboard')

@section('content')

<div class="container">
  <h2 class="page-title">Leaderboard</h2>
  <hr>
  <div class="container row justify-content-center mt-4">
    <!-- Users Leaderboard -->
    <div class="col-auto">
      <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" colspan="3" class="text-center"><h3><b>Top Users</b></h3></th>
          </tr>
          <tr class="text-center">
            <th scope="col" style="width:5%" class="text-center"><h5>Pos</h5></th>
            <th scope="col" class="text-center"><h5>Username</h5></th>
            <th scope="col" class="text-center"><h5>Score</h5></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                @include('partials.leaderboard.leaderboard_user_entry', ['place' => $loop->index + 1])
            @endforeach

        </tbody>
      </table>
    </div>

    <!-- Questions Leaderboard -->
    <div class="col-auto align-self-center">
      <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" colspan="3" class="text-center"><h3><b>Top Questions</b></h3></th>
          </tr>
          <tr class="text-center">
            <th scope="col" style="width:5%" class="text-center"><h5>Pos</h5></th>
            <th scope="col" class="text-center"><h5>Question</h5></th>
            <th scope="col" class="text-center"><h5>Score</h5></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($questions as $question)
                @include('partials.leaderboard.leaderboard_question_entry', ['place' => $loop->index + 1])
            @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
