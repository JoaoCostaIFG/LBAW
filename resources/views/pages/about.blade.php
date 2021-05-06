@extends('layouts.layout')

@section('title', 'About')
    
@section('content')
<div class="container">
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
      <img alt="First wireflow mockup of the website." src="{{ asset('images/about.png') }}" width="100%">
    </div>
  </div>

  <h2>Our team</h2>
  <hr>
  <div class="container text-center">
    <div class="row">
      <div class="col-12 col-sm-6 col-lg-3">
        <img alt="Face of Ana Barros." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/user.jpg') }}" role="img" aria-label="Placeholder: 140x140" focusable="false"><title>Placeholder</title></img>

        <h3>Ana Barros</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <img alt="Face of João Costa." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/user.jpg') }}" role="img" aria-label="Placeholder: 140x140" focusable="false"><title>Placeholder</title></img>

        <h3>João Costa</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <img alt="Face of João Lucas." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/user.jpg') }}" role="img" aria-label="Placeholder: 140x140" focusable="false"><title>Placeholder</title></img>

        <h3>João Lucas</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
      <div class="col-12 col-sm-6 col-lg-3">
        <img alt="Face of Ricardo Fontão." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/user.jpg') }}" role="img" aria-label="Placeholder: 140x140" focusable="false"><title>Placeholder</title></img>

        <h3>Ricardo Fontão</h3>
        <p>Main developer/designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</div>
@stop
