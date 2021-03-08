<?php
require_once '../templates/tpl_header.php';
require_once '../templates/tpl_footer.php';

$title = "Profile";
drawHeader($title);
?>

<main class="container">
  <!-- BEGIN TABS -->
  <nav class="mt-2">
    <ul class="nav nav-tabs justify-content-end">
      <li class="nav-item">
        <a href="#profile-tab" class="nav-link active" data-toggle="tab">
          Profile
        </a>
      </li>
      <li class="nav-item">
        <a href="#activity-tab" class="nav-link" data-toggle="tab">
          Activity
          <span class="badge bg-light text-dark rounded-pill">27</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#achievements-tab" class="nav-link" data-toggle="tab">
          Achievements
          <span class="badge bg-light text-dark rounded-pill">2</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- END TABS -->

  <!-- Profile -->
  <div class="container p-2 text-center">
    <img src="../static/images/a.jpg" id="profile-picture" class="img-thumbnail rounded" width="50%" alt="Profile picture">
    <span class="d-block text-center"><b>FerroGamer</b></span>
    <span class="d-block text-center">3 Points</span>
  </div>
  <div class="row user-engagement-count">
    <div class="col-4 themed-grid-col text-center">
      <h4 class="m-0 p-0">35</h4>
      <p class="m-0 p-0">Answers</p>
    </div>
    <div class="col-4 themed-grid-col text-center">
      <h4 class="m-0 p-0">190</h4>
      <p class="m-0 p-0">Questions</p>
    </div>
    <div class="col-4 themed-grid-col text-center">
      <h4 class="m-0 p-0">355</h4>
      <p class="m-0 p-0">Score</p>
    </div>
  </div>

  <!-- BEGIN TAB CONTENTS -->
  <div class="tab-content">
    <!-- BEGIN ABOUT TAB -->
    <div id="profile-tab" class="tab-pane fade show active">
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">About</h5>
      </div>
      <p class="p-4">
        Hey!<br>
        My Name is João Costa. I am a fonting picardo!
      </p>
    </div>
    <!-- END ABOUT TAB -->
    <!-- BEGIN ACTIVITY TAB -->
    <div id="activity-tab" class="tab-pane fade">
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Top Topics</h5>
      </div>
      <!-- C++ -->
      <div class="container-fluid p-0 m-0 row">
        <div class="row themed-grid-col text-center m-0 p-0 justify-content-center">
          <div class="col me-3">
            <div class="col-1 p-0 m-0 mb-1 text-start">
              C++
            </div>
            <span class="p-0 progress ms-auto" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="50% of your participations are tagged as C++">
              <div class="progress-bar p-0 m-0" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
            </span>
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
            <span class="p-0 progress ms-auto" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="41% of your participations are tagged as C">
              <div class="progress-bar p-0 m-0" role="progressbar" style="width: 41%;" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100">41%</div>
            </span>
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
            <span class="p-0 progress ms-auto" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="25% of your participations are tagged as Git">
              <div class="progress-bar p-0 m-0" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </span>
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
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Top Posts</h5>
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
    <!-- END ACTIVITY TAB -->
    <!-- BEGIN ACHIEVEMENTS TAB -->
    <div id="achievements-tab" class="tab-pane fade">
      <div class="container-fluid themed-container text-left">
        <h5 class="m-0 p-1">Achievements</h5>
      </div>
      <div class="container d-flex flex-wrap justify-content-center mt-3">
        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>First Question</b></h6>
              <p class="text-start fs-7 p-0">Make your first question</p>
          </div>
        </div>
        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class=""><b>20 Upvotes</b></h6>
              <p class="fs-7 p-0">Get 20 upvotes on a question or answer</p>
          </div>
        </div>
        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>Top answer</b></h6>
              <p class="text-start fs-7 p-0">Get your answer chosen by the owner of a question</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class=""><b>50 Upvotes</b></h6>
              <p class="text-start fs-7 p-0">Get 50 score points</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>First Comment</b></h6>
              <p class="text-start fs-7 p-0">Make your first comment</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>50 Upvotes</b></h6>
              <p class="text-start fs-7 p-0">Get 20 upvotes on a question or answer</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>5 Top answers</b></h6>
              <p class="text-start fs-7 p-0">Get 5 of your answer chosen by the owner of a question</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>100 Score</b></h6>
              <p class="text-start fs-7 p-0">Get 100 score points</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border border-success rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>First Answer</b></h6>
              <p class="text-start fs-7 p-0">Make your first answer</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>100 Upvotes</b></h6>
              <p class="text-start fs-7 p-0">Get 100 upvotes on a question or answer</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>15 Top answers</b></h6>
              <p class="text-start fs-7 p-0">Get 15 of your answer chosen by the owner of a question</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>200 Score</b></h6>
              <p class="text-start fs-7 p-0">Get 200 score points</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border border-success rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>First Vote</b></h6>
              <p class="text-start fs-7 p-0">Make your first vote on a question or answer</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>200 Upvotes</b></h6>
              <p class="text-start fs-7 p-0">Get 200 upvotes on a question or answer</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded border-success m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>30 Top answers</b></h6>
              <p class="text-start fs-7 p-0">Get 30 of your answer chosen by the owner of a question</p>
          </div>
        </div>

        <div class="container-fluid row align-items-center border rounded m-1 p-1 bg-dark" style="max-width: 20em;">
          <div class="col-3 text-start ps-2">
            <img src="/static/images/trophy.jpg" class="rounded achievement-logo" width="100%" alt="trophy-logo">
          </div>
          <div class="col-9 col-xs-7 align-middle text-start text-wrap lh-sm">
              <h6 class="text-start"><b>450 Score</b></h6>
              <p class="text-start fs-7 p-0">Get 450 score points</p>
          </div>
        </div>
      </div>
    </div>
    <!-- END ACHIEVEMENTS TAB -->
  </div>
  <!-- END TAB CONTENTS -->

</main>

<?php
drawFooter();
?>
