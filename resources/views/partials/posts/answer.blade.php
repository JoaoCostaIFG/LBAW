<div class="row py-2">
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
        @include('partials.posts.user_card', ['post' => $answer->post])
    </div>
    <div class="col col-md-10 col-9">
        <p class="text-break">{{ $answer->post->body }}
        </p>
    </div>

    <div class="row">
        @auth
            @if (Auth::id() == $answer->question->post->owner->id && is_null($answer->question->accepted_answer))
                <button type="button" class="btn btn-success col-sm-2 offset-sm-7 col-4 offset-5 my-2">Mark accepted</button>
            @endif
        @endauth
        <button type="button" class="btn btn-danger col-sm-2 offset-sm-7 col-4 offset-5 my-2">Report</button>
        <p class="text-muted col-3 text-center m-0 align-self-center">Posted {{ (new DateTime($answer->post->date))->diff(new DateTime('NOW'))->days }} day ago</p>
    </div>

    @include('partials.posts.comment_block', ['post' => $answer, 'answer_id' => $answer->id])

</div>
