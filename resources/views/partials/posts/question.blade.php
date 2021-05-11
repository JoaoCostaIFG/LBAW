<div class="row p-1">
    <h2 class="page-title">{{ $question->title }}</h2>
    <hr>
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
        @include('partials.posts.user_card', ['post' => $question->post])
    </div>
    <div class="col col-md-10 col-9">
        <p class="text-break">{{ $question->post->body }}</p>
    </div>
    <div class="row m-0 p-0 ">
        <p class="text-muted text-end">Posted {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</p>
    </div>

    <!-- Comments -->
    @include('partials.posts.comment_block', ['post' => $question, 'question_id' => $question->id]) {{-- Maybe needs to receive post and not answer/question --}}
</div>
