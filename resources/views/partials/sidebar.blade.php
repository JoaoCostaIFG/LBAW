<?php

function genSidebarLink($href, $icon, $text)
{
    global $title;
    $is_selected = ($text === $title);
    ?>
  <li class="list-group-item<?php if ($is_selected) { echo ' active'; 
                            }?>">
    <a href=<?php echo $href; ?>>
      <i class=<?php echo '"bi ' . $icon . '"'; ?>></i>
      <?php
        if ($is_selected) { echo '<b>';
        }
        echo " " . $text;
        if ($is_selected) { echo '</b>';
        }
        ?>
    </a>
  </li>
<?php } ?>

<?php function unauthSidebar()
{
    global $title;
    ?>

  <!-- Sidebar -->
  <nav id="sidebar" class="bg-dark text-light" tabindex="0">
    <div class="sidebar-header">
      <h3><?php echo $title; ?></h3>
    </div>

    <div class="sidebar-subheader">
      <h4>Pages</h4>
    </div>
    <ul class="list-group">
      <?php genSidebarLink(url('home'), "bi-house-door", "Home") ?>
      <?php genSidebarLink("/pages/search_results.php#questions", "bi-question-circle", "Questions") ?>
      <?php genSidebarLink("/pages/news.php", "bi-newspaper", "News") ?>
      <?php genSidebarLink("/pages/search_results.php#users", "bi-person", "Users") ?>
      <?php genSidebarLink(url('leaderboard'), "bi-trophy", "Leaderboard") ?>
      <?php genSidebarLink("/pages/about.php", "bi-info-circle", "About") ?>
    </ul>

    <!-- auth -->
    <div class="row justify-content-evenly sidebar-buttons">
      <button class="btn btn-info col-4" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open login box">
        Log in
      </button>
      <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
        Sign up
      </button>
    </div>
  </nav>

<?php } ?>

<?php function authSidebar()
{
    global $title;
    ?>

  <!-- Sidebar -->
  <nav id="sidebar" class="bg-dark text-light" tabindex="0">
    <div class="sidebar-header">
      <h3><?php echo $title; ?></h3>
    </div>

    <div class="sidebar-subheader">
      <h4>Pages</h4>
    </div>
    <ul class="list-group">
      <?php genSidebarLink(url('home'), "bi-house-door", "Home") ?>
      <?php genSidebarLink("/pages/search_results.php#questions", "bi-question-circle", "Questions") ?>
      <?php genSidebarLink("/pages/news.php", "bi-newspaper", "News") ?>
      <?php genSidebarLink("/pages/search_results.php#users", "bi-person", "Users") ?>
      <?php genSidebarLink(url('leaderboard'), "bi-trophy", "Leaderboard") ?>
      <?php genSidebarLink(url('about'), "bi-info-circle", "About") ?>
      <?php genSidebarLink("/pages/administration.php", "bi-clipboard-data", "Administration") ?>
    </ul>

    <!-- auth -->
    <div class="sidebar-subheader">
      <h4>
        <img src="/static/images/a.jpg" class="rounded" width="32" alt="user-pic">
        JoaoCostaIFG
        <button type="button" class="btn btn-dark" id="notifications-btn">
          <i class="bi bi-bell"></i>
        </button>
      </h4>
    </div>
    <ul class="list-group">
      <?php genSidebarLink("/pages/profile.php", "bi-person-circle", "My Profile") ?>
      <?php genSidebarLink("/pages/add_question.php", "bi-plus-circle", "Ask Question") ?>
    </ul>

    <div class="row justify-content-evenly sidebar-buttons">
      <button class="btn btn-danger col-4" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
        Sign up
      </button>
    </div>
  </nav>

<?php }

function draw_notifications()
{
    ?>

  <div class="container-fluid p-3" id="toast-container" style="z-index: 5;">
    <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-exclamation-circle-fill p-1"></i>
        <strong class="me-auto">New Vote</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        PantufaRGB has upvoted to your question.
      </div>
    </div>
    <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-exclamation-circle-fill p-1"></i>
        <strong class="me-auto">New Reply</strong>
        <small>34 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        PantufaRGB has repied to your question.
      </div>
    </div>
  </div>

  <script src="/js/notifications.js"></script>

    <?php
}

// Draw notifications

if (Auth::check())
    authSidebar();
else
    unauthSidebar();
?>

<script defer>
    document.querySelector("#sidebar-toggler").addEventListener("click", function() {
        let sidebar = document.querySelector("#sidebar");
        if (sidebar.classList.contains("active"))
        sidebar.classList.remove("active");
        else
        sidebar.classList.add("active");
    })
</script>

<!-- Notifications -->
<?php draw_notifications();