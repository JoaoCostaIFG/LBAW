<div class="row themed-grid-col text-start m-0 p-0 answered-question">
  <div class="col-2 text-center m-0 p-3">
      <h4 class="m-0 p-1">{{$question->post->score }}</h4>
  </div>
  <div class="col-8 text-start m-0 p-2 ">
      <h5 class="m-0 p-0">{{ $question->title }}</h5>
      <p class="m-0 p-0">Posted on {{ $question->post->date }}</p>
  </div>
</div>  