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

<div id="question-container" class="row gx-0 p-2">
  <div class="col-2 col-sm-1 align-content-between mb-1">
    @include('partials.posts.qa_votes', ['post' => $question->post], ['question' => $question])
  </div>
  <div class="col-10 col-sm-11 row justify-content-end mb-1 ms-1 pb-2 border-start border-dark">
    <!-- question body -->
    <p class="col-12 text-break ps-0 pe-45">{!! nl2br(e($question->post->body)) !!}</p>

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
          <div class="col-12">
            <span class="fs-5 text-break">{{ $question->post->owner->reputation }}</span>
            <i class="bi bi-award"></i>
          </div>
      </div>
    </div>

    <!-- Options -->
    @auth
      <div id="question-options" class="col-auto justify-content-center">
        <!--Check if is moderator-->
        <ul class="col-12 nav nav-pills">
          <li class="nav-item dropdown ms-auto">
            <button class="btn btn-sm btn-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              @if (Auth::user()->hasRole('moderator'))
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
                <!-- delete question -->
                <li>
                  <form method="POST" action="{{ url('/question/' . $question->id . '/delete') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <button class="dropdown-item" type="submit">Delete</button>
                  </form>
                </li>
              @endif 
              <li>
                <a class="dropdown-item" href="{{ route('question.edit', ['id' => $question->id]) }}">Edit Question</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    @endauth
  </div>
  <!-- question comments -->
  @include('partials.posts.comment_block', ['post' => $question, 'question_id' => $question->id])
  {{-- Maybe needs to receive post and not answer/question --}}
</div>
