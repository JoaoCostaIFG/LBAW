<div class="row p-1">
    <h2 class="page-title">{{ $question->post->title }}</h2>
    <hr>
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
        <div class="row fs-3">
            <i class="bi bi-caret-up d-block text-center"></i>
            <span class="d-block text-center">{{ $question->post->score }}</span>
            <i class="bi bi-caret-down d-block text-center"></i>
        </div>
        <div class="row p-sm-3 p-0">
            <img src="../static/images/a.jpg" class="center p-2 p-sm-3" alt="">
            <a class="d-block text-center">{{ $question->post->owner->username }}</a> <!--  style="overflow:hidden; -->
            <span class="d-block text-center">{{ $question->post->owner->reputation }} Points</span>
        </div>
    </div>
    <div class="col col-md-10 col-9">
        <p class="text-break">{{ $question->post->body }}</p>
    </div>
    <div class="row m-0 p-0 ">
        <p class="text-muted text-end">Posted 3 days ago</p>
    </div>

    <!-- Comments -->
    @include('partials.posts.comment_block', ['post' => $question]) {{-- Maybe needs to receive post and not answer/question --}}
</div>
