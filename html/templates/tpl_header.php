<?php
require_once '../templates/tpl_sidebar.php';

function drawHeader($title)
{
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap (must come before all other stylesheets) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/tagsinput.css">

    <title><?php if (isset($title)) {
              echo $title . ' | ';
            } ?>Segmentation Fault</title>
  </head>

  <body>
    <header>
      <nav class="navbar fixed-top navbar-expand bg-dark navbar-dark">
        <div class="container d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <button id="sidebar-toggler" class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-brand">
              <a href="/pages/home.php">Segmentation <b>fault</b></a>
              <i class="bi bi-cpu"></i>
              <?php echo $title; ?>
            </div>
          </div> <!-- .d-flex -->
          <!-- search -->
          <div id="searchModal-toggler">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#searchModal">
              <i class="bi-search"></i>
            </button>
          </div>
          <form id="navbarSeachForm" class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class="bi-search"></i></button>
          </form>
        </div> <!-- .container .d-flex -->
      </nav>
    </header>

    <!-- BEGIN SEARCH MODAL -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- bg-dark -->
          <div class="modal-body">
            <form>
              <!-- button is not needed -->
              <!--
            <button class="btn btn-outline-success" type="submit"><i class="bi-search"></i></button>
            -->
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END SEARCH MODAL -->

    <!-- BEGIN AUTH MODALS -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="loginModalLabel">Login</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Login form -->
          <form action="">
            <div class="modal-body">
              <!-- Email -->
              <div class="input-group mb-3">
                <label for="email" class="form-label"><b>Email</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="email" placeholder="Enter email... (ex: email@example.com)" required>
                  <div class="invalid-feedback">
                    Email is required.
                  </div>
                </div>
              </div>
              <!-- Password -->
              <div class="input-group mb-3">
                <label for="password" class="form-label"><b>Password</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="password" placeholder="Enter password..." required>
                  <div class="invalid-feedback">
                    Password is required.
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">LogIn</button>
            </div>
          </form>
          <script src="/js/form-validation.js"></script>
        </div>
      </div>
    </div>
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="signupModalLabel">Signup</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Sign Up Form -->
          <form action="">
            <div class="modal-body">
              <!-- Email -->
              <div class="input-group mb-3">
                <label for="email" class="form-label"><b>Email</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="email" placeholder="Enter email... (ex: email@example.com)" required>
                  <div class="invalid-feedback">
                    Email is required.
                  </div>
                </div>
              </div>
              <!-- Username -->
              <div class="input-group mb-3">
                <label for="username" class="form-label"><b>Username</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="username" placeholder="Enter username... (ex: user123)" required>
                  <div class="invalid-feedback">
                    Username is required.
                  </div>
                </div>
              </div>
              <!-- Password -->
              <div class="input-group mb-3">
                <label for="password" class="form-label"><b>Password</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="password" placeholder="Enter password..." required>
                  <div class="invalid-feedback">
                    Password is required.
                  </div>
                </div>
              </div>
              <!-- Repeated Password -->
              <div class="input-group">
                <label for="repeated_password" class="form-label"><b>Repeat Password</b><span class="text-danger"> *</span></label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="repeated_password" placeholder="Enter password again..." required>
                  <div class="invalid-feedback">
                    Repeated password is required.
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">SignUp</button>
            </div>
          </form>
          <script src="/js/form-validation.js"></script>
        </div>
      </div>
    </div>
    <!-- END AUTH MODALS -->

  <?php
  drawSidebar();
}?>
