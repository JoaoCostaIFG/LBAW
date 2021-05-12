@if (is_null($post->owner->username))
  <div class="row p-sm-3 p-0">
    <img src="{{ asset('images/user.jpg') }}" class="center p-2 p-sm-3" alt="User profile picture">
    <span class="d-block text-center">Deleted User</span>
  </div>
@else
  @include('partials.posts.vote', ['post' => $post])
  <div class="row justify-content-center align-items-between text-center">
@if (isset($accepted))
  @if ($accepted)
    <i class="col-12 bi bi-check2 text-success fs-1"></i>
  @else
    @auth @if (Auth::id() == $answer->question->post->owner->id && is_null($answer->question->accepted_answer))
    <form class="col-12" method="POST" action="{{ url('/question/' . $answer->question->id . '/close') }}">
      {{ csrf_field() }}
      <input type="hidden" id="id_answer" name="id_answer" value="{{ $answer->id }}">
      <button class="btn accept-answer-btn bi bi-check2 fs-1" type="submit">
      </button>
    </form>
    @endif @endauth
  @endif
@endif
    <img class="col-12" src="{{ $post->owner->picture }}" alt="User profile picture">
    <a class="col-auto text-break" href="/profile/{{$post->owner->id}}">{{ $post->owner->username }}</a>
    <span class="col-auto text-break">{{ $post->owner->reputation }} Points</span>
  </div>
@endif
