<div class="container-fluid row align-items-center border rounded 
@if($achieved)
  border-success
@else
  border
@endif
m-1 p-1 bg-dark" style="max-width: 20em;">
  <div class="col-3 text-start ps-2">
    <span class="achievement-logo rounded"></span>
  </div>
  <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
    <h6 class="text-start mt-3 mb-0"><b>{{ $achievement->title }}</b></h6>
    <p class="text-start fs-7 mb-3">{{ $achievement->body }} </p>
  </div>
</div>
