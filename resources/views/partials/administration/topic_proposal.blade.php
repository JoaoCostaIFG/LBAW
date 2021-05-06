<div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
    <div class="row align-items-center p-3">
        <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
            <img src="{{ asset('images/user.jpg') }}" class="rounded img-fluid align-middle" width="120" alt="User profile picture">
            <h5 class="fs-5">{{ $user->name }}</h5>
            <h6 class="fs-7">{{ $user->username }}</h6>
        </div>

        <div class="col text-start align-middle">
            <h6 class="fs-5"><i>Proposed topic <b>{{ $topic_proposal->name }}</b></i></h6>
            <h6 class="fs-5"><i><b>For the reason</b></i></h6>
            <p class="ms-3 fs-7">{{ $topic_proposal->reason }}</p>

            <div class="row align-items-center">
                <b class="col fs-5">Accept new topic?</b>
                <span class="col-5 col-sm-4 text-end">
                    <button type="button" class="btn btn-sm btn-success mb-1" data-bs-toggle="button"
                        autocomplete="off">
                        <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="button" autocomplete="off">
                        <i class="bi bi-x"></i>
                    </button>
                </span>
            </div> <!-- .row -->
        </div> <!-- .col -->
    </div>
</div>
