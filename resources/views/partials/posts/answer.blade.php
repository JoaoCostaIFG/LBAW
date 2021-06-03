<hr>

<div class="answer-container row gx-0 p-2 {{ $answer->question->accepted_answer == $answer->id ? 'accepted-answer' : '' }}">
  <div class="col-2 col-sm-1 align-content-between mb-1">
    @include('partials.posts.qa_votes', ['post' => $answer->post,
      'accepted' => ($answer->question->accepted_answer == $answer->id),
      'answer' => $answer])
  </div>
  <div class="col-10 col-sm-11 row justify-content-end mb-1 ms-1 pb-2 border-start border-dark">
    <!-- answer body -->
    <p id="answer-{{$answer->post->id}}" class="col-12 text-break ps-0 pe-45 answer-body">{{ $answer->post->body }} </p>
    @include('partials.posts.user_card', ['post' => $answer->post])

    <!-- Options -->
    @auth
    @php
        $is_moderator = Auth::user()->hasRole('moderator');
        $can_edit = $answer->post->owner->id == Auth::id() || Auth::user()->hasRole('moderator')
    @endphp
      @if ($is_moderator || $can_edit)
        <div class="answer-options col-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="Options">
          <!--Check if is moderator-->
          <ul class="nav nav-pills">
            <li class="nav-item dropdown ms-auto">
              <button class="btn btn-sm btn-secondary" data-bs-toggle="dropdown" aria-label="Answer options toggle">
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu">
                @if ($is_moderator)
                  <!-- delete answer -->
                  <li>
                    <form method="POST" action="{{ route('question.delete', ["id" => $answer->id]) }}"
                      enctype="multipart/form-data">
                      @csrf
                      <button class="dropdown-item" type="submit">Delete</button>
                    </form>
                  </li>
                @endif
                @if ($can_edit)
                  <li>
                    <li>
                      <a class="dropdown-item" href="{{ route('answer.edit', ['id' => $answer->id]) }}">Edit Answer</a>
                    </li>
                  </li>
                @endif
              </ul>
            </li>
          </ul>
        </div>
      @endif
    @endauth

  </div>

  <!-- answer comments -->
  @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])
</div>
