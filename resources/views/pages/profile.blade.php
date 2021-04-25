@extends('layouts.layout')

@section('title', 'Profile')

@section('content')
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
          <span class="badge bg-light text-dark rounded-pill">2</span>
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
      <h4 class="m-0 p-0">35</h4>
      <p class="m-0 p-0">Answers</p>
    </div>
    <div class="col-4 themed-grid-col text-center">
      <h4 class="m-0 p-0">190</h4>
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
    @include('partials.profile.activity_tab') <!-- activity tab -->
    @include('partials.profile.achievements_tab') <!-- achievements tab -->
  </div>
  <!-- END TAB CONTENTS -->

  <script src="/js/tabs.js"></script>
  @stop
