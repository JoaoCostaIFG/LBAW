@extends('layouts.layout')

@section('title', 'Profile')

@section('content')
<div class="container">
  <!-- BEGIN TABS -->
  <nav class="mt-2">
    <ul class="nav nav-tabs justify-content-center">
      <li class="nav-item">
        <a href="#profile" class="nav-link active" data-toggle="tab">
          Profile
        </a>
      </li>
      <li class="nav-item">
        <a href="#activity" class="nav-link" data-toggle="tab">
          Activity
          <span class="badge bg-light text-dark rounded-pill">27</span> <!-- TODO -->
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
    <img src="{{asset('/images/user.png')}}" id="profile-picture" class="img-thumbnail rounded" alt="Profile picture">
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
    @include('partials.profile.about_tab') <!-- about tab -->
      <button class="btn btn-danger col24" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" aria-controls="deleteModal" aria-expanded="false" aria-label="Open delete account box">
        Delete Account
      </button>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            Confirm answer
          </div>
          <div class="modal-body">
            Are you sure
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-success mx-2" data-bs-toggle="button"
                  autocomplete="off">
                  <i class="bi bi-check2"></i>
              </button>
              <button type="button" class="btn btn-sm btn-danger mx-2" data-bs-toggle="button"
                  autocomplete="off">
                  <i class="bi bi-x"></i>
              </button>
          </div>
        </div>
      </div>
    </div>

      <!-- BEGIN ACTIVITY TAB -->
    <div id="activity" class="tab-pane fade">
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Top Topics</h5>
      </div>
      @include('partials.profile.top_topic_card')
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Top Posts</h5>
      </div>
      @each('partials.profile.top_post_card', $user->questions, 'question')
    </div>
    <!-- END ACTIVITY TAB -->

    <!-- BEGIN ACHIEVEMENTS TAB -->
    <div id="achievements" class="tab-pane fade">
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Achievements</h5>
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
