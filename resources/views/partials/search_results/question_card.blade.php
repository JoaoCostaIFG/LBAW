<!-- Question Card -->
<div class="d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center gap-3 w-100 border p-3">
  <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1 ">
    <!-- Number Votes -->
    <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4">{{ $question->post->score }}</span>
      <span>Votes</span>
      <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
    </div>
    <!-- TODO Number Answers -->
    <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
      <span class="fs-4"> 10 </span>
      <span>Answers</span>
      <span class="d-sm-none"><i class="bi bi-chat-left-text"></i></span>
    </div>
  </div>
  <div class="d-flex flex-column justify-content-start align-items-start w-100">
    <section>
      <!-- Question Title -->
      <a class="fs-5 fw-bold" href="/pages/question_admin.php">{{ $question->title }}</a>
      <!-- Question body -->
      <p class="d-none d-md-block">{{ $question->post->body }}</p>
    </section>
    <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
      <!-- Question Topics -->
      <div class="d-none d-sm-block d-grid gap-1 mt-0">
        @foreach ($question->topics as $topic)
          <a class="badge bg-primary text-decoration-none">{{ $topic->name }}</a>
        @endforeach
      </div>
      <!-- Question Date -->
      <div class="d-flex flex-row gap-2 align-items-center">
        <span class="align-self-end">
          Posted {{ (new DateTime($question->post->date))->diff(new DateTime('NOW'))->days }} days ago
        </span>
        <!-- Author User Info -->
        <!-- User Profile Pic  -->
        <img class="d-none d-md-block rounded-2 fit-cover" src="{{ asset('images/user.png') }}" alt="User Picture" width="40px" height="40px">
        <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
          <!-- Owner Username -->
          <span class="d-md-none">by&nbsp;</span>
          <a href="/pages/profile.php">
            {{ $question->post->owner->username }}
          </a>
          <!-- Owner Reputation -->
          <span class="d-none d-md-block">
            {{ $question->post->owner->reputation }}
            <i class="bi bi-award"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>