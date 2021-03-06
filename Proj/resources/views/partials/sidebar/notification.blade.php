@php
$notification_url = '';
if ($notification->notification_achievement) {
    $notification_url = '/profile/' . Auth::user()->username . '#achievements';
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
    <form method="POST" id="notification-{{$notification->id}}" class="d-flex notification-form" action="{{ route('notification.delete', ["id" => $notification->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-close p-0 me-1" data-bs-dismiss="toast" aria-label="Dismiss notication"></button>
    </form>
  </div>
  <div class="toast-body text-break">
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


