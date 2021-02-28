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
        <div class="carousel-item active text-white bg-dark">
          <div class="p-4 p-md-5 mb-4">
            <span class="text-center">
              <h1 class="display-4 fst-italic">We <i class="bi-heart" style="font-size: 0.8em;"></i> tech</h1>
                <p class="lead my-3">So we built this for your</p>
                <p class="lead mb-0">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">Join now</button>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Toggle Signup">Join now</button>
                </p>
            </span>
          </div>
        </div>
        <div class="carousel-item text-white bg-dark">
          <div class="p-4 p-md-5 mb-4">
            <span class="text-center">
              <h1 class="display-4 fst-italic">We <i class="bi-heart" style="font-size: 0.8em;"></i> tech</h1>
                <p class="lead my-3">So we built this for your</p>
                <p class="lead mb-0">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">Join now</button>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Toggle Signup">Join now</button>
                </p>
            </span>
          </div>
        </div>
        <div class="carousel-item text-white bg-dark">
          <div class="p-4 p-md-5 mb-4">
            <span class="text-center">
              <h1 class="display-4 fst-italic">We <i class="bi-heart" style="font-size: 0.8em;"></i> tech</h1>
                <p class="lead my-3">So we built this for your</p>
                <p class="lead mb-0">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Signup">Join now</button>
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="signupModal" aria-expanded="false" aria-label="Toggle Signup">Join now</button>
                </p>
            </span>
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

  </main>

<?php
require_once '../templates/tpl_footer.php';
?>
