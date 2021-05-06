<?php
$user = $edit_proposal->user;
$post = $edit_proposal->post;
$question_url = "question/" . $post->parentQuestion->id;
?>
<div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
  <div class="row align-items-center p-3">
      <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
          <img src="{{ asset('images/user.jpg') }}" class="rounded img-fluid align-middle" width="120"
              alt="user-pic">
          <h5 class="fs-5">Lucas Martins</h5>
          <h6 class="fs-7">Lucas123</h6>
      </div>

      <div class="col text-start align-middle">
          <h6 class="fs-5"><i>Proposed an edit to a(n) <a class="fw-bold" href="{{ $question_url }}">
            {{ $post->type }}</a> of <b>{{ $post->owner->username }}</b></i></h6>
          <p class="ms-3 fs-7">{{ $post->body }}</p>
          <h6 class="fs-5"><i><b>To be changed to</b></i></h6>
          <p class="ms-3 fs-7">{{ $edit_proposal->body }}</p>

          <div class="row align-items-center">
            <b class="col fs-5">Revoke moderator?</b>
            <span class="col-5 col-sm-4 text-end">
                <button type="button" class="btn btn-sm btn-success mb-1"
                    data-bs-toggle="button" autocomplete="off">
                    <i class="bi bi-check2"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="button"
                    autocomplete="off">
                    <i class="bi bi-x"></i>
                </button>
            </span>
          </div>
      </div>
  </div>
</div>
