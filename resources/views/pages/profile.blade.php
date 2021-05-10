@extends('layouts.layout')

@section('title', 'Profile')
@section('pageType', 'website')

@section('content')
  <div class="container">
    <!-- BEGIN TABS -->
    <nav class="mt-2">
      <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item text-center" style="width: 33.33%">
          <a href="#profile" class="nav-link active fw-bold" data-toggle="tab">
            About
          </a>
        </li>
        <li class="nav-item text-center" style="width: 33.33%">
          <a href="#activity" class="nav-link fw-bold" data-toggle="tab">
            Activity
          </a>
        </li>
        <li class="nav-item text-center" style="width: 33.33%">
          <a href="#achievements" class="nav-link fw-bold" data-toggle="tab">
            Achievements
          </a>
        </li>
      </ul>
    </nav>
    <!-- END TABS -->

    <!-- Profile -->
    <div class="container p-2 text-center">
      <img src="{{ asset('/images/user.jpg') }}" id="profile-picture" class="img-thumbnail rounded" alt="User profile picture">
      <span class="d-block text-center fs-5"><b>{{ $user->name }}</b></span>
      <span class="d-block text-center">{{ $user->username }}</span>
    </div>
    <div class="row user-engagement-count mb-1">
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
        <p class="m-0 p-0">Reputation</p>
      </div>
    </div>

    <!-- BEGIN TAB CONTENTS -->
    <div class="tab-content">
      @include('partials.profile.about_tab')

      <!-- BEGIN ACTIVITY TAB -->
      <div id="activity" class="tab-pane fade container">

        <div class="row">
          <!-- Top Topics -->
          <div class="col-lg p-1">
            <div class="container themed-container p-0 text-left">
              <h5 class="m-0 fw-bold">Top Topics</h5>
            </div>
            @if (count($user->getTopicParticipation()->get()) == 0)
              <div class="text-center mb-3">
                <span class="text-center">-- This user has no activity --</span>
              </div>
            @else      
              @foreach ($user->getTopicParticipation()->get() as $topic)
                @include('partials.profile.top_topic_card', ['topic_questions' =>
                $user->getQuestionParticipation()->get()->keyBy('topic_name'),
                'topic_answers' => $user->getAnswerParticipation()->get()->keyBy('topic_name')])
              @endforeach
            @endif
          </div>
          <!-- Top Questions -->
          <div class = "col-lg p-1">
            <div class="container themed-container p-0 text-left">
              <h5 class="m-0 fw-bold">Top Questions</h5>
            </div>
            @if (count($user->questions) == 0)
            <div class="text-center">
              <span class="text-center">-- This user has no questions --</span>
            </div>
            @else 
              <div class="container p-0">
                @each('partials.question_card', $user->questions, 'question')
              </div>           
            @endif
          </div>
        </div>
      </div>
      <!-- END ACTIVITY TAB -->

      <!-- BEGIN ACHIEVEMENTS TAB -->
      <div id="achievements" class="tab-pane fade">
        <div class="container themed-container text-left p-0">
          <h5 class="m-0 fw-bold">Achievements</h5>
        </div>
        <!-- Progress bar -->
        @php
          $percentage = (count($user->achievements) / count($achievements)) * 100;
          $percentage = round($percentage, 2);
        @endphp
        <div class="p-2 m-auto" >
          <div class="container d-flex justify-content-between p-0">
            <span><i class="bi bi-award-fill"></i> Progress</span>
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
