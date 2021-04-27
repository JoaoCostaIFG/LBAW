<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bi bi-exclamation-circle-fill p-1"></i>
      <strong class="me-auto">{{ $notification->title }}</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $notification->body }}
        @if ($notification->notification_achievement)
            {{ $notification->notification_achievement->achievement->body }}
        @else
            @if ($notification->notification_post->question)
                {{ Str::limit($notification->notification_post->question->post->body, 25) }}
            @else
                {{ Str::limit($notification->notification_post->answer->post->body, 25) }}
            @endif
        @endif
    </div>
</div>
