<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap (must come before all other stylesheets) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/search_results.css">

    <title><?php if(isset($title)) {echo $title . ' | ';
           } ?>Segmentation Fault</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark"> <!-- TODO fixed-top -->
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="/pages/home.php">Segmentation <b>fault</b></a>
          <!-- collapse -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="/pages/home.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="/pages/question.php">Questions</a></li>
              <li class="nav-item"><a class="nav-link" href="#">News</a></li>
              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
              <!-- auth -->
              <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Toggle Login">Login</button>
            </ul>
          </div>
          <!-- search -->
          <form class="d-flex">
            <button class="btn btn-outline-success me-2" type="submit"><i class="bi-search"></i></button>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          </form>
        </div>
      </nav>

      <!-- Login and Signup Modals -->
      <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loginModalLabel">Login</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Form here</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">LogIn</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">Signup</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">Form here</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">SignUp</button>
          </div>
          </div>
        </div>
      </div>
    </header>
