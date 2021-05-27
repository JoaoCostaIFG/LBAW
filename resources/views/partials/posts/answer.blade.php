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
      <div class="answer-options col-auto">
        <!--Check if is moderator-->
        <ul class="nav nav-pills">
          <li class="nav-item dropdown ms-auto">
            <button class="btn btn-sm btn-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              @if (Auth::user()->hasRole('moderator'))
                <!-- delete answer -->
                <li>
                  <form method="POST" action="{{ route('question.delete', ["id" => $answer->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <button class="dropdown-item" type="submit">Delete</button>
                  </form>
                </li>
              @endif
              @if ($answer->post->owner->id == Auth::id() || Auth::user()->hasRole('moderator'))
                <li>
                  <button class="dropdown-item" onclick="editAnswer({{$answer->post->id}})" aria-label="Edit answer">
                    Edit Answer
                  </button>
                  <div class="dropdown-menu col-12 col-lg-9 p-2"> <!-- aria-labelledby="commentEditDropdownLink" -->
                    <form>
                      <textarea class="form-control" id="Textarea-edit-answer-{{$answer->post->id}}">{{ $answer->post->body }}</textarea>
                      <label class="visually-hidden" for="Textarea-edit-answer-{{$answer->post->id}}">Edit Answer</label>
                      <a class="btn btn-primary mt-2" onclick="editAnswer({{$answer->post->id}})">Edit Answer</a>
                    </form>
                  </div>
                </li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
    @endauth

  </div>

  <!-- answer comments -->
  @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])
</div>
