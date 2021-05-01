@if (is_null($post->owner->username))
  <div class="row p-sm-3 p-0">
      <img src="{{ asset('images/user.png') }}" class="center p-2 p-sm-3" alt="">
      <span class="d-block text-center">Deleted User</spawn>
  </div>
@else
  @include('partials.posts.vote', ['post' => $post])
  <div class="row p-sm-3 p-0">
      <img src="{{ $post->owner->picture }}" class="center p-2 p-sm-3" alt="">
      <a class="d-block text-center" href="/profile/{{$post->owner->id}}">{{ $post->owner->username }}</a>
      <span class="d-block text-center">{{ $post->owner->reputation }} Points</span>
  </div>
@endif