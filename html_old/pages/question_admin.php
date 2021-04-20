<?php
require_once '../templates/tpl_header.php';
require_once '../templates/tpl_footer.php';

$title = "Question";
drawHeader($title);
?>

<main class="container">
  <!-- Question -->
  <div class="row p-1">
    <h2 class="col-9 page-title">Error including library in Zig</h2>
    <button class="btn btn-outline-danger btn-sm col-3">Mark as duplicate</button>
    <hr>
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
      <div class="row fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="d-block text-center">4</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="row p-sm-3 p-0">
        <img src="../static/images/a.jpg" class="center p-2 p-sm-3" alt="">
        <a class="d-block text-center">FerroGamer</a> <!--  style="overflow:hidden; -->
        <span class="d-block text-center">3 Points</span>
      </div>
    </div>
    <div class="col col-md-10 col-9">
      <p class="text-break">Hello! I am having troubles including a C library in my zig project. I followed the wiki
        guides and I can compile the code, but everytime I try using the library in the code I get thousands of
        "undefined symbol" errors. The library I'm trying to use if: stb_image.h. I will leave my build.zig and the
        section where the lib is imported and used bellow. Thank you for any help!</p>
    </div>
    <div class="row m-0 p-0 ">
      <p class="text-muted text-end">Posted 3 days ago</p>
    </div>

    <!-- Comments -->
    <div class="container">
      <div class="comment row bg-dark border border-secondary align-items-center">
        <a class="col-4 text-center">Nachos</a>
        <p class="col-8">I have that problem too.</p>
      </div>
      <div class="comment row bg-dark border border-secondary align-items-center">
        <a class="col-4 text-center">Lucas123</a>
        <p class="col-8">Have you tried linking the object instead of the library code?</p>
      </div>

      <div class="row">
        <a class="text-center dropdown-toggle" data-bs-toggle="dropdown" id="commentDropdownLink" aria-expanded="false">
          Add comment
        </a>
        <div class="dropdown-menu" aria-labelledby="commentDropdownLink">
          <form class="container">
            <h2>Your Comment</h2>
            <textarea class="form-control" id="Textarea" rows="7"></textarea>
            <label class="visually-hidden" for="Textarea">Add comment</label>
            <button type="submit" class="btn btn-primary">Post Comment</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- Answers -->
  <hr>

  <div class="row py-2">
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
      <div class="row fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="d-block text-center">10</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="row p-sm-3 p-0">
        <img src="../static/images/a.jpg" class="center p-2 p-sm-3" alt="">
        <a class="d-block text-center">Fogão</a>
        <span class="d-block text-center">10 Points</span>
      </div>
    </div>
    <div class="col col-md-10 col-9">
      <p class="text-break">stb_image is a famous library and known to have issues when passed through zig's
        translate_c. The best work around you can use right now is to compile the library using zig c and link it in
        your project in your build.zig. You can find an example on how to do this in this tetris clone written in zig.
      </p>
    </div>

    <div class="row">
      <button type="button" class="btn btn-danger col-sm-2 offset-sm-7 col-4 offset-5 my-2">Delete</button>
      <p class="text-muted col-3 text-center m-0 align-self-center">Posted 1 day ago</p>
    </div>

    <div class="row">
      <a class="text-center dropdown-toggle" data-bs-toggle="dropdown" id="commentDropdownLink" aria-expanded="false">
        Add comment
      </a>
      <div class="dropdown-menu" aria-labelledby="commentDropdownLink">
        <form class="container">
          <h2>Your Comment</h2>
          <textarea class="form-control" id="Textarea" rows="7"></textarea>
          <label class="visually-hidden" for="Textarea">Add comment</label>
          <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
      </div>
    </div>

  </div>

  <hr>

  <div class="row py-2">
    <div class="col col-md-2 col-3 align-self-center border-end border-dark">
      <div class="row fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="d-block text-center">1</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="row p-sm-3 p-0">
        <img src="../static/images/a.jpg" class="center p-2 p-sm-3" alt="">
        <a class="d-block text-center">Padoru</a>
        <span class="d-block text-center">10 Points</span>
      </div>
    </div>
    <div class="col col-md-10 col-9">
      <p class="text-break">That seems to be a problem with zig's translate_c. You should check zig's github for
        issues relating to this and report it if you don't find any. In the mean time, you could try using a different
        library like sdl2_image.</p>
    </div>

    <div class="row">
      <button type="button" class="btn btn-danger col-sm-2 offset-sm-7 col-4 offset-5 my-2">Delete</button>
      <p class="text-muted col-3 text-center m-0 align-self-center">Posted 1 day ago</p>
    </div>

    <div class="container">
      <div class="comment row bg-dark border border-secondary align-items-center">
        <a class="col-4 text-center">Anon</a>
        <p class="col-8">Can you share the link?</p>
      </div>

      <div class="row">
        <a class="text-center dropdown-toggle" data-bs-toggle="dropdown" id="commentDropdownLink" aria-expanded="false">Add comment</a>
        <div class="dropdown-menu" aria-labelledby="commentDropdownLink">
          <form class="container">
            <h2>Your Comment</h2>
            <textarea class="form-control" id="Textarea" rows="7"></textarea>
            <label class="visually-hidden" for="Textarea">Add comment</label>
            <button type="submit" class="btn btn-primary">Post Comment</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <hr>
  <div class="container">
    <h2>Your reply</h2>
    <textarea class="form-control" id="Textarea" rows="7"></textarea>
    <label class="visually-hidden" for="Textarea">Reply</label>
    <button class="btn btn-primary">Submit reply</button>
  </div>
  </div>

  <?php
  drawFooter();
  ?>
