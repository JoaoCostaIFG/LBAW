@if (is_null($post->owner->username))
  <div class="row p-sm-3 p-0">
    <img src="{{ asset('storage/'.$user->picture) }}" class="center p-2 p-sm-3" alt="User profile picture">
    <span class="d-block text-center">Deleted User</span>
  </div>
@else
  <div class="row justify-content-center align-items-between text-center gx-0">
    <div class="col-auto">
      @include('partials.posts.vote', ['post' => $post])
    </div>

@if (isset($accepted))
  @if ($accepted)
    <i class="col-auto bi bi-check2 text-success fs-1"></i>
  @else
    @auth @if (Auth::id() == $answer->question->post->owner->id && !$answer->question->closed))
    <form class="col-auto" method="POST" action="{{ url('/question/' . $answer->question->id . '/close') }}">
      {{ csrf_field() }}
      <input type="hidden" id="id_answer" name="id_answer" value="{{ $answer->id }}">
      <button class="btn accept-answer-btn bi bi-check2 fs-1" type="submit">
      </button>
    </form>
    @endif @endauth
  @endif
@endif
  </div>
@endif

