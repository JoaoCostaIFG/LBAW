<nav id="sidebar" class="bg-dark text-light" tabindex="0">
    <div class="sidebar-header">
      <h3>{{ $title }}</h3>
    </div>

    <div class="sidebar-subheader">
      <h4>Pages</h4>
    </div>
    <ul class="list-group">
        @include('partials.sidebar.sidebar_link', ['href' => "/home", 'icon' => "bi-house-door", 'text' =>  "Home"])
        @include('partials.sidebar.sidebar_link', ['href' => "/pages/search_results.php#questions", 'icon' => "bi-question-circle", 'text' =>  "Questions"])
        @include('partials.sidebar.sidebar_link', ['href' => "/news", 'icon' => "bi-newspaper", 'text' =>  "News"])
        @include('partials.sidebar.sidebar_link', ['href' => "/pages/search_results.php#users", 'icon' => "bi-person", 'text' =>  "Users"])
        @include('partials.sidebar.sidebar_link', ['href' => "/leaderboard", 'icon' => "bi-trophy", 'text' =>  "Leaderboard"]) {{-- Only autheticated????? --}}
        @include('partials.sidebar.sidebar_link', ['href' => "/about", 'icon' => "bi-info-circle", 'text' =>  "About"])
        {{-- @auth('admin') --}}
        @auth
            @include('partials.sidebar.sidebar_link', ['href' => "/pages/administration.php", 'icon' => "bi-clipboard-data", 'text' =>  "Administration"])
        @endauth
        {{-- @endauth --}}
    </ul>

    <!-- auth -->
    @guest
        <div class="row justify-content-evenly sidebar-buttons">
        <button class="btn btn-info col-4" type="button" data-bs-toggle="modal" data-bs-target="#loginModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open login box">
          Log in
        </button>
        <button class="btn btn-primary col-4" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
          Sign up
        </button>
      </div>
    @endguest

    @auth
    <div class="sidebar-subheader">
        <h4>
        {{-- TODO --}}
          <img src="/static/images/a.jpg" class="rounded" width="32" alt="user-pic">
          {{ Auth::user()->username }}
          <button type="button" class="btn btn-dark" id="notifications-btn">
            <i class="bi bi-bell"></i>
          </button>
        </h4>
      </div>
      <ul class="list-group">
          @include('partials.sidebar.sidebar_link', ['href' => "/pages/profile.php", 'icon' => "bi-person-circle", 'text' =>  "My Profile"])
          @include('partials.sidebar.sidebar_link', ['href' => "/pages/add_question.php", 'icon' => "bi-plus-circle", 'text' =>  "Ask Question"])
      </ul>

      <div class="row justify-content-evenly sidebar-buttons">
        <a class="btn btn-danger col-4" href="/logout">Logout</a>
    </div>
    @endauth

</nav>


<?php
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
