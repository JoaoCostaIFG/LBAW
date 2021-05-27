<div class="comment row gx-0 py-2 pe-2 bg-dark border border-secondary">
  <div class="col-2 col-sm-1">
    @include('partials.posts.vote', ['post' => $comment->post, 'size' => ''])
  </div>

  <div class="col-10 col-sm-11 row gx-0">
    <p id="comment-{{$comment->post->id}}" class="col-12 mt-1 text-break comment-body">{{ $comment->post->body }}</p>
    <div class="col-12 d-flex gap-1 justify-content-end align-items-center text-break">
      <div class="text-muted">{{ (new \Carbon\Carbon($comment->post->date))->diffForHumans() }} by</div>
@if (!is_null($comment->post->owner->username))
      <a href="/profile/{{ $comment->post->owner->username }}">{{ $comment->post->owner->username }}</a>
@else
      Deleted User
@endif
<!-- edit comment button and form -->
@auth
  @if (Auth::id() == $comment->post->owner->id || Auth::user()->hasRole('moderator'))
      <div>
        <button class="btn btn-sm btn-secondary" data-bs-toggle="dropdown" aria-label="Edit comment" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit comment">
          <i class="bi bi-pencil-square"></i>
        </button>

        <!-- report button -->
        @include('partials.posts.report_button', ['post' => $comment->post])

        <div class="dropdown-menu col-12 col-lg-9 p-2"> <!-- aria-labelledby="commentEditDropdownLink" -->
          <form>
            <textarea class="form-control" id="Textarea-edit-comment-{{$comment->post->id}}">{{ $comment->post->body }}</textarea>
            <label class="visually-hidden" for="Textarea-edit-comment-{{$comment->post->id}}">Edit comment</label>
            <a class="btn btn-primary mt-2" onclick="editComment({{$comment->post->id}})">Edit Comment</a>
          </form>
        </div>
      </div>
  @endif
@endauth
    </div>
  </div>
</div> <!-- .comment -->


