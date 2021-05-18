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
    
    <div class="offset-0 col-12 offset-sm-7 col-sm-5 offset-md-8 col-md-4 offset-lg-9 col-lg-3 offset-xxl-10 col-xxl-2 row gx-0 align-items-center gap-1 pt-1">
      <div class="col-12">
        <span class="text-muted">Posted {{ (new \Carbon\Carbon($answer->post->date))->diffForHumans() }}</span>
      </div>
      <div class="col-auto">
        <img src="{{ asset('storage/'.$answer->post->owner->picture) }}" alt="User profile picture" width=40 height=40>
      </div>
      <div class="col-auto row gx-0">
          <div class="col-12">
            <a class="text-break" href="/profile/{{$answer->post->owner->username}}">{{ $answer->post->owner->username }}</a>
          </div>
          <span class="col-12 text-break">{{ $answer->post->owner->reputation }} Points</span>
      </div>
    </div>
  </div>
  <!-- answer comments -->
  @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])
</div>
