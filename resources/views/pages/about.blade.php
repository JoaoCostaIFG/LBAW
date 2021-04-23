@extends('layouts.layout')

@section('title', 'About')
    
@section('content')
<main class="container">
  <h1 class="page-title">About</h1>
  <hr>

  <h2>About Segmentation<b> fault</b></h2>
  <div class="row">
    <div class="col-12 col-md-6 col-lg-9">
      <p>This is a community for sharing knowledge online. People
      are encouraged to ask and answer questions, thus sharing what they know
      and leaving behind information to help others in the future.</p>
      <p>Topics group questions together and you can filter your
      search results by these. You can get achievements by being helpful to
      the community and earn perks. Other users will see your profile and
      recognize you for the worth of your achievements and community contributions.</p>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
      <img src="{{ asset('images/about.png') }}" width="100%">
    </div>
  </div>

  <h2>Our team</h2>
  <hr>
  <div class="container text-center">
    <div class="row">
      <div class="col-12 col-sm-6 col-lg-3">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h3>Ana Barros</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h3>João Costa</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h3>João Lucas</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h3>Ricardo Fontão</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</main>
@stop