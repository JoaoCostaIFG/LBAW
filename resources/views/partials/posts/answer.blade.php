<div class="row py-2">
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
        <div class="row fs-3">
            <i class="bi bi-caret-up d-block text-center"></i>
            <span class="d-block text-center">{{ $answer->post->score }}</span>
            <i class="bi bi-caret-down d-block text-center"></i>
        </div>
        <div class="row p-sm-3 p-0">
            <img src="../static/images/a.jpg" class="center p-2 p-sm-3" alt="">
            <a class="d-block text-center">{{ $answer->post->owner->username }}</a>
            <span class="d-block text-center">{{ $answer->post->owner->reputation }} Points</span>
        </div>
    </div>
    <div class="col col-md-10 col-9">
        <p class="text-break">{{ $answer->post->body }}
        </p>
    </div>

    <div class="row">
        <button type="button" class="btn btn-danger col-sm-2 offset-sm-7 col-4 offset-5 my-2">Report</button>
        <p class="text-muted col-3 text-center m-0 align-self-center">Posted 1 day ago</p>
    </div>

    @include('partials.posts.comment_block', ['post' => $answer]) {{-- Maybe needs to receive post and not answer/question --}}

</div>
