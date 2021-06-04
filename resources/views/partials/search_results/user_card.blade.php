<!-- User Card -->
<div class="col-md d-flex flex-row justify-content-between align-items-center border rounded">
  <div class="p-3 d-flex flex-row gap-3 align-items-center">
    <!-- Add user image-->
    <img class="rounded-2 fit-cover" src="{{ asset('storage/' . $user->getPfp()) }}"
     alt="{{ $user->username }} profile picture" width="40" height="40">
    <div class="d-flex flex-column justify-content-center align-items-start">
      <!-- Name -->
      <span class="fs-5">{{ $user->name }}</span>
      <!-- Userame -->
      <a href="/profile/{{ $user->username }}">{{ $user->username }}</a>
    </div>
  </div>
  <!-- User Reputation -->
  <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
    <span class="fs-5 text-break" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $user->reputation }} reputation points.">{{ $user->reputation }}</span>
    <i class="bi bi-award"></i>
  </div>
</div>
