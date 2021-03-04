<?php
$title = "Home";
require_once '../templates/tpl_header.php';
?>

<main>
  <div class="nav-scroller bg--body shadow-sm">
    <nav class="nav nav-underline container-fluid p-0 m-0" aria-label="Secondary navigation">
      <a class="btn-secondary nav-link col text-center p-2 m-0" aria-current="page" href="#myCarousel" data-bs-target="#myCarousel" data-bs-slide-to="0">Profile</a>
      <a class="btn-secondary nav-link col text-center p-2 m-0" href="#" data-bs-target="#myCarousel" data-bs-slide-to="1">
        Activity
        <span class="badge bg-light text-dark rounded-pill align-text-bottom">27</span>
      </a>
      <a class="btn-secondary nav-link col text-center p-2 m-0" href="#" data-bs-target="#myCarousel" data-bs-slide-to="2">
        Achievments
        <span class="badge bg-light text-dark rounded-pill align-text-bottom">2</span>
      </a>
    </nav>
  </div>

  <!-- Profile -->
  <div class="container col-4 p-2 text-center">
    <img src="../static/images/a.jpg" class="img-thumbnail mx-auto d-block center-block rounded" style="max-width: 50%;" alt="">
    <span class="d-block text-center"><b>FerroGamer</b></span>
    <span class="d-block text-center">3 Points</span>
  </div>
  <div class="row">
    <div class="col-4 themed-grid-col text-center m-0 p-0">
      <h4 class="m-0 p-0">35</h4>
      <p class="m-0 p-0">Answers</p>
    </div>
    <div class="col-4 themed-grid-col text-center m-0 p-0">
      <h4 class="m-0 p-0">190</h4>
      <p class="m-0 p-0">Questions</p>
    </div>
    <div class="col-4 themed-grid-col text-center m-0 p-0">
      <h4 class="m-0 p-0">355</h4>
      <p class="m-0 p-0">Score</p>
    </div>
  </div>

  <!-- Carousel -->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval=false>
    <div class="carousel-inner">
      <!-- About -->
      <div class="carousel-item active">
        <div class="container-fluid themed-container text-left p-1">
          <h6><b>About</b></h6>
        </div>
        <div class="p-4">
          Hey! <br>
          My Name is João Costa. I am a fonting picardo!
        </div>
      </div>
      <!-- Activity -->
      <div class="carousel-item">
        <div class="container-fluid themed-container text-left p-1">
          <h6><b>Top Topics</b></h6>
        </div>
        <!-- C++ -->
        <div class="container-fluid p-0 m-0 row">
          <div class="row themed-grid-col text-center m-0 p-0 justify-content-center">
            <div class="col me-3">
              <div class="col-1 p-0 m-0 mb-1 text-start">
                C++
              </div>
              <div class="row progress ms-auto">
                <div class="progress-bar p-0 m-0" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
              </div>
            </div>
            <div class="col-auto row text-center">
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">140</h4>
                <p class="m-0 p-0">Score</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">150</h4>
                <p class="m-0 p-0">Questions</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">25</h4>
                <p class="m-0 p-0">Answers</p>
              </div>
            </div>
          </div>
        </div>
        <!-- C -->
        <div class="container-fluid p-0 m-0 row">
          <div class="row themed-grid-col text-start m-0 p-0">
            <div class="col me-3">
              <div class="col-1 p-0 m-0 mb-1 text-left">
                C
              </div>
              <div class="row progress ms-auto">
                <div class="progress-bar p-0 m-0" role="progressbar" style="width: 41%;" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100">41%</div>
              </div>
            </div>
            <div class="col-auto row text-center">
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">72</h4>
                <p class="m-0 p-0">Score</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">13</h4>
                <p class="m-0 p-0">Questions</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">19</h4>
                <p class="m-0 p-0">Answers</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Git -->
        <div class="container-fluid p-0 m-0 row">
          <div class="row themed-grid-col text-start m-0 p-0">
            <div class="col me-3">
              <div class="col-1 p-0 m-0 mb-1 text-left">
                Git
              </div>
              <div class="row progress ms-auto">
                <div class="progress-bar p-0 m-0" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
              </div>
            </div>
            <div class="col-auto row text-center">
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">43</h4>
                <p class="m-0 p-0">Score</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">5</h4>
                <p class="m-0 p-0">Questions</p>
              </div>
              <div class="col-auto text-center m-0 p-2">
                <h4 class="m-0 p-0">11</h4>
                <p class="m-0 p-0">Answers</p>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid themed-container text-left p-1">
          <h6><b>Top Posts</b></h6>
        </div>
        <div class="container-fluid p-0 m-0 row">
          <div class="row themed-grid-col text-start m-0 p-0 answered-question">
            <div class="col-2 text-center m-0 p-3">
              <h4 class="m-0 p-1">59</h4>
            </div>

            <div class="col-8 text-start m-0 p-2 ">
              <h5 class="m-0 p-0">Why do html pretifiers make code longer?</h5>
                <p class="m-0 p-0">Sep 9 '20</p>
            </div>
          </div>
          <div class="row themed-grid-col text-start m-0 p-0 unanswered-question">
            <div class="col-2 text-center m-0 p-3">
              <h4 class="m-0 p-1">44</h4>
            </div>

            <div class="col-8 text-start m-0 p-2">
              <h5 class="m-0 p-0">Why doesn't nvim support the mcfunction plugin?</h5>
                <p class="m-0 p-0">Dec 19 '20</p>
            </div>
          </div>
          <div class="row themed-grid-col text-start m-0 p-0 unanswered-question">
            <div class="col-2 text-center m-0 p-3">
              <h4 class="m-0 p-1">39</h4>
            </div>

            <div class="col-8 text-start m-0 p-2">
              <h5 class="m-0 p-0">How do I remove ambiguity from a CFG?</h5>
                <p class="m-0 p-0">Nov 8 '20</p>
            </div>
          </div>
          <div class="row themed-grid-col text-start m-0 p-0 answered-question">
            <div class="col-2 text-center m-0 p-3">
              <h4 class="m-0 p-1">100</h4>
            </div>

            <div class="col-8 text-start m-0 p-2 ">
              <h5 class="m-0 p-0">How can I remove left recursion from this grammar using factorization</h5>
                <p class="m-0 p-0">Jan 2 '21</p>
            </div>
          </div>
        </div>

      </div>
      <div class="carousel-item">
        <div class="container-fluid themed-container text-left p-1">
          <h6><b>Achivements</b></h6>
        </div>
        <div class="container d-flex flex-wrap justify-content-center mt-3">
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>First Question</b></h6>
                <p class="text-start fs-7 p-0">Make your first question</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>20 Upvotes</b></h6>
                <p class="text-start fs-7 p-0">Get 20 upvotes on a question or answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>Top answer</b></h6>
                <p class="text-start fs-7 p-0">Get your answer chosen by the owner of a question</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>50 Score</b></h6>
                <p class="text-start fs-7 p-0">Get 50 score points</p>
            </div>
          </div>

          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>First Comment</b></h6>
                <p class="text-start fs-7 p-0">Make your first comment</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>50 Upvotes</b></h6>
                <p class="text-start fs-7 p-0">Get 20 upvotes on a question or answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>5 Top answers</b></h6>
                <p class="text-start fs-7 p-0">Get 5 of your answer chosen by the owner of a question</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>100 Score</b></h6>
                <p class="text-start fs-7 p-0">Get 100 score points</p>
            </div>
          </div>

          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>First Answer</b></h6>
                <p class="text-start fs-7 p-0">Make your first answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>100 Upvotes</b></h6>
                <p class="text-start fs-7 p-0">Get 100 upvotes on a question or answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>15 Top answers</b></h6>
                <p class="text-start fs-7 p-0">Get 15 of your answer chosen by the owner of a question</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>200 Score</b></h6>
                <p class="text-start fs-7 p-0">Get 200 score points</p>
            </div>
          </div>

          <div class="container-fluid row-1 border rounded border-success m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>First Vote</b></h6>
                <p class="text-start fs-7 p-0">Make your first vote on a question or answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>200 Upvotes</b></h6>
                <p class="text-start fs-7 p-0">Get 200 upvotes on a question or answer</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>30 Top answers</b></h6>
                <p class="text-start fs-7 p-0">Get 30 of your answer chosen by the owner of a question</p>
            </div>
          </div>
          <div class="container-fluid row-1 border rounded m-3 m-sm-1 p-1" style="max-width: 20em;">
            <div class="col-auto text-start mt-3 p-0">
              <img src="/static/images/trophy.jpg" style="float: left;" class="rounded" width="60" alt="trophy-logo">
            </div>
            <div class="col-auto align-middle mt-4 me-0 p-0">
                <h6 class="text-start"><b>450 Score</b></h6>
                <p class="text-start fs-7 p-0">Get 450 score points</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php
require_once '../templates/tpl_footer.php';
?>