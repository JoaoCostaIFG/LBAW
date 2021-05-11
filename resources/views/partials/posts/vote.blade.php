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
<div class="row fs-3 justify-content-center">
    <a id="btn-upvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}} @endif, true)"
      class="btn btn-lg p-0 m-0 text-center d-block
        bi-caret-up{{$up_text}} {{ $can_vote ? 'text-success cursor-na' : ''}}"
      style="width: 20% {{ $can_vote ? '' : '; cursor: not-allowed'}}"></a>
    <span class="d-block text-center" id="score-{{$post->id}}">{{ $post->score }}</span>
    <a id="btn-downvote-{{$post->id}}" @if($can_vote) onclick="updateVote({{$post->id}}, false) @endif"
      class="btn btn-lg p-0 text-center d-block
        bi-caret-down{{$down_text}} {{ $can_vote ? 'text-danger cursor-na' : ''}}"
      style="width: 20% {{ $can_vote ? '' : '; cursor: not-allowed'}}"></a>
</div>
<script src="/js/add_vote.js"></script>