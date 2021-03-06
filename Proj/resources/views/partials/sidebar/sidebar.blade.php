<nav id="sidebar" class="bg-dark text-light" tabindex="0">
    <div class="sidebar-header">
      <h3>{{ $title }}</h3>
    </div>

    <div class="sidebar-subheader">
      <h4>Pages</h4>
    </div>
    <ul class="list-group">
        @include('partials.sidebar.sidebar_link', ['href' => "/home", 'icon' => "bi-house-door",
          'text' =>  "Home", 'is_selected' => $title === "Homepage"])
        @include('partials.sidebar.sidebar_link', ['href' => "/search#questions", 'icon' => "bi-question-circle",
          'text' =>  "Search", 'is_selected' => $title === "Search"])
        @include('partials.sidebar.sidebar_link', ['href' => "/news", 'icon' => "bi-newspaper",
          'text' =>  "News", 'is_selected' => $title === "News"])
        {{--
          @include('partials.sidebar.sidebar_link', ['href' => "/search#users", 'icon' => "bi-person",
            'text' =>  "Users", 'is_selected' => $title === "Profile"])
        --}}
        @include('partials.sidebar.sidebar_link', ['href' => "/leaderboard", 'icon' => "bi-trophy",
          'text' =>  "Leaderboard", 'is_selected' => $title === "Leaderboard"])
        @include('partials.sidebar.sidebar_link', ['href' => "/about", 'icon' => "bi-info-circle",
          'text' =>  "About", 'is_selected' => $title === "About"])
        @auth
            @if(Auth::user()->hasRole('moderator'))
                @include('partials.sidebar.sidebar_link', ['href' => "/administration", 'icon' => "bi-clipboard-data", 'text' =>  "Administration", 'is_selected' => $title === "Admin"])
            @endif
        @endauth

    </ul>

    <!-- auth -->
    @guest
      <div class="row justify-content-evenly sidebar-buttons">
        <a class="btn btn-info col-auto" href="/login" role="button" aria-label="Go to login page">
          Log in
        </a>
        <a class="btn btn-primary col-auto" href="/register" role="button" aria-label="Go to register page">
          Sign up
        </a>
      </div>
    @endguest

    @auth
    <div class="sidebar-subheader d-flex justify-content-start align-items-center gap-1">
      <a href="/profile/{{ Auth::user()->username }}">
        <img class="rounded-2 fit-cover" src="{{ asset('storage/'. Auth::user()->picture) }}"
         alt="{{ Auth::user()->username }} profile picture" width=32 height=32>
      </a>
      <h4 class="d-inline-block text-truncate">{{ Auth::user()->username }}</h4>
    </div>
    <ul class="list-group">
      @include('partials.sidebar.sidebar_link', ['href' => "/profile/" . Auth::user()->username,
        'icon' => "bi-person-circle", 'text' =>  "My Profile", 'is_selected' => $title === "Profile"])
      @include('partials.sidebar.sidebar_link', ['href' => "/ask", 'icon' => "bi-plus-circle",
        'text' =>  "Ask Question", 'is_selected' => $title === "Ask Question"])
    </ul>

    <div class="row justify-content-evenly sidebar-buttons">
        <a class="btn btn-danger col-4" href="/logout">Logout</a>
    </div>
    @endauth

</nav>

<script>
  document.querySelector("#sidebar-toggler").addEventListener("click", function() {
    let sidebar = document.querySelector("#sidebar");
    if (sidebar.classList.contains("active"))
      sidebar.classList.remove("active");
    else
      sidebar.classList.add("active");
  })
</script>

<!-- Notifications -->
@auth
    <div class="container-fluid p-0" id="toast-container">
        @each('partials.sidebar.notification', Auth::user()->notifications, 'notification')
    </div>
    <script src="{{ asset('js/notifications.js') }}" defer></script>
@endauth
