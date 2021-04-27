<!-- User Card -->
<div class=" border col-md d-flex flex-row justify-content-between">
  <div class=" p-3 d-flex flex-row gap-2">
    <!-- TODO: Add user image-->
    <img class="rounded-2 fit-cover" src="{{ asset('images/user.png') }}" alt="User Picture" width="70px" height="70px">
    <div class="d-flex flex-column justify-content-center align-items-start">
      <!-- Name -->
      <span class="fs-5">
          {{ $user->name }}
      </span>
      <!-- Userame -->
      <a href="/profile/{{ $user->id }}">
          {{ $user->username }}
      </a>
    </div>
  </div>
  <!-- User Reputation -->
  <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
    <span class="fs-5">
        {{ $user->reputation }}
    </span>
    <span class="d-none d-sm-block">Points</span>
    <span class="d-sm-none"><i class="bi bi-award"></i></span>
  </div>
</div>
