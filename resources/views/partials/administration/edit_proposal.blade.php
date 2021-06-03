<?php
$user = $edit_proposal->user;
$post = $edit_proposal->post;
$question_url = "question/" . $post->parentQuestion->id;
?>
<div class="container-fluid border rounded m-3 m-sm-1 p-1 row gx-0 align-items-center justify-content-center" id="edit-proposal-{{$edit_proposal->id}}" style="max-width: 35em;">
  <div class="row align-items-center p-3">
      <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
          <img src="{{ asset('storage/'.$user->picture) }}" class="rounded img-fluid align-middle"
           width="120" alt="{{ $user->username }} profile picture">
          <h5 class="fs-5">{{$user->name}}</h5>
          <a class="text-break" href="/profile/{{$user->username}}">{{ $user->username }}</a>
      </div>

      <div class="col text-start align-middle">
          <h6 class="fs-5"><i>Proposed an edit to a(n) <a class="fw-bold" href="{{ $question_url }}">
            {{ $post->type }}</a> of <b>{{ $post->owner->username }}</b></i></h6>
          <p class="ms-3 fs-7">{{ mb_strimwidth($post->body, 0, 128, "...") }}</p>
          <h6 class="fs-5"><i><b>To be changed to</b></i></h6>
          <p class="ms-3 fs-7">{{ $edit_proposal->body }}</p>

          <div class="row align-items-center">
            <b class="col fs-5">Accept Proposal?</b>
            <span class="col-5 col-sm-4 text-end">
                <button type="button" class="accept-edit btn btn-sm btn-success mb-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Accept proposal."
                    data-bs-toggle="button" autocomplete="off" onclick="processEditProposal({{$edit_proposal->id}}, 1)">
                    <i class="bi bi-check2"></i>
                </button>
                <button type="button" class="reject-edit btn btn-sm btn-danger mb-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject proposal."
                data-bs-toggle="button" autocomplete="off" onclick="processEditProposal({{$edit_proposal->id}}, 0)">
                    <i class="bi bi-x"></i>
                </button>
            </span>
          </div>
      </div>
  </div>
</div>
