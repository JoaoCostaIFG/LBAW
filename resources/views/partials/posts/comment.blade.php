<div class="comment row bg-dark border border-secondary align-items-center">
    <a class="col-4 text-center" href="/profile/{{$comment->post->owner->id}}">
        {{ $comment->post->owner->username }}</a>
    <p class="col-8">{{ $comment->post->body }}</p>
</div> <!-- .comment -->
