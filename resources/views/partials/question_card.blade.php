<!-- Question Card -->
<div class="question_card d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center border
 {{ $question->closed ? 'border-success' : '' }} p-3 rounded gap-3 mb-2">
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
    <div class="d-flex w-100">
      <section>
        <!-- Question Title -->
        <h4><a class="fs-5 fw-bold" href="/question/{{ $question->id }}">{{ $question->title }}</a></h4>
        <!-- Question body -->
        <p class="d-none d-md-block">{!! mb_strimwidth(nl2br(e($question->post->body)), 0, 255, "...") !!}</p>
      </section>
      <!-- Mark if question is answered -->
      @if ($question->closed)
        <i class="bi bi-check2 text-success text-end fs-1 ms-auto"></i>
      @endif
    </div>
    <div class="w-100 row gx-0 justify-content-between align-items-center align-self-start">
      <!-- Question Topics -->
      <div class="col-7 col-md-6 col-lg-7 col-xl-8 d-none d-sm-block d-grid gap-1 p-0">
        @foreach ($question->topics as $topic)
          <a class="badge bg-primary text-decoration-none" href="/search/tag/{{$topic->name}}">{{ $topic->name }}</a>
        @endforeach
      </div>
      <!-- Question Date -->
      <div class="question-card-date col-8 col-md-6 col-lg-5 col-xl-4 d-none d-md-flex flex-row align-items-center p-0">
        <span class="date align-self-end" data-date={{$question->post->date}}>
          Posted {{(new \Carbon\Carbon($question->post->date))->diffForHumans()}}
        </span>
        <!-- Author User Info -->
        <!-- User Profile Pic  -->
        <img class="rounded-2 fit-cover" src="{{ asset('storage/'.$question->post->owner->getPfp()) }}"
         alt="User profile picture" width="40" height="40">
        <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
          <!-- Owner Username -->
          <span class="d-md-none">by&nbsp;</span>
          <a href="/profile/{{ $question->post->owner->username }}">
            {{ $question->post->owner->username }}
          </a>
          <!-- Owner Reputation -->
          <span>
            {{ $question->post->owner->reputation }}
            <i class="bi bi-award"></i>
          </span>
        </div>
      </div>

      <div class="question-card-date col-5 d-md-none d-flex flex-row align-items-center p-0">
        <span class="date align-self-end" data-date={{$question->post->date}}>
          Posted {{(new \Carbon\Carbon($question->post->date))->diffForHumans()}} by&nbsp;
          <a href="/profile/{{ $question->post->owner->username }}">
            {{ $question->post->owner->username }}
          </a>
        </span>
      </div>
    </div>
  </div>
</div>
