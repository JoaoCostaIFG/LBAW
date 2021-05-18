<div class="offset-0 col-12 offset-sm-7 col-sm-5 offset-md-8 col-md-4 offset-lg-9 col-lg-3 offset-xxl-10 col-xxl-2 row gx-0 align-items-center pt-1">
  <div class="col-12">
    <span class="text-muted">Posted {{ (new \Carbon\Carbon($post->date))->diffForHumans() }}</span>
  </div>
  <div class="col-12 d-flex align-items-center gap-2">
    <a class="text-break" href="/profile/{{$post->owner->username}}">
      <img class="rounded-2 fit-cover" src="{{ asset('storage/' . $post->owner->getPfp()) }}"
       alt="User profile picture" width=40 height=40>
    </a>
    <div class="row gx-0">
        <div class="col-12">
          <a class="text-break" href="/profile/{{$post->owner->username}}">{{ $post->owner->username }}</a>
        </div>
        <div class="col-12">
          <span class="text-break">{{ $post->owner->reputation }}</span>
          <i class="bi bi-award"></i>
        </div>
    </div>
  </div>
</div>

