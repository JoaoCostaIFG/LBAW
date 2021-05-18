<hr>

<div class="row gx-0 p-2 {{ $answer->question->accepted_answer == $answer->id ? 'accepted-answer' : '' }}">
  <div class="col-3 col-md-2 col-lg-1 align-content-between pe-1 mb-1">
    @include('partials.posts.user_card', ['post' => $answer->post,
      'accepted' => ($answer->question->accepted_answer == $answer->id),
      'answer' => $answer])
  </div>
  <div class="col-9 col-md-10 col-lg-11 row align-content-between mb-1 ms-1 border-start border-dark">
    <p class="text-break">{!! nl2br(e($answer->post->body)) !!} </p>
@auth
  <div class="col-12 d-flex justify-content-end align-items-center gap-1">
    <button class="btn btn-sm btn-outline-danger" type="button">Report</button>
    <span class="text-muted">Posted {{ (new \Carbon\Carbon($answer->post->date))->diffForHumans() }}</span>
  </div>
@else
  <span class="col-12 text-muted text-end">Posted {{ (new \Carbon\Carbon($answer->post->date))->diffForHumans() }}</span>
@endauth
  </div>
  <!-- answer comments -->
  @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])
</div>
