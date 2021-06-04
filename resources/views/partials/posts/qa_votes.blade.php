<div class="row gx-0 justify-content-center align-items-between text-center gap-1">
  <div class="col-auto">
    @include('partials.posts.vote', ['post' => $post])
  </div>

  <!-- accepted indicator/button -->
  @if (isset($accepted))
    @if ($accepted)
      <i class="col-auto bi bi-check2 text-success fs-1" data-bs-toggle="tooltip" data-bs-placement="left" title="This answer has been marked as the accepted answer."></i>
    @else
      @auth @if (Auth::id() == $answer->question->post->owner->id && !$answer->question->closed)
        <form class="col-auto" method="POST" action="{{ route('question.close', ["id" => $answer->question->id]) }}">
          {{ csrf_field() }}
          <input type="hidden" id="id_answer" name="id_answer" value="{{ $answer->id }}">
          <button class="btn accept-answer-btn bi bi-check2 fs-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="Mark this answer as the accepted answer.">
          </button>
        </form>
      @endif @endauth
    @endif
  @endif

  @auth
    @if (!$post->owner->hasRole('moderator') && $post->owner->id != Auth::id() && !Auth::user()->hasRole('moderator'))
    <!-- report button -->
    <div class="col-auto align-self-center">
      @include('partials.posts.report_button', ['post' => $post])
    </div>
    @endif
  @endauth
</div>
