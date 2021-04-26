<?php
require_once '../templates/tpl_header.php';
require_once '../templates/tpl_footer.php';

$title = "Administration";
drawHeader($title);
?>

<main class="container">
  <h2 class="page-title">Administration</h2>
  <div class="accordion mt-4" id="accordionAdmin">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTopic">
        <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopic" aria-expanded="true" aria-controls="collapseTopic">
          Topic Proposals
        </button>
      </h2>
      <div id="collapseTopic" class="accordion-collapse collapse show" aria-labelledby="headingTopic" data-bs-parent="#accordionAdmin">
        <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">

        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingUser">
        <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
          User Reports
        </button>
      </h2>
      <div id="collapseUser" class="accordion-collapse collapse" aria-labelledby="headingUser" data-bs-parent="#accordionAdmin">
        <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">

        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingModerator">
        <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModerator" aria-expanded="false" aria-controls="collapseModerator">
          Moderator Reports
        </button>
      </h2>
      <div id="collapseModerator" class="accordion-collapse collapse" aria-labelledby="headingModerator" data-bs-parent="#accordionAdmin">
        <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">
          <div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
  
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  drawFooter();
  ?>