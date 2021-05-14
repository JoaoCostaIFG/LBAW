@php
$notification_url = '';
if ($notification->notification_achievement) {
    $notification_url = '/profile/' . Auth::id() . '#achievements';
} else {
    if ($notification->notification_post->question) {
        $notification_url = '/question/' . $notification->notification_post->question->id;
    } else {
        $notification_url = '/question/' . $notification->notification_post->answer->question->id;
    }
}
@endphp

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class="bi bi-exclamation-circle-fill p-1"></i>
    <strong class="me-auto">{{ $notification->title }}</strong>
    <small class="text-muted">{{ (new \Carbon\Carbon($notification->date))->diffForHumans() }}</small>
    <form method="POST" id="notification-{{$notification->id}}" class="d-flex notification-form" action="{{url("api/notifications/" . $notification->id)}}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn-close p-0 me-1" data-bs-dismiss="toast" aria-label="Close"></button>
    </form> 
  </div>
  <div class="toast-body text-break px-1">
    <a href="{{ url($notification_url) }}">
      {{ $notification->body }}
      @if ($notification->notification_achievement)
        {{ $notification->notification_achievement->achievement->body }}
      @else
        @if ($notification->notification_post->question)
          {{ Str::limit($notification->notification_post->question->post->body, 70) }}
        @else
          {{ Str::limit($notification->notification_post->answer->post->body, 70) }}
        @endif
      @endif
    </a>
  </div>
</div>


