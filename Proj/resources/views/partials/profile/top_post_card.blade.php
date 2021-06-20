<div class="row themed-grid-col text-start m-0 p-0 answered-question">
  <div class="col-1 text-center m-0 p-2">
    <h4 class="m-0 p-1">{{ $question->post->score }}</h4>
  </div>
  <div class="col-8 text-start m-0 p-2 ">
    <h5 class="m-0 p-0"><a href="/question/{{ $question->id }}">{{ $question->title }}</a></h5>
    <p class="m-0 p-0">Posted on {{ $question->post->date }}</p>
  </div>
</div>
