@php
if (isset($topic_questions[$topic->topic_name])) {
    $num_questions = $topic_questions[$topic->topic_name]->cnt;
} else {
    $num_questions = 0;
}

if (isset($topic_answers[$topic->topic_name])) {
    $num_answers = $topic_answers[$topic->topic_name]->cnt;
} else {
    $num_answers = 0;
}

$num_posts = count($user->questions) + count($user->answers);
if ($num_posts != 0) {
    $percentage = ($topic->cnt / $num_posts) * 100;
    $percentage = round($percentage, 2);
} else {
    $percentage = 0;
}

@endphp


<div class="container-fluid p-0 m-0 row border mb-2 mt-2" style="border-radius: 15px;">
  <div class="row themed-grid-col text-start m-0 p-0">
    <div class="container col">
      <div class="col-1 p-0 mt-2 mb-2 text-left">
        <a class="badge bg-primary text-decoration-none">{{ $topic->topic_name }}</a>
      </div>
      <span class="p-0 progress ms-auto" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="{{ $percentage }}% of your participations are tagged as {{ $topic->topic_name }}">
        <div class="progress-bar p-0 m-0" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="25"
          aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
      </span>
    </div>
    <div class="col-auto row text-center">
      <div class="col-auto text-center m-0 p-2">
        <h4 class="m-0 p-0">{{ $topic->score }}</h4>
        <span class="m-0 p-0 d-none d-md-block">
          Score
        </span>
        <i class="bi bi-star-fill d-block d-md-none"></i>
      </div>
      <div class="col-auto text-center m-0 p-2">
        <h4 class="m-0 p-0">{{ $num_questions }}</h4>
        <span class="m-0 p-0 d-none d-md-block">
          Questions
        </span>
        <i class="bi bi-patch-question-fill d-block d-md-none"></i>
      </div>
      <div class="col-auto text-center m-0 p-2">
        <h4 class="m-0 p-0">{{ $num_answers }}</h4>
        <span class="m-0 p-0 d-none d-md-block">
          Answers
        </span>
        <i class="bi bi-chat-left-text-fill d-block d-md-none"></i>
      </div>
    </div>
  </div>
</div>
