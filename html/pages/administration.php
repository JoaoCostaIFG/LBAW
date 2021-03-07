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

          <div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
            <div class="row align-items-center p-3">
              <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
                <img src="/static/images/user.png" class="rounded img-fluid align-middle" width="120" alt="user-pic">
                <h5 class="fs-5">Rickardo Fontalhao</h5>
                <h6 class="fs-7">cesarioverde909</h6>
              </div>

              <div class="col text-start align-middle">
                <h6 class="fs-5"><i>Proposed topic <b>Sheldon from BBT</b></i></h6>
                <h6 class="fs-5"><i><b>For the reason</b></i></h6>
                <p class="ms-3 fs-7">I think that the bazinga wisdom can be very helpful to people</p>

                <div class="row align-items-center">
                  <b class="col fs-5">Accept new topic?</b>
                  <span class="col-5 col-sm-4 text-end">
                    <button type="button" class="btn btn-sm btn-success mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-x"></i>
                    </button>
                  </span>
                </div> <!-- .row -->
              </div> <!-- .col -->
            </div> <!-- .row -->
          </div>
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

          <div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
            <div class="row align-items-center p-3">
              <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
                <img src="/static/images/user.png" class="rounded img-fluid align-middle" width="120" alt="user-pic">
                <h5 class="fs-5">João Costa</h5>
                <h6 class="fs-7">PantufaRGB</h6>
              </div>

              <div class="col text-start align-middle">
                <h6 class="text-start fs-5"><i><b>Said</b></i></h6>
                <p class="text-start ms-3 fs-7">You suck!</p>
                <h6 class="text-start fs-5"><i><b>In Question</b></i></h6>
                <p class="text-start ms-3 fs-7">Why is processing a sorted array faster than processing an unsorted array?</p>

                <div class="row align-items-center">
                  <b class="col fs-5">Ban User?</b>
                  <span class="col-5 col-sm-4 text-end">
                    <button type="button" class="btn btn-sm btn-success mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-x"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="container-fluid border rounded m-3 m-sm-1 p-1" style="max-width: 35em;">
            <div class="row align-items-center p-3">
              <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
                <img src="/static/images/user.png" class="rounded img-fluid align-middle" width="120" alt="user-pic">
                <h5 class="fs-5">Ana Barros</h5>
                <h6 class="fs-7">ananachos</h6>
              </div>

              <div class="col text-start align-middle">
                <h6 class="text-start fs-5"><i><b>Said</b></i></h6>
                <p class="text-start fs-7">Where can i find cat photos? </p>
                <h6 class="text-start fs-5"><i><b>In Question</b></i></h6>
                <p class="text-start fs-7">How can I create multidimensional arrays of arbitrary sizes?</p>

                <div class="row align-items-center">
                  <b class="col fs-5">Ban User?</b>
                  <span class="col-5 col-sm-4 text-end">
                    <button type="button" class="btn btn-sm btn-success mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-x"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>

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
            <div class="row align-items-center p-3">
              <div class="col-12 col-sm-5 align-middle text-center mb-3 mb-sm-0">
                <img src="/static/images/user.png" class="rounded img-fluid align-middle" width="120" alt="user-pic">
                <h5 class="fs-5">Lucas Martins</h5>
                <h6 class="fs-7">Lucas123</h6>
              </div>

              <div class="col text-start align-middle">
                <h6 class="fs-5"><i>Banned <b>Bazinga201</b> for saying</i></h6>
                <p class="ms-3 fs-7">I think that is not correct</p>
                <h6 class="fs-5"><i><b>In Question</b></i></h6>
                <p class="ms-3 fs-7">How do I delete a Git branch locally and remotely?</p>

                <div class="row align-items-center">
                  <b class="col fs-5">Revoke moderator?</b>
                  <span class="col-5 col-sm-4 text-end">
                    <button type="button" class="btn btn-sm btn-success mx-2" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mx-2" data-bs-toggle="button" autocomplete="off">
                      <i class="bi bi-x"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
    drawFooter();
    ?>
