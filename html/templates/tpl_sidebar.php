<!-- Sidebar -->
<nav id="sidebar" class="bg-dark text-light">
  <div class="sidebar-header"><h3>Sidebar</h3></div>

  <div class="sidebar-subheader"><h4>Pages</h4></div>
  <ul class="list-unstyled">
    <li><a href="/pages/home.php"><i class="bi bi-house-door"></i> Home</a></li>
    <li><a href="/pages/search_results.php"><i class="bi bi-question-circle"></i> Question</a></li>
    <li><a href="/pages/news.php"><i class="bi bi-newspaper"></i> News</a></li>
    <li><a href="/pages/search_results.php"><i class="bi bi-person"></i> Users</a></li>
    <li><a href="/pages/search_results.php"><i class="bi bi-trophy"></i> Leaderboard</a></li>
    <li><a href="/pages/about.php"><i class="bi bi-info-circle"></i> About</a></li>
  </ul>

  <!-- auth -->
  <div class="sidebar-subheader"><h4>User</h4></div>
  <ul class="list-unstyled">
    <li><a href="/pages/home.php"><i class="bi bi-house-door"></i> Home</a></li>
  </ul>
  <div class="row justify-content-evenly">
    <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open login box">
      Login
    </button>
    <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
      Sign up
    </button>
  </div>
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
