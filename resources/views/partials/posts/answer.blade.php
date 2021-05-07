<div class="row py-2">
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
        @include('partials.posts.user_card', ['post' => $answer->post])
    </div>
    <div class="col col-md-10 col-9">
        <p class="text-break">{{ $answer->post->body }}
        </p>
    </div>

    <div class="row row-cols-auto align-items-end justify-content-end">
        @auth
            @if (Auth::id() == $answer->question->post->owner->id && is_null($answer->question->accepted_answer))
                <form class="auth-form" method="POST" action="{{ url('/question/' . $answer->question->id . '/close') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-success col">Mark accepted</button>
                </form>
            @endif
        @endauth
        <button type="button" class="btn btn-sm btn-danger ms-1 col">Report</button>
        <p class="text-muted col text-center m-0">Posted {{ (new DateTime($answer->post->date))->diff(new DateTime('NOW'))->days }} day ago</p>
    </div>

    @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])

</div>
