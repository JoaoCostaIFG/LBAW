@php
    // https://stackoverflow.com/questions/40436983/days-hours-and-miniutes-remaining-in-php
    // $time_diff = (new DateTime($notification->date))->diff(new DateTime('NOW'));
    // $interval = $time_diff->format('%d Days %h Hours');
    // $interval = preg_replace('/(^0| 0) (Days)/', '', $interval);

    $time_diff = (new DateTime('2018-05-05'))->diff(new DateTime('NOW'));
    $interval = "";
    if($time_diff->days) {
        $interval .= $time_diff->days . " days ";
    }
    $interval .= $time_diff->h . " hours ago"

@endphp

<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bi bi-exclamation-circle-fill p-1"></i>
      <strong class="me-auto">{{ $notification->title }}</strong>
      <small>{{ $interval }}</small>
      {{-- Button to delete notifications--}}
      <form method="POST" class="col-md text-center" action="{{url("api/notifications/" . $notification->id)}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </form>
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
