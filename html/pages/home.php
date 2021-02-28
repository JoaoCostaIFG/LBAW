<?php
$title="Home";
require_once '../templates/tpl_header.php';
?>

  <main>
    <!-- START CAROUSEL -->
    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <!-- START CAROUSEL ITEM -->
        <div class="carousel-item active text-white bg-dark text-center">
          <div class="container p-4 p-md-5 mb-4">
            <h1 class="display-4 fst-italic">We <i class="bi-heart" style="font-size: 0.8em;"></i> tech</h1>
            <p class="lead my-3">So we built this for your</p>
            <p class="lead mb-0">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">Join now</button>
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Toggle Signup">Join now</button>
            </p>
          </div>
        </div>
        <div class="carousel-item text-white bg-dark text-center">
          <div class="container p-4 p-md-5 mb-4">
            <h1 class="display-4 fst-italic">The top question of the week</h1>
            <p class="lead my-3">Why does this code run faster on a sorted array?</p>
            <p class="lead mb-0">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">Find out more</button>
            </p>
          </div>
        </div>
        <div class="carousel-item text-white bg-dark text-center">
          <div class="container p-4 p-md-5 mb-4">
            <h1 class="display-4 fst-italic">Read the latest news about us</h1>
            <p class="lead my-3">Stay up-to-date on everything that is going on with the site</p>
            <p class="lead mb-0">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">News</button>
            </p>
          </div>
        </div>
        <!-- END CAROUSEL ITEM -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators"  data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators"  data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- END CAROUSEL -->

    <!-- START FEATURETTES -->
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">
    <!-- END FEATURETTES -->

  </main>

<?php
require_once '../templates/tpl_footer.php';
?>
