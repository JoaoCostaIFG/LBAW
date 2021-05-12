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
<span class="row fs-4 justify-content-center text-center">
  <button id="btn-upvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}}, true)" @endif
   class="col-12 btn p-0 {{ $can_vote ? 'text-success cursor-na' : ''}}"
   style="{{ $can_vote ? '' : 'cursor: not-allowed'}}">
    <i class="bi bi-caret-up{{$up_text}}"></i>
  </button>
  <span class="col-12" id="score-{{$post->id}}">{{ $post->score }}</span>
  <button id="btn-downvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}}, false)" @endif
   class="col-12 btn p-0 {{ $can_vote ? 'text-danger cursor-na' : ''}}"
   style="{{ $can_vote ? '' : 'cursor: not-allowed'}}">
    <i class="bi bi-caret-down{{$down_text}}"></i>
  </button>
</span>
<script src="/js/add_vote.js"></script>
