<!-- Question Card -->
<div class="question_card d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center border p-3 rounded gap-3 mb-2">
  <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1">
    <!-- Number Votes -->
    <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4">{{ $question->post->score }}</span>
      <span>Votes</span>
      <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
    </div>
    <!-- Number Answers -->
    <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4"> {{ count($question->answers) }} </span>
      <span>Answers</span>
      <span class="d-sm-none"><i class="bi bi-chat-left-text"></i></span>
    </div>
  </div>
  <div class="d-flex flex-column justify-content-start align-items-start w-100">
    <section>
      <!-- Question Title -->
      <a class="fs-5 fw-bold" href="/question/{{ $question->id }}">{{ $question->title }}</a>
      <!-- Question body -->
      <p class="d-none d-md-block">{{ $question->post->body }}</p>
    </section>
    <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
      <!-- Question Topics -->
      <div class="d-none d-sm-block d-grid gap-1 mt-0">
        @foreach ($question->topics as $topic)
          <a class="badge bg-primary text-decoration-none" href="/search/tag/{{$topic->name}}">{{ $topic->name }}</a>
        @endforeach
      </div>
      <!-- Question Date -->
      <div class="d-flex flex-row gap-3 align-items-center">
        <span class="date align-self-end" data-date={{$question->post->date}}>
          Posted {{(new \Carbon\Carbon($question->post->date))->diffForHumans()}}
        </span>
        <!-- Author User Info -->
        <!-- User Profile Pic  -->
        <img class="d-none d-md-block rounded-2 fit-cover" src="{{ asset('images/user.jpg') }}" alt="User profile picture" width="40px" height="40px">
        <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
          <!-- Owner Username -->
          <span class="d-md-none">by&nbsp;</span>
          @if (is_null($question->post->owner->username))
            <span class="d-none d-md-block">
              Deleted User
            </span>
          @else
            <a href="/profile/{{ $question->post->owner->id }}">
              {{ $question->post->owner->username }}
            </a>
            <!-- Owner Reputation -->
            <span class="d-none d-md-block">
              {{ $question->post->owner->reputation }}
              <i class="bi bi-award"></i>
            </span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
