@if ($answer->question->accepted_answer == $answer->id)
<section class="accepted-answer-container">
    <div class="container row accepted-answer">
@else
    <div class="container row py-2">
@endif
        <div class="col col-md-2 col-3 align-self-center border-end border-dark">
            @include('partials.posts.user_card', ['post' => $answer->post])
        </div>
        <div class="col col-md-10 col-9">
            <p class="text-break">{{ $answer->post->body }}
            </p>
        </div>

        <div class="container row">
            <div class="col-2 text-center">
                @if ($answer->question->accepted_answer == $answer->id)
                    <i class="bi bi-check2 text-success fs-1"></i>
                @endif
            </div>
            <div class="row col row-cols-auto align-items-end justify-content-end">
                @auth
                    @if (Auth::id() == $answer->question->post->owner->id && is_null($answer->question->accepted_answer))
                        <form class="auth-form" method="POST" action="{{ url('/question/' . $answer->question->id . '/close') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_answer" name="id_answer" value="{{ $answer->id }}">
                            <button type="submit" class="btn btn-sm btn-success col">Mark accepted</button>
                        </form>
                    @endif
                @endauth
                <button type="button" class="btn btn-sm btn-danger ms-1 col">Report</button>
                <p class="text-muted col text-center m-0">Posted {{ (new DateTime($answer->post->date))->diff(new DateTime('NOW'))->days }} day ago</p>
            </div>
        </div>

        @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])

    </div>
@if ($answer->question->accepted_answer == $answer->id)
</section>
<hr class ="mt-3">
@endif