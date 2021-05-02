@extends('layouts.layout')

@section('title', 'Profile')

@section('content')
  <div class="container">
    <!-- BEGIN TABS -->
    <nav class="mt-2">
      <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
          <a href="#profile" class="nav-link active" data-toggle="tab">
            About
          </a>
        </li>
        <li class="nav-item">
          <a href="#activity" class="nav-link" data-toggle="tab">
            Activity
          </a>
        </li>
        <li class="nav-item">
          <a href="#achievements" class="nav-link" data-toggle="tab">
            Achievements
            <span class="badge bg-light text-dark rounded-pill">{{ count($user->achievements) }}</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- END TABS -->

    <!-- Profile -->
    <div class="container p-2 text-center">
      <img src="{{ asset('/images/user.png') }}" id="profile-picture" class="img-thumbnail rounded"
        alt="Profile picture">
      <span class="d-block text-center fs-5"><b>{{ $user->name }}</b></span>
      <span class="d-block text-center">{{ $user->username }}</span>
    </div>
    <div class="row user-engagement-count">
      <div class="col-4 themed-grid-col text-center">
        <h4 class="m-0 p-0">{{ count($user->answers) }}</h4>
        <p class="m-0 p-0">Answers</p>
      </div>
      <div class="col-4 themed-grid-col text-center">
        <h4 class="m-0 p-0">{{ count($user->questions) }}</h4>
        <p class="m-0 p-0">Questions</p>
      </div>
      <div class="col-4 themed-grid-col text-center">
        <h4 class="m-0 p-0">{{ $user->reputation }}</h4>
        <p class="m-0 p-0">Score</p>
      </div>
    </div>

    <!-- BEGIN TAB CONTENTS -->
    <div class="tab-content">
      @include('partials.profile.about_tab')
      <!-- about tab -->
      @if (Auth::check() && Auth::id() == $user->id)
        @include('partials.profile.delete')
        <!-- about tab -->
      @endif

      <!-- BEGIN ACTIVITY TAB -->
      <div id="activity" class="tab-pane fade">
        <!-- Top Topics -->
        <div class="container-fluid themed-container text-left">
          <h5 class="m-0 p-1">Top Topics</h5>
        </div>
        @foreach ($user->getTopicParticipation()->get() as $topic)
          @include('partials.profile.top_topic_card', ['topic_questions' =>
          $user->getQuestionParticipation()->get()->keyBy('topic_name'),
          'topic_answers' => $user->getAnswerParticipation()->get()->keyBy('topic_name')])
        @endforeach
        <!-- Top Questions -->
        <div class="container-fluid themed-container text-left">
          <h5 class="m-0 p-1">Top Questions</h5>
        </div>
        @each('partials.profile.top_post_card', $user->questions, 'question')
      </div>
      <!-- END ACTIVITY TAB -->

      <!-- BEGIN ACHIEVEMENTS TAB -->
      <div id="achievements" class="tab-pane fade">
        <div class="container-fluid themed-container text-left">
          <h5 class="m-0 p-1">Achievements</h5>
        </div>
        <!-- Progress bar -->
        @php
          $percentage = (count($user->achievements) / count($achievements)) * 100;
          $percentage = round($percentage, 2);
        @endphp
        <div class="p-2 m-auto" >
          <div class="container d-flex justify-content-between p-0">
            <span>Progress</span>
            <span>{{ count($user->achievements) }}/{{ count($achievements) }} Achieved</span>
          </div>
          <span class="p-0 progress m-auto" data-bs-toggle="popover" data-bs-trigger="hover focus"
            data-bs-content="{{ $percentage }}% completed achievements">
            <div class="progress-bar p-0 m-0" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="25"
              aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
          </span>
        </div>
        <div class="container d-flex flex-wrap justify-content-center mt-3">
          @foreach ($achievements as $achievement)
            @include('partials.profile.achievement_card', ['achieved' => $user->achievements->contains($achievement)])
          @endforeach
        </div>
      </div>
      <!-- END ACHIEVEMENTS TAB -->
    </div>
    <!-- END TAB CONTENTS -->
  </div>
  <script src="/js/tabs.js"></script>
@stop
