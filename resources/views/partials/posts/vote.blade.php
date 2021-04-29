@php
$vote = false;
if (Auth::check())
  $vote = Auth::user()->getVote($post);
$up_text = '';
$down_text = '';
if ($vote)
   if ($vote->isUpvote())
      $up_text = '-fill';
    else
      $down_text = '-fill';
@endphp
<div class="row fs-3 justify-content-center">
    <a id="btn-upvote-{{$post->id}}" onclick="updateVote({{$post->id}}, true)"
      class="btn btn-lg p-0 m-0 text-center d-block
        bi-caret-up{{$up_text}} {{Auth::check() ? 'text-success' : ''}}"
      style="width: 20%"></a>
    <span class="d-block text-center">{{ $post->score }}</span>
    <a id="btn-downvote-{{$post->id}}" onclick="updateVote({{$post->id}}, false)"
      class="btn btn-lg p-0 text-center d-block
        bi-caret-down{{$down_text}} {{Auth::check() ? 'text-danger' : ''}}"
      style="width: 20%"></a>
</div>
<script src="/js/add_vote.js"></script>