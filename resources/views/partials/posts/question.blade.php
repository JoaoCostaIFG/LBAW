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
  <div class="col-3 col-md-2 col-lg-1 align-content-between mb-1">
    @include('partials.posts.user_card', ['post' => $question->post], ['question' => $question])
  </div>
  <div class="col-9 col-md-10 col-lg-11 row align-content-between mb-1 ms-1 border-start border-dark">

    <div>
      <!-- Options -->
      @auth @if (Auth::user()->hasRole('moderator'))
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
      @endauth
    @endif
    <p class="col-12 text-break">{{ $question->post->body }}</p>
  </div>

  @auth
    <div class="col-12 d-flex justify-content-end align-items-center gap-1">
      <button class="btn btn-sm btn-outline-danger" type="button">Report</button>
      <span class="text-muted">Posted {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</span>
    </div>
  @else
    <span class="col-12 text-muted text-end">Posted
      {{ (new \Carbon\Carbon($question->post->date))->diffForHumans() }}</span>
  @endauth
</div>
<!-- question comments -->
@include('partials.posts.comment_block', ['post' => $question, 'question_id' => $question->id])
{{-- Maybe needs to receive post and not answer/question --}}
</div>
