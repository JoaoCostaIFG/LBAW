<div class="comment row bg-dark border border-secondary align-items-center">

    @if (!is_null($comment->post->owner->username))
    <a class="col-4 text-center" href="/profile/{{$comment->post->owner->id}}">
        {{ $comment->post->owner->username }}</a>
    @else
    <span class="col-4 text-center">
        Deleted User</span>
    @endif
    <p id="comment-{{$comment->post->id}}" class="col-7">{{ $comment->post->body }}</p>
    @auth
        @if (Auth::id() == $comment->post->owner->id)
            <button class="btn btn-secondary col-1 dropdown-toggle" data-bs-toggle="dropdown" id="commentEditDropdownLink" aria-expanded="false" >
                {{-- <p class="bi-caret-down" ><p> --}}
                <i class="bi bi-pencil-square"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="commentEditDropdownLink">
                <form class="container">
                    <textarea class="form-control" id="Textarea-edit-{{$comment->post->id}}" rows="2">{{ $comment->post->body }}</textarea>
                    <label class="visually-hidden" for="Textarea-edit-{{$comment->post->id}}">Edit comment</label>
                    <a class="btn btn-primary" onclick="editComment({{$comment->post->id}})">Edit Comment</a>
                </form>
            </div>
            <script src="/js/edit_comment.js"></script>
        @endif
    @endauth
</div> <!-- .comment -->
