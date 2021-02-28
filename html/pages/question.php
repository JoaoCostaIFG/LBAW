<?php
$title="Question";
require_once '../templates/tpl_header.php';
?>

  <h1>Title</h1>

  <div class="container">
    <div class="row">
      <div class="col col-1 p-0 align-self-center fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="d-block text-center">4</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="col col-3 p-0 align-self-center">
        <img src="../static/images/a.jpg" class="img-thumbnail d-block" alt="">
        <a class="d-block text-center">FerroGamer</a>
        <span class="d-block text-center">3 Points</span>
      </div>
      <div class="col col-8">
        <p class="text-break">Hello! I am having troubles including a C library in my zig project. I followed the wiki
          guides and I can compile the code, but everytime I try using the library in the code I get thousands of
          "undefined symbol" errors. The library I'm trying to use if: stb_image.h. I will leave my build.zig and the
          section where the lib is imported and used bellow. Thank you for any help!</p>
      </div>
    </div>
    <div class="row m-0 p-0 ">
      <p class="text-muted text-end">Posted 3 days ago</p>
    </div>
    <div class="row bg-light border border-secondary">
      <a class="col-4 text-center">Nachos</a>
      <p class="col-8">I have that problem too.</p>
    </div>
    <div class="row bg-light border border-secondary">
      <a class="col-4 text-center">Lucas123</a>
      <p class="col-8">Have you tried linking the object instead of the library code?</p>
    </div>
    <div class="row">
      <a class="text-center">Add comment</a>
    </div>
  </div>

  <hr>

  <div class="container">
    <div class="row">
      <div class="col col-1 p-0 align-self-center fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="text-center d-block">10</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="col col-3 p-0 align-self-center">
        <img src="../static/images/a.jpg" class="img-thumbnail d-block" alt="">
        <a class="d-block text-center">Fogão</a>
        <span class="d-block text-center">10 Points</span>
      </div>
      <div class="col col-8">
        <p class="text-break">stb_image is a famous library and known to have issues when passed through zig's
          translate_c. The best work around you can use right now is to compile the library using zig c and link it in
          your project in your build.zig. You can find an example on how to do this in this tetris clone written in zig.
        </p>
      </div>
    </div>
    <div class="row m-0 p-0 ">
      <p class="text-muted text-end">Posted 3 days ago</p>
    </div>
    <div class="row">
      <a class="text-center">Add comment</a>
    </div>
  </div>

  <hr>

  <div class="container">
    <div class="row">
      <div class="col col-1 p-0 align-self-center fs-3">
        <i class="bi bi-caret-up d-block text-center"></i>
        <span class="d-block text-center">1</span>
        <i class="bi bi-caret-down d-block text-center"></i>
      </div>
      <div class="col col-3 p-0 align-self-center">
        <img src="../static/images/a.jpg" class="img-thumbnail d-block" alt="">
        <a class="d-block text-center">Padoru</a>
        <span class="d-block text-center">10 Points</span>
      </div>
      <div class="col col-8">
        <p class="text-break">That seems to be a problem with zig's translate_c. You should check zig's github for
          issues relating to this and report it if you don't find any. In the mean time, you could try using a different
          library like sdl2_image.</p>
      </div>
    </div>
    <div class="row m-0 p-0 ">
      <p class="text-muted text-end">Posted 1 days ago</p>
    </div>
    <div class="row bg-light border border-secondary">
      <a class="col-4 text-center">Anon</a>
      <p class="col-8">Can you share the link?</p>
    </div>
    <div class="row">
      <a class="text-center">Add comment</a>
    </div>
  </div>

  <hr>
  <div class="container">
    <h2>Your reply</h2>
    <textarea class="form-control" id="Textarea" rows="7"></textarea>
    <label class="visually-hidden" for="Textarea">Reply</label>
    <button class="btn btn-primary">Submit reply</button>
  </div>

<?php
require_once '../templates/tpl_footer.php';
?>
