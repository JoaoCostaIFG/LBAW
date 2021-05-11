@extends('layouts.layout')

@section('title', 'About')
@section('pageType', 'website')
    
@section('content')
<div class="container">
  <h1 class="page-title">About</h1>
  <hr>

  <section class="container">
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
      <img class="col-12 col-md-6 col-lg-3" src="{{ asset('images/about.jpg') }}" alt="First wireflow mockup of the website.">
    </div>
  </section>

  <section class="container mt-2">
    <h2>Our team</h2>
    <hr>
    <div class="row">
      <article class="col-12 col-sm-6 col-lg-3 text-center">
        <img alt="Face of Ana Barros." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/nachus.jpg') }}" aria-label="Ana Nachus">
        <h3>Ana Barros</h3>
        <p>Developer and designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </article><!-- /.col -->
      <article class="col-12 col-sm-6 col-lg-3 text-center">
        <img alt="Face of João Costa." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/irao.jpg') }}" aria-label="Irao Forcas">
        <h3>João Costa</h3>
        <p>Developer and designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </article><!-- /.col -->
      <article class="col-12 col-sm-6 col-lg-3 text-center">
        <img alt="Face of João Lucas." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/crocs.jpg') }}" aria-label="Crocs">
        <h3>João Lucas</h3>
        <p>Developer and designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </article><!-- /.col -->
      <article class="col-12 col-sm-6 col-lg-3 text-center">
        <img alt="Face of Ricardo Fontão." class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{ asset('images/fogao.jpg') }}" aria-label="Fogardo Jorjao">
        <h3>Ricardo Fontão</h3>
        <p>Developer and designer</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </article><!-- /.col -->
    </div><!-- /.row -->
  </section>
</div>
@stop
