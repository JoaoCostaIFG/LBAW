<h2 class="page-title">{{ $question->title }}</h2>
<hr>

<div class="row gx-0 p-2">
  <div class="col-3 col-md-2 col-lg-1 align-content-between mb-1">
    @include('partials.posts.user_card', ['post' => $question->post], ['question' => $question])
  </div>
  <div class="col-9 col-md-10 col-lg-11 row align-content-between mb-1 ms-1 border-start border-dark">
    <p class="col-12 text-break">{{ $question->post->body }}</p>
@auth
    <div class="col-12 d-flex justify-content-end align-items-center gap-1">
      <button class="btn btn-sm btn-outline-danger" type="button">Report</button>
      <span class="text-muted">Posted {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</span>
    </div>
@else
    <span class="col-12 text-muted text-end">Posted {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</span>
@endauth
  </div>
  <!-- question comments -->
  @include('partials.posts.comment_block', ['post' => $question, 'question_id' => $question->id])
    {{-- Maybe needs to receive post and not answer/question --}}
</div>
