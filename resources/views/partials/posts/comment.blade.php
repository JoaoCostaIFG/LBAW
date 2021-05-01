<div class="comment row bg-dark border border-secondary align-items-center">

    @if (!is_null($comment->post->owner->username))
    <a class="col-4 text-center" href="/profile/{{$comment->post->owner->id}}">
        {{ $comment->post->owner->username }}</a>
    @else
    <span class="col-4 text-center">
        Deleted User</span>
    @endif
    <p class="col-8">{{ $comment->post->body }}</p>
</div> <!-- .comment -->
