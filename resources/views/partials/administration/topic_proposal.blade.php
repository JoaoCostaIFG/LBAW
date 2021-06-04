<div class="container-fluid border rounded m-3 m-sm-1 p-1 row gx-0 align-items-center justify-content-center" id="topic-proposal-{{$topic_proposal->id}}" style="max-width: 35em;">
  <div class="row align-items-center p-3">
    <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
      <img src="{{ asset('storage/'.$user->picture) }}" class="rounded img-fluid align-middle"
       width="128" alt="{{ $user->username }} profile picture">
      <h6 class="fs-5">{{ $user->name }}</h6>
      <a class="text-break" href="/profile/{{$user->username}}">{{ $user->username }}</a>
    </div>

    <div class="col text-start align-middle">
      <h6 class="fs-5"><i>Proposed topic <b>{{ $topic_proposal->topic_name }}</b></i></h6>
      <h6 class="fs-5"><i><b>For the reason</b></i></h6>
      <p class="ms-3 fs-7">{{ $topic_proposal->reason }}</p>

      <div class="row align-items-center">
        <b class="col fs-5">Accept new topic?</b>
        <span class="col-6 col-sm-5 text-end">
          <button type="button" class="btn btn-sm btn-success mb-1"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Accept proposal."
           onclick="processTopicProposal({{$topic_proposal->id}}, 1)"
           aria-label="Accept topic proposal">
            <i class="bi bi-check2"></i>
          </button>
          <button type="button" class="btn btn-sm btn-danger mb-1"
           data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject proposal."
           onclick="processTopicProposal({{$topic_proposal->id}}, 0)"
           aria-label="Request topic proposal">
            <i class="bi bi-x"></i>
          </button>
        </span>
      </div> <!-- .row -->
    </div> <!-- .col -->
  </div>
</div>
