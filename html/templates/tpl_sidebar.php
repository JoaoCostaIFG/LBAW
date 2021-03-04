<?php function genSidebarLink($href, $icon, $text)
  {
    global $title;
    ?>
  <li>
    <a href=<?php echo $href; ?>>
      <i class=<?php echo '"bi ' . $icon . '"'; ?>></i>
      <?php
        if ($text === $title) echo '<b>';
        echo " " . $text;
        if ($text === $title) echo '</b>';
      ?>
    </a>
  </li>
<?php } ?>

<!-- Sidebar -->
<nav id="sidebar" class="bg-dark text-light" tabindex="0">
  <div class="sidebar-header"><h3>Sidebar</h3></div>

  <div class="sidebar-subheader"><h4>Pages</h4></div>
  <ul class="list-unstyled">
    <?php genSidebarLink("/pages/home.php", "bi-house-door", "Home") ?>
    <?php genSidebarLink("/pages/search_results.php", "bi-question-circle", "Question") ?>
    <?php genSidebarLink("/pages/news.php", "bi-newspaper", "News") ?>
    <?php genSidebarLink("/pages/search_results.php", "bi-person", "Users") ?>
    <?php genSidebarLink("/pages/search_results.php", "bi-trophy", "Leaderboard") ?>
    <?php genSidebarLink("/pages/about.php", "bi-info-circle", "About") ?>
  </ul>

  <!-- auth -->
  <div class="sidebar-subheader"><h4>User</h4></div>
  <ul class="list-unstyled">
    <?php genSidebarLink("/pages/home.php", "bi-house-door", "Home") ?>
  <div class="row justify-content-evenly">
    <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open login box">
      Login
    </button>
    <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
      Sign up
    </button>
  </div>
  <!-- Needed for full vertical scroll -->
  <br>
  <br>
  <br>
</nav>

<script defer>
document.querySelector("#sidebar-toggler").addEventListener("click", function(){
  let sidebar = document.querySelector("#sidebar");
  if (sidebar.classList.contains("active"))
    sidebar.classList.remove("active");
  else
    sidebar.classList.add("active");

  // let toggler = document.querySelector("#sidebar-toggler");
  // if (toggler.classList.contains("active"))
    // toggler.classList.remove("active");
  // else
    // toggler.classList.add("active");
})
</script>
