<?php
$title = "Search Results";
require_once '../templates/tpl_header.php';
?>

<!-- Page Top -->
<div class="container">
  <div class="py-3 border-bottom pb-0">
    <h2> Search Results </h2>
    <div class="d-flex flex-row align-items-center justify-content-between">
      <!-- Number of Results -->
      <h6 class="m-0 d-none d-md-block">50 results</h6>
      <!-- Tabs -->
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#questions" class="nav-link active" data-toggle="tab">Questions</a>
        </li>
        <li class="nav-item">
          <a href="#users" class="nav-link" data-toggle="tab">Users</a>
        </li>
      </ul>
      <!-- Sort by-->
      <ul class="nav nav-pills">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown" href="#" role="button">
            <span class="d-none d-sm-block">Sort by</span>
            <i class="bi bi-filter-right"></i></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Date</a></li>
            <li><a class="dropdown-item" href="#">Votes</a></li>
            <li><a class="dropdown-item" href="#">Popularity</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="tab-content">
    <!-- Questions Tab -->
    <div class="tab-pane fade show active" id="questions">
    <!-- Question Card -->
      <div class="d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center gap-3 w-100 border p-3">
        <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1 ">
          <!-- Number Votes -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
            <span class="fs-4">4</span>
            <span>Votes</span>
            <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
          </div>
          <!-- Number Answers -->
          <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
            <span class="fs-4">9</span>
            <span>Answers</span>
            <span class="d-sm-none"><i class="bi bi-chat-left-text"></i></span>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-start align-items-start w-100">
          <!-- Question Text -->
          <div>
            <a class="fs-5 fw-bold" href="/pages/question.php">Error including library in Zig</a>
            <p class="d-none d-md-block">
              Hello!
              I am having trouble including a C library in my zig project.
              I followed the wiki guides and I can compile the code, but everytime I try using the
              library in the code I get thousands of "undefined symbol" errors...
            </p>
          </div>
          <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
            <!-- Question Tags -->
            <div class="d-none d-sm-block d-grid gap-1 mt-0">
              <a class="badge bg-primary text-decoration-none">zig</a>
            </div>
            <!-- Question Date -->
            <div class="d-flex flex-row gap-2 align-items-center">
              <span class="align-self-end">Posted 3 days ago</span>
              <!-- Author User Info -->
              <!-- User Profile Pic  -->
              <img class="d-none d-md-block rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="40px" height="40px">
              <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
                <!-- Username -->
                <span class="d-md-none">by&nbsp;</span>
                <a href="/pages/profile.php">Ferro Gamer</a>
                <!-- User Points -->
                <span class="d-none d-md-block">3 <i class="bi bi-award"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Question Card -->
      <div class="d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center gap-3 w-100 border p-3">
        <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1 ">
          <!-- Number Votes -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
            <span class="fs-4">12</span>
            <span>Votes</span>
            <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
          </div>
          <!-- Number Answers -->
          <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
            <span class="fs-4">2</span>
            <span>Answers</span>
            <span class="d-sm-none"><i class="bi bi-chat-left-text"></i></span>
          </div>
        </div>
        <div class="d-flex flex-column justify-content-start align-items-start w-100">
          <!-- Question Text -->
          <div>
            <a class="fs-5 fw-bold" href="/pages/question.php">How to print current path in Zig</a>
            <p class="d-none d-md-block">
              How do I print the current directory in Zig? So far I have: const std = @import("std");
              var arena= std.heap.ArenaAllocator.init(std.heap.page_allocator); const alloc = &arena.allocator;...
            </p>
          </div>
          <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
            <!-- Question Tags -->
            <div class="d-none d-sm-block d-grid gap-1 mt-0">
              <a class="badge bg-primary text-decoration-none">zig</a>
            </div>
            <!-- Question Date -->
            <div class="d-flex flex-row gap-2 align-items-center">
              <span class="align-self-end">Posted 4 days ago</span>
              <!-- Author User Info -->
              <!-- User Profile Pic  -->
              <img class="d-none d-md-block rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="40px" height="40px">
              <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
                <!-- Username -->
                <span class="d-md-none">by&nbsp;</span>
                <a href="/pages/profile.php">ZigDevBoo</a>
                <!-- User Points -->
                <span class="d-none d-md-block">15 <i class="bi bi-award"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Users -->
    <div class="tab-pane fade" id="users">
      <!-- Row Users -->
      <div class="row p-2 gap-2">
        <!-- User Card -->
        <div class=" border col-md d-flex flex-row justify-content-between">
          <div class=" p-3 d-flex flex-row gap-2">
            <img class="rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="70px" height="70px">
            <div class="d-flex flex-column justify-content-center align-items-start">
              <!-- Username -->
              <span class="fs-5">Smart Guy</span>
              <a href="/pages/profile.php">SmartGuy1</a>
            </div>
          </div>
          <!-- User Points -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
            <span class="fs-5">355</span>
            <span class="d-none d-sm-block">Points</span>
            <span class="d-sm-none"><i class="bi bi-award"></i></span>
          </div>
        </div>
        <!-- User Card -->
        <div class=" border col-md d-flex flex-row justify-content-between">
          <div class=" p-3 d-flex flex-row gap-2">
            <img class="rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="70px" height="70px">
            <div class="d-flex flex-column justify-content-center align-items-start">
              <!-- Username -->
              <span class="fs-5">Get a log</span>
              <a href="/pages/profile.php">log10</a>
            </div>
          </div>
          <!-- User Points -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
            <span class="fs-5">59</span>
            <span class="d-none d-sm-block">Points</span>
            <span class="d-sm-none"><i class="bi bi-award"></i></span>
          </div>
        </div>
      </div>
      <!-- Row Users -->
      <div class="row p-2 gap-2">
        <!-- User Card -->
        <div class=" border col-md d-flex flex-row justify-content-between">
          <div class=" p-3 d-flex flex-row gap-2">
            <img class="rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="70px" height="70px">
            <div class="d-flex flex-column justify-content-center align-items-start">
              <!-- Username -->
              <span class="fs-5">Bazinga</span>
              <a href="/pages/profile.php">bazinga201</a>
            </div>
          </div>
          <!-- User Points -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
            <span class="fs-5">466</span>
            <span class="d-none d-sm-block">Points</span>
            <span class="d-sm-none"><i class="bi bi-award"></i></span>
          </div>
        </div>
        <!-- User Card -->
        <div class=" border col-md d-flex flex-row justify-content-between">
          <div class=" p-3 d-flex flex-row gap-2">
            <img class="rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="70px" height="70px">
            <div class="d-flex flex-column justify-content-center align-items-start">
              <!-- Username -->
              <span class="fs-5">Minecraft Site</span>
              <a href="/pages/profile.php">BlocoDeMad</a>
            </div>
          </div>
          <!-- User Points -->
          <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center p-3">
            <span class="fs-5">52</span>
            <span class="d-none d-sm-block">Points</span>
            <span class="d-sm-none"><i class="bi bi-award"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/tabs.js"></script>


<?php
require_once '../templates/tpl_footer.php';
?>