@php
    $notification_url = "";
    if($notification->notification_achievement) {
        $notification_url = "/profile/" . Auth::id() . "#achievements";
    } else {
        if ($notification->notification_post->question) {
            $notification_url = "/question/" . $notification->notification_post->question->id;
        } else {
            $notification_url = "/question/" . $notification->notification_post->answer->question->id;
        }
    }
@endphp

<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bi bi-exclamation-circle-fill p-1"></i>
      <strong class="me-auto">{{ $notification->title }}</strong>
      <small>{{ (new \Carbon\Carbon($notification->date))->diffForHumans() }}</small>
      {{-- Button to delete notifications--}}
      <form method="POST" id="notification-{{$notification->id}}" class="col-md text-center notification-form" action="{{url("api/notifications/" . $notification->id)}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </form>
    </div>
    <a href="{{ url($notification_url) }}">
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
    </a>
</div>
