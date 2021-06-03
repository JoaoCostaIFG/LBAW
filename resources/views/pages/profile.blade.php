@extends('layouts.layout')

@section('title', 'Profile')
@section('pageType', 'website')

@section('content')
<!-- Status Message -->
@if (session('status'))
<div class="alert alert-success mt-2">
  {{ session('status') }}
</div>
@endif
<!-- BEGIN TABS -->
<div class="d-flex flex-row align-items-center justify-content-between">
  <h2 class="page-title mb-0">
    @if (Auth::check() && Auth::user()->username == request()->username)
      Your Profile
    @else
      {{ $user->username }}'s profile
    @endif
  </h2>
    @auth
    <div>
      <button type="button" class="btn btn-secondary mt-3 me-1" title="Help: Profile" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
  data-bs-content="This is a user's profile page. Here, you can take a look at a user's activity, information and achievements.
  In your own profile, you can change your account information.">
    <i class="bi bi-question-circle"></i> Help
  </button>
      @if (Auth::id() == $user->id)
        <a class="btn btn-primary mt-3" href="/user/edit" role="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit your account information.">
          Edit <i class="bi bi-pencil-square"></i>
        </a>
      @elseif (Auth::user()->hasRole('administrator') && !$user->isdeleted)
      @include('partials.profile.ban', ['user' => $user])
      <button type="button" class="ban-btn btn btn-danger btn-secondary mt-3" data-bs-toggle="modal"
        data-bs-target="#banModal" aria-label="report user" data-bs-toggle="tooltip" data-bs-placement="right" title="Ban this user.">
        Ban <i class="bi bi-trash"></i>
      </button>
      @endif
    </div>
    @endauth
</div>
  @if ($user->hasRole('administrator'))
  <span class="badge bg-success text-decoration-none"
          data-bs-toggle="tooltip" data-bs-placement="left" title="This user has administrator role."><i class="bi bi-wrench"></i> Administrator</span>    
  @else
  @if ($user->hasRole('moderator'))
  <span class="badge bg-danger text-decoration-none"
          data-bs-toggle="tooltip" data-bs-placement="left" title="This user has moderator role."><i class="bi bi-wrench"></i> Moderator</span>
  @endif
  @endif

<hr>
<nav class="mt-2">
  <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item profile-tab">
      <a href="#profile" class="nav-link active fw-bold" data-toggle="tab" role="button">
        About
      </a>
    </li>
    <li class="nav-item profile-tab">
      <a href="#activity" class="nav-link fw-bold" data-toggle="tab" role="button">
        Activity
      </a>
    </li>
    <li class="nav-item profile-tab">
      <a href="#achievements" class="nav-link fw-bold" data-toggle="tab" role="button">
        Achievements
      </a>
    </li>
  </ul>
</nav>
<!-- END TABS -->

<!-- Profile -->
<div class="container p-2 text-center">
  <img
    src="{{ asset('storage/' . $user->getPfp()) }}"
    id="profile-picture"
    class="img-thumbnail rounded"
    alt="{{ $user->username }} profile picture"
  />
  <p class="text-center fs-5 m-0 text-wrap text-break"><b>{{ $user->name }}</b></p>
  <p class="text-center m-0 text-wrap text-truncate">{{ $user->username }}</p>
</div>
<div class="row user-engagement-count mb-1">
  <div class="col-4 themed-grid-col text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="This user posted {{ count($user->answers) }} answer(s).">
    <h4 class="m-0 p-0">{{ count($user->answers) }}</h4>
    <p class="m-0 p-0">Answers</p>
  </div>
  <div class="col-4 themed-grid-col text-center"  data-bs-toggle="tooltip" data-bs-placement="top" title="This user posted {{ count($user->questions) }} question(s).">
    <h4 class="m-0 p-0">{{ count($user->questions) }}</h4>
    <p class="m-0 p-0">Questions</p>
  </div>
  <div class="col-4 themed-grid-col text-center"  data-bs-toggle="tooltip" data-bs-placement="top" title="This user has {{ $user->reputation }} reputation points.">
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
        <div class="container themed-container">
          <h3 class="m-0 fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Top topics the user participated in.">Top Topics</h3>
        </div>
@if (count($user->getTopicParticipation()->get()) == 0)
        <div class="text-center mb-3">
          <span>-- This user has no activity --</span>
        </div>
@else
  @foreach ($user->getTopicParticipation()->get() as $topic)
    @include('partials.profile.top_topic_card', ['topic_questions' => $user->getQuestionParticipation()->get()->keyBy('topic_name'),
          'topic_answers' => $user->getAnswerParticipation()->get()->keyBy('topic_name')])
  @endforeach
@endif
      </div>
      <!-- Top Questions -->
      <div class="col-lg p-1">
        <div class="container themed-container">
          <h3 class="m-0 fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Questions with the most score points posted by this user.">Top Questions</h3>
        </div>
@if (count($user->questions) == 0)
        <div class="text-center">
          <span>-- This user has no questions --</span>
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
    <div class="container themed-container">
      <h3 class="m-0 fw-bold">Achievements</h3>
    </div>
    <!-- Progress bar -->
    @php $percentage = (count($user->achievements) / count($achievements)) *
    100; $percentage = round($percentage, 2); @endphp
    <div class="p-2 m-auto">
      <div class="container d-flex justify-content-between p-0">
        <span><i class="bi bi-award-fill"></i> Progress</span>
        <span
          >{{ count($user->achievements) }}/{{ count($achievements) }}
          Achieved</span
        >
      </div>
      <span
        class="p-0 progress m-auto"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="{{ $percentage }}% completed achievements"
      >
        <span
          class="progress-bar p-0 m-0"
          role="progressbar"
          style="width: {{ $percentage }}%;"
          aria-valuenow="25"
          aria-valuemin="0"
          aria-valuemax="100"
        >
          {{ $percentage }}%
        </span>
      </span>
    </div>
    <div class="container d-flex flex-wrap justify-content-center mt-3">
      @foreach ($achievements as $achievement)
      @include('partials.profile.achievement_card', ['achieved' =>
      $user->achievements->contains($achievement)]) @endforeach
    </div>
  </div>
  <!-- END ACHIEVEMENTS TAB -->
</div>
<!-- END TAB CONTENTS -->

<script src="{{ asset('js/tabs.js') }}" defer></script>

@stop
