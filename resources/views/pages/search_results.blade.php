@extends('layouts.layout')

@section('title', 'Search Results')
    
@section('content')

<!-- Page Top -->
<div class="container">
  <h2 class="page-title"> Search Results </h2>
  <div class="py-3 border-bottom pb-0">
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
      <?php
      $username = 'Ferro Gamer';
      $user_points = 3;
      $votes = 4;
      $answers = 9;
      $question_title = 'Error including library in Zig';
      $question_description = 'Hello!
  I am having trouble including a C library in my zig project.
  I followed the wiki guides and I can compile the code, but everytime I try using the
  library in the code I get thousands of "undefined symbol" errors...';
      $question_tags = ['zig'];
      $days = 3;
      drawQuestionCard($username, $user_points, $votes, $answers, $question_title, $question_description, $question_tags, $days);

      $username = 'ZigDevBoo';
      $user_points = 15;
      $votes = 12;
      $answers = 2;
      $question_title = 'How to print current path in Zig';
      $question_description = 'How do I print the current directory in Zig? So far I have: const std = @import("std"); var arena= std.heap.ArenaAllocator.init(std.heap.page_allocator); const alloc = &arena.allocator;... ';
      $question_tags = ['zig'];
      $days = 4;

      drawQuestionCard($username, $user_points, $votes, $answers, $question_title, $question_description, $question_tags, $days);
      ?>

    </div>
    <!-- Users -->
    <div class="tab-pane fade" id="users">
      @foreach ($users as $user)
        @include('partials.search_results.user_card', ['index' => $loop->index])
      @endforeach
    </div>
  </div>
</div>

<script src="/js/tabs.js"></script>
@stop

<?php
function drawQuestionCard($username, $user_points, $votes, $answers, $question_title, $question_description, $question_tags, $days)
{
?>
  <!-- Question Card -->
  <div class="d-flex flex-sm-row flex-column-reverse justify-content-start align-items-center gap-3 w-100 border p-3">
    <div class="d-flex flex-sm-column flex-row justify-content-start align-items-center gap-1 ">
      <!-- Number Votes -->
      <div class="d-flex flex-sm-column flex-row justify-content-center align-items-center gap-1">
        <span class="fs-4"><?php echo $votes; ?></span>
        <span>Votes</span>
        <span class="d-sm-none"><i class="bi bi-arrow-down-up"></i></span>
      </div>
      <!-- Number Answers -->
      <div class="d-flex  flex-sm-column flex-row justify-content-center align-items-center gap-1">
        <span class="fs-4"><?php echo $answers; ?></span>
        <span>Answers</span>
        <span class="d-sm-none"><i class="bi bi-chat-left-text"></i></span>
      </div>
    </div>
    <div class="d-flex flex-column justify-content-start align-items-start w-100">
      <!-- Question Text -->
      <section>
        <a class="fs-5 fw-bold" href="/pages/question_admin.php"><?php echo $question_title; ?></a>
        <p class="d-none d-md-block">
          <?php echo $question_description; ?>
        </p>
      </section>
      <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
        <!-- Question Tags -->
        <div class="d-none d-sm-block d-grid gap-1 mt-0">
          <?php
          foreach ($question_tags as $tag) { ?>
            <a class="badge bg-primary text-decoration-none"><?php echo $tag;
                                                            } ?></a>
        </div>
        <!-- Question Date -->
        <div class="d-flex flex-row gap-2 align-items-center">
          <span class="align-self-end">Posted <?php echo $days; ?> days ago</span>
          <!-- Author User Info -->
          <!-- User Profile Pic  -->
          <img class="d-none d-md-block rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="40px" height="40px">
          <div class="d-flex flex-row flex-md-column justify-content-center align-items-start">
            <!-- Username -->
            <span class="d-md-none">by&nbsp;</span>
            <a href="/pages/profile.php"><?php echo $username; ?></a>
            <!-- User Points -->
            <span class="d-none d-md-block"><?php echo $user_points; ?> <i class="bi bi-award"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
} ?>