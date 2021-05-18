<div class="d-flex flex-row align-items-center justify-content-between mt-0">
  <div>
    <h2 class="page-title">{{ $question->title }}</h2>
    <!-- Tags -->
    @foreach ($question->topics as $topic)
      <a class="badge bg-primary text-decoration-none" href="/search/tag/{{ $topic->name }}">{{ $topic->name }}</a>
    @endforeach
  </div>
  @if (is_null($question->accepted_answer) && $question->closed)
    <h2><span class="badge bg-success mb-1 mt-3">Duplicated</span></h2>
  @endif
</div>

<hr>

<div class="row gx-0 p-2">
  <div class="col-2 col-sm-1 align-content-between mb-1">
    @include('partials.posts.user_card', ['post' => $question->post], ['question' => $question])
  </div>
  <div class="col-10 col-sm-11 row justify-content-end mb-1 ms-1 pb-2 border-start border-dark">
    <!-- question body -->
    <p class="col-12 text-break">{!! nl2br(e($question->post->body)) !!}</p>

    <div class="col-12 d-flex justify-content-start align-items-center gap-2">
      @auth
        <!-- report button -->
        <!-- report button -->
        @include('partials.posts.report_button', ['post' => $question->post])
        <!-- Options -->
        @if (Auth::user()->hasRole('moderator'))
          <!--Check if is moderator-->
          <ul class="nav nav-pills">
            <li class="nav-item dropdown ms-auto">
              <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                href="#" role="button">
                <span class="d-none d-sm-block">Options</span>
                <i class="bi bi-filter-right"></i></a>
              <ul class="dropdown-menu">
                <!-- Mark as duplicated -->
                @if (!$question->closed)
                  <li>
                    <form method="POST" action="{{ url('/question/' . $question->id . '/close') }}"
                      enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <button class="dropdown-item" type="submit">Mark as duplicate</button>
                    </form>
                  </li>
                @endif
                <!-- Mark as delete -->
                <li>
                  <form method="POST" action="{{ url('/question/' . $question->id . '/delete') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <button class="dropdown-item" type="submit">Delete</button>
                  </form>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('question.edit', ['id' => $question->id]) }}">Edit Question</a>
                </li>
              </ul>
            </li>
          </ul>
        @endif
      @endauth
    </div>

    <div class="offset-0 col-12 offset-sm-7 col-sm-5 offset-md-8 col-md-4 offset-lg-9 col-lg-3 offset-xxl-10 col-xxl-2 row gx-0 align-items-center gap-1 pt-1">
      <div class="col-12">
        <span class="text-muted">Posted {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</span>
      </div>
      <div class="col-auto">
        <img src="{{ asset('storage/'.$question->post->owner->picture) }}" alt="User profile picture" width=40 height=40>
      </div>
      <div class="col-auto row gx-0">
          <div class="col-12">
            <a class="text-break" href="/profile/{{$question->post->owner->username}}">{{ $question->post->owner->username }}</a>
          </div>
          <span class="col-12 text-break">{{ $question->post->owner->reputation }} Points</span>
      </div>
    </div>
  </div>
  <!-- question comments -->
  @include('partials.posts.comment_block', ['post' => $question, 'question_id' => $question->id])
  {{-- Maybe needs to receive post and not answer/question --}}
</div>
