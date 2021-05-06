<nav id="sidebar" class="bg-dark text-light" tabindex="0">
    <div class="sidebar-header">
      <h3>{{ $title }}</h3>
    </div>

    <div class="sidebar-subheader">
      <h4>Pages</h4>
    </div>
    <ul class="list-group">
        @include('partials.sidebar.sidebar_link', ['href' => "/home", 'icon' => "bi-house-door", 'text' =>  "Home"])
        @include('partials.sidebar.sidebar_link', ['href' => "/search#questions", 'icon' => "bi-question-circle", 'text' =>  "Questions"])
        @include('partials.sidebar.sidebar_link', ['href' => "/news", 'icon' => "bi-newspaper", 'text' =>  "News"])
        @include('partials.sidebar.sidebar_link', ['href' => "/search#users", 'icon' => "bi-person", 'text' =>  "Users"])
        @include('partials.sidebar.sidebar_link', ['href' => "/leaderboard", 'icon' => "bi-trophy", 'text' =>  "Leaderboard"])
        @include('partials.sidebar.sidebar_link', ['href' => "/about", 'icon' => "bi-info-circle", 'text' =>  "About"])
        @auth
            @if(Auth::user()->hasRole('moderator'))
            {{-- @auth --}}
                @include('partials.sidebar.sidebar_link', ['href' => "/administration", 'icon' => "bi-clipboard-data", 'text' =>  "Administration"])
            {{-- @endauth --}}
            @endif
        @endauth

    </ul>

    <!-- auth -->
    @guest
        <div class="row justify-content-evenly sidebar-buttons">
        <a class="btn btn-info col-4" href="/login" type="button" aria-expanded="false" aria-label="Open login box">
          Log in
        </a>
        <a class="btn btn-primary col-4" href="/register" type="button" aria-controls="loginModal" aria-expanded="false" aria-label="Open signup box">
          Sign up
        </a>
      </div>
    @endguest

    @auth
    <div class="sidebar-subheader">
        <h4>
        {{-- TODO --}}
          <img src="{{ Auth::user()->picture }}" class="rounded" width="32" alt="User profile picture">
          {{ Auth::user()->username }}
          <button type="button" class="btn btn-dark" id="notifications-btn">
            <i class="bi bi-bell"></i>
          </button>
        </h4>
    </div>
      <ul class="list-group">
          @include('partials.sidebar.sidebar_link', ['href' => "/profile/" . Auth::id(), 'icon' => "bi-person-circle", 'text' =>  "My Profile"])
          @include('partials.sidebar.sidebar_link', ['href' => "/ask_question", 'icon' => "bi-plus-circle", 'text' =>  "Ask Question"]) {{-- TODO --}}
      </ul>

    <div class="row justify-content-evenly sidebar-buttons">
        <a class="btn btn-danger col-4" href="/logout">Logout</a>
    </div>
    @endauth

</nav>

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
@auth
    <div class="container-fluid p-3" id="toast-container" style="z-index: 5;">
        @each('partials.sidebar.notification', Auth::user()->notifications, 'notification')
    </div>
    <script src="/js/notifications.js"></script>
@endauth
