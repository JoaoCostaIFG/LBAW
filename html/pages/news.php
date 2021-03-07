<?php
require_once '../templates/tpl_header.php';
require_once '../templates/tpl_footer.php';

$title="News";
drawHeader($title);
?>

  <main class="container">
    <h1 class="page-title">News</h1>

    <!-- START FEATURETTES -->
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-10">
        <h2 class="featurette-heading">We've reached 1000 members. <span class="text-muted">Our community keeps growing.</span></h2>
        <p class="lead">The number of questions, answers and users keeps growing thanks to all of you.</p>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-10">
        <h2 class="featurette-heading">We've reached 100 members. <span class="text-muted">Our community is growing.</span></h2>
        <p class="lead">Thank you everyone from trusting us.</p>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-10">
        <h2 class="featurette-heading">Hello and welcome. <span class="text-muted">The website is open.</span></h2>
        <p class="lead">You can now join and use our community.</p>
      </div>
    </div>

    <hr class="featurette-divider">
    <!-- END FEATURETTES -->
  </main>

<?php
drawFooter();
?>
