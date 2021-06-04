<?php 
$user = $report->post->owner;
$question_url = 'question/' . $report->post->parentQuestion->id;
$type = $report->post->type;
?>
<div class="container-fluid border rounded m-3 m-sm-1 p-1 row gx-0 align-items-center justify-content-center" style="max-width: 35em;" id="user-report-p{{$report->post->id}}r{{$report->reporter}}">
  <div class="row align-items-center p-3">
    <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
      <img src="{{ asset('storage/'.$user->picture) }}" class="rounded img-fluid align-middle"
       width="128" alt="{{ $user->username }} profile picture">
      <h6 class="fs-5">{{ $user->name }}</h6>
      <a class="text-break" href="/profile/{{$user->username}}">{{ $user->username }}</a>
    </div>

    <div class="col text-start align-middle">
      <h6 class="text-start fs-5"><i><b>Reason</b></i></h6>
      <p class="text-start ms-3 fs-7">
        @if (strlen($report->reason) <= 0)
          <i>No reason given</i>
        @else
          {{ mb_strimwidth($report->reason, 0, 128, "...") }}
        @endif
      </p>
      <h6 class="text-start fs-5">
        <i><b>In this 
          <a href="{{ $question_url }}">{{ $type }}</a>
        </b></i>
      </h6>

      <div class="row align-items-center">
        <b class="col fs-5">Ban User?</b>
        <span class="col-5 col-sm-4 text-end">
          <button type="button" class="btn btn-sm btn-success mb-1"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user."
           aria-label="Ban user (accept report)" onclick="processUserReport({{$report->post->id}}, {{$report->reporter}}, 1)">
            <i class="bi bi-check2"></i>
          </button>
          <button type="button" class="btn btn-sm btn-danger mb-1"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject report."
           aria-label="Forgive user (reject report)" onclick="processUserReport({{$report->post->id}}, {{$report->reporter}}, 0)">
            <i class="bi bi-x"></i>
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
