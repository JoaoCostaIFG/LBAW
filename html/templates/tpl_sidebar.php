<?php
require_once '../templates/tpl_notifications.php';

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
      <?php genSidebarLink("/pages/home.php", "bi-house-door", "Home") ?>
      <?php genSidebarLink("/pages/search_results.php#questions", "bi-question-circle", "Questions") ?>
      <?php genSidebarLink("/pages/news.php", "bi-newspaper", "News") ?>
      <?php genSidebarLink("/pages/search_results.php#users", "bi-person", "Users") ?>
      <?php genSidebarLink("/pages/leaderboard.php", "bi-trophy", "Leaderboard") ?>
      <?php genSidebarLink("/pages/about.php", "bi-info-circle", "About") ?>
    </ul>

    <!-- auth -->
    <div class="row justify-content-evenly sidebar-buttons">
      <button class="btn btn-info col-4" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open login box">
        Login
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
      <?php genSidebarLink("/pages/home.php", "bi-house-door", "Home") ?>
      <?php genSidebarLink("/pages/search_results.php#questions", "bi-question-circle", "Questions") ?>
      <?php genSidebarLink("/pages/news.php", "bi-newspaper", "News") ?>
      <?php genSidebarLink("/pages/search_results.php#users", "bi-person", "Users") ?>
      <?php genSidebarLink("/pages/leaderboard.php", "bi-trophy", "Leaderboard") ?>
      <?php genSidebarLink("/pages/about.php", "bi-info-circle", "About") ?>
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

<?php } ?>

<?php function drawSidebar()
{
    global $is_auth;
    if ($is_auth)
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
} ?>
