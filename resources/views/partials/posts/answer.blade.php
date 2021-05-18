<hr>

<div class="row gx-0 p-2 {{ $answer->question->accepted_answer == $answer->id ? 'accepted-answer' : '' }}">
  <div class="col-2 col-sm-1 align-content-between mb-1">
    @include('partials.posts.qa_votes', ['post' => $answer->post,
      'accepted' => ($answer->question->accepted_answer == $answer->id),
      'answer' => $answer])
  </div>
  <div class="col-10 col-sm-11 row justify-content-end mb-1 ms-1 pb-2 border-start border-dark">
    <!-- answer body -->
    <p class="col-12 text-break ps-0 pe-45">{!! nl2br(e($answer->post->body)) !!} </p>

    @include('partials.posts.user_card', ['post' => $answer->post])
    
  </div>
  <!-- answer comments -->
  @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])
</div>
