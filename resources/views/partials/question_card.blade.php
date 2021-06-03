<!-- Question Card -->
<div class="question_card d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center border
 {{ $question->closed ? 'border-success' : '' }} p-3 rounded gap-3 mb-2">
  <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1">
    <!-- Number Votes -->
    <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4" data-bs-toggle="tooltip" data-bs-placement="left" title="This post has a score of {{ $question->post->score }} points.">{{ $question->post->score }}</span>
      <span>Votes</span>
      <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
    </div>
    <!-- Number Answers -->
    <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4" data-bs-toggle="tooltip" data-bs-placement="left" title="This post has {{ count($question->answers) }} answer(s) in total."> {{ count($question->answers) }} </span>
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
        <p class="d-none d-md-inline-block w-100 text-break question-body-search">{{ $question->post->body }}</p>
      </section>
      <!-- Mark if question is answered -->
      @if ($question->closed)
        <i class="bi bi-check2 text-success text-end fs-1 ms-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="This question already has an accepted answer."></i>
      @endif
    </div>
    <div class="w-100 row gx-0 justify-content-between align-items-center align-self-start">
      <!-- Question Topics -->
      <div class="col-auto d-none d-sm-block d-grid gap-1 p-0">
        <!-- Bounty -->
        @if ($question->bounty > 0)
          @if ($question->closed)
            <del class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="The bounty for this question has been taken. (worth: {{ $question->bounty }} points)">Bounty: {{ $question->bounty }}</del>
          @else
            <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="The bounty for this question is still available. If your answer is accepted, you will receive {{ $question->bounty }} points.">Bounty: {{ $question->bounty }}</span>
          @endif
        @endif
        <!-- Tags -->
        @foreach ($question->topics as $topic)
          <a class="badge bg-primary text-decoration-none" href="/search/tag/{{$topic->name}}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="This post has been tagged under the {{ $topic->name }} tag.">{{ $topic->name }}</a>
        @endforeach
      </div>
      <!-- Question Date -->
      <div class="question-card-date col-auto d-none d-md-flex flex-row align-items-center p-0">
        <span class="date" data-date=" {{$question->post->date}} " data-bs-toggle="tooltip"
         data-bs-placement="bottom" title="Posted on {{(new \Carbon\Carbon($question->post->date))}}">
          Posted {{(new \Carbon\Carbon($question->post->date))->diffForHumans()}}
        </span>
        <!-- Author User Info -->
        <div class="d-flex flex-row flex-md-column justify-content-center align-items-end">
          <!-- Owner Username -->
          <span class="d-md-none">by&nbsp;</span>
          <a href="/profile/{{ $question->post->owner->username }}">
            {{ $question->post->owner->username }}
          </a>
          <!-- Owner Reputation -->
          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $question->post->owner->reputation }} reputation points.">
            {{ $question->post->owner->reputation }}
            <i class="bi bi-award"></i>
          </span>
        </div>
        <!-- User Profile Pic  -->
        <img class="rounded-2 fit-cover" src="{{ asset('storage/'.$question->post->owner->getPfp()) }}"
         alt="{{ $question->post->owner->username }} profile picture" width="40" height="40">
      </div>

      <!-- Owner pic and username -->
      <div class="question-card-date col-5 d-md-none d-flex flex-row align-items-center p-0">
        <span class="date align-self-end" data-date="{{ $question->post->date }}">
          Posted {{(new \Carbon\Carbon($question->post->date))->diffForHumans()}} by&nbsp;
          <a href="/profile/{{ $question->post->owner->username }}">
            {{ $question->post->owner->username }}
          </a>
        </span>
      </div>
    </div>
  </div>
</div>
