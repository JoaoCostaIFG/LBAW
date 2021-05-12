@php
$can_vote = Auth::check() && $post->owner->id != Auth::id();

$up_text = '';
$down_text = '';
$vote = false;
if (Auth::check())
  $vote = Auth::user()->getVote($post);
if ($vote)
   if ($vote->isUpvote())
      $up_text = '-fill';
    else
      $down_text = '-fill';

@endphp
<span class="row justify-content-center text-center {{ $size ?? 'fs-4' }}">
  <span class="col-12">
    <button id="btn-upvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}}, true)" @endif
     class="btn p-0 bi bi-caret-up{{$up_text}} {{ $can_vote ? 'text-success cursor-na vote-up-btn' : ''}}"
     style="{{ $can_vote ? '' : 'cursor: not-allowed'}}">
    </button>
  </span>
  <span class="col-12" id="score-{{$post->id}}">{{ $post->score }}</span>
  <span class="col-12">
    <button id="btn-downvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}}, false)" @endif
     class="btn p-0 bi bi-caret-down{{$down_text}} {{ $can_vote ? 'text-danger cursor-na vote-down-btn' : ''}}"
     style="{{ $can_vote ? '' : 'cursor: not-allowed'}}">
    </button>
  </span>
</span>
<script src="/js/add_vote.js"></script>
