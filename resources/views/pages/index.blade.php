@extends('layouts.layout')

@section('title', 'Homepage')
@section('pageType', 'website')
    
@section('content')
<!-- START CAROUSEL -->
<div id="marketingCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#marketingCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#marketingCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#marketingCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <!-- START CAROUSEL ITEM -->
    <div class="carousel-item active text-white bg-dark text-center marketingCarousel">
      <div class="container p-4 p-md-5 mb-4">
        <h1 class="display-4 fst-italic">We <i class="bi-heart fs-2"></i> tech</h1>
        <p class="lead my-3">So we built this for you</p>
        <p class="lead mb-0">
          <a class="btn btn-secondary" href="#find-out-more" role="button">Find out more</a>
          <a class="btn btn-primary" href="/register" role="button">Join now</a>
        </p>
      </div>
    </div>
    <div class="carousel-item text-white bg-dark text-center marketingCarousel">
      <div class="container p-4 p-md-5 mb-4">
        <h1 class="display-4 fst-italic">The top question of the week</h1>
        <p class="lead my-3">Why does this code run faster on a sorted array?</p>
        <a class="btn btn-primary" href="/pages/question.php" role="button">Visit question</a>
      </div>
    </div>
    <div class="carousel-item text-white bg-dark text-center marketingCarousel">
      <div class="container p-4 p-md-5 mb-4">
        <h1 class="display-4 fst-italic">Read the latest news about us</h1>
        <p class="lead my-3">Stay up-to-date on everything that is going on with the site</p>
        <a class="btn btn-primary" href="/news" role="button">News</a>
      </div>
    </div>
    <!-- END CAROUSEL ITEM -->
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#marketingCarousel"  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#marketingCarousel"  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- END CAROUSEL -->

<div class="container">
  <!-- START FEATURETTES -->
  <div id="find-out-more">
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-12 col-sm-8 col-md-10">
        <h2 class="featurette-heading">Share your questions. <span class="text-muted">There's always someone ready to answer.</span></h2>
        <p class="lead">You'll get the help you need and leave behind content that'll help others that have the same problem as you.</p>
      </div>
      <div class="col-12 col-sm-4 col-md-2 text-center text-sm-end">
        <span id="share_img" class="featurette-img mx-auto"><span/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-12 col-sm-8 col-md-10 order-md-2 text-md-end">
        <h2 class="featurette-heading">Help the community. <span class="text-muted">Answer the questions you see.</span></h2>
        <p class="lead">Every answer can make the difference.</p>
      </div>
      <div class="col-12 col-sm-4 col-md-2 text-center text-sm-end text-md-start order-md-1">
        <span id="help_img" class="featurette-img mx-auto"><span/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-12 col-sm-8 col-md-10">
        <h2 class="featurette-heading">Be recognised by your worth. <span class="text-muted">Become a valuable member of the community.</span></h2>
        <p class="lead">The more good answers you give, the more standing you get. People will see you as a valuable and helpful member of the community.</p>
      </div>
      <div class="col-12 col-sm-4 col-md-2 text-center text-sm-end">
        <span id="be_img" class="featurette-img mx-auto"><span/>
      </div>
    </div>

    <hr class="featurette-divider">
  </div>
  <!-- END FEATURETTES -->

  <!-- START FEATURE LIST -->
  <div id="site-features">
    <h2>Features</h2>
    <hr>
    You can browse the contents freely forever and become a member at any
    time. We're always looking for people ready to contribute and help each
    other. These are some of the features you'll find in our website:
    <ul>
      <li>Search and filters</li>
      <li>Ask and answer questions</li>
      <li>Comment on answer and questions</li>
      <li>Vote on questions, answers and comments</li>
      <li>Propose edits</li>
      <li>Get notified of activity in you questions you participate</li>
      <li>View other users' profile</li>
      <li>Get achievements</li>
      <li>Earn perks based on your reputation</li>
    </ul>
  </div>
  <!-- END FEATURE LIST -->
</div>
@stop
