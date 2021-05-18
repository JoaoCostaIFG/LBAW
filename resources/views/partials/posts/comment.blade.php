<div class="comment row gx-0 ms-1 py-2 pe-2 bg-dark border border-secondary">
  <div class="col-2 col-sm-1">
    @include('partials.posts.vote', ['post' => $comment->post, 'size' => ''])
  </div>

  <div class="col-10 col-sm-11 row gx-0">
    <p id="comment-{{$comment->post->id}}" class="col-12 mt-1 text-break">{{ $comment->post->body }}</p>
    <div class="col-12 d-flex gap-1 justify-content-end align-items-center text-break">
      <div class="text-muted">{{ (new \Carbon\Carbon($comment->post->date))->diffForHumans() }} by</div>
@if (!is_null($comment->post->owner->username))
      <a href="/profile/{{ $comment->post->owner->username }}">{{ $comment->post->owner->username }}</a>
@else
      Deleted User
@endif
<!-- edit comment button and form -->
@auth @if (Auth::id() == $comment->post->owner->id || Auth::user()->hasRole('moderator'))
      <div>
        <button class="btn btn-sm btn-secondary" data-bs-toggle="dropdown" aria-label="Edit comment" aria-expanded="false">
          <i class="bi bi-pencil-square"></i>
        </button>
        <div class="dropdown-menu"> <!-- aria-labelledby="commentEditDropdownLink" -->
          <form class="container">
            <textarea class="form-control" id="Textarea-edit-{{$comment->post->id}}" rows="2">{{ $comment->post->body }}</textarea>
            <label class="visually-hidden" for="Textarea-edit-{{$comment->post->id}}">Edit comment</label>
            <a class="btn btn-primary" onclick="editComment({{$comment->post->id}})">Edit Comment</a>
          </form>
        </div>
      </div>
      <script src="/js/edit_comment.js"></script>
@endif @endauth
    </div>
  </div>
</div> <!-- .comment -->


