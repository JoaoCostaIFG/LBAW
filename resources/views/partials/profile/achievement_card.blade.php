<div class="container-fluid row align-items-center border rounded
@if ($achieved)
    border-success
@endif
m-1 p-1 bg-dark" style="max-width: 20em;">
    <div class="col-3 text-start ps-2">
      <img src={{ asset('/images/trophy.jpg') }} class="rounded achievement-logo" width="100%" alt="trophy-logo">
    </div>
    <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
        <h6 class="text-start"><b>{{$achievement->title}} </b></h6>
        <p class="text-start fs-7 p-0">{{$achievement->body}}</p>
    </div>
  </div>
