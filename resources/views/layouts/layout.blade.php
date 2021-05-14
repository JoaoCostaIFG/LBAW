<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Assembling a community-driven database of knowledge by asking and answering questions.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - SegmentationFault</title>
    <!-- Bootstrap (must come before all other stylesheets) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" /> -->
    <!-- using themed bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print" type="text/css" />

    <!-- OpenGraph -->
    <meta property="og:title" content="@yield('title') - SegmentationFault" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('image/logo/default.png') }}" />
    <meta property="og:type" content="@yield('pageType')" />
    <meta property="og:description" content="Assembling a community-driven database of knowledge by asking and answering questions." />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
  </head>
  <body>
    <!-- skip link -->
    <a id="skip-nav" class="screenreader-text" href="#main-content">
      Skip navigation and sidebar
    </a>

    <header>
      <!-- Header -->
      <nav class="navbar fixed-top navbar-expand bg-dark navbar-dark">
        <div class="container d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <button id="sidebar-toggler" class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-brand">
              <a id="brand-logo" href="{{ url('home') }}">
                <span id="brand">Segmentation <b>fault</b></span>
              </a>
              <i class="bi bi-cpu"></i>
              @yield('title')
            </div>
          </div> <!-- .d-flex -->
          <!-- search -->
          <div id="searchModal-toggler">
            <button type="button" class="btn btn-outline-success" aria-label="Open search form" data-bs-toggle="modal" data-bs-target="#searchModal">
              <i class="bi-search"></i>
            </button>
          </div>
          <form id="navbarSeachForm" class="d-flex" action="{{ url('search') }}">
            <input class="form-control me-2" name="q" value="{{$q ?? ''}}" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" aria-label="Search"><i class="bi-search"></i></button>
          </form>
        </div> <!-- .container .d-flex -->
      </nav>
    </header>

    <!-- BEGIN SEARCH MODAL -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- bg-dark -->
          <div class="modal-body">
            <form action="{{ url('search') }}">
              <!-- button is not needed -->
              <!-- <button class="btn btn-outline-success" type="submit"><i class="bi-search"></i></button> -->
              <input class="form-control" type="search" name="q" value="{{$q ?? ''}}" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END SEARCH MODAL -->

    <!-- Sidebar -->
    @include('partials.sidebar.sidebar', ['title' => app()->view->getSections()['title']])

    <main>
      <section id="main-content" {{ isset($notInlineContainer) ? '' : 'class=container-md' }}>
        @yield('content')
      </section>
    </main>

    <!-- Footer -->
    <footer class="container">
      <a class="btn btn-secondary" id="go-up-button" href="#" role="button" aria-label="Go to the top of the page"><i class="bi bi-arrow-up"></i></a>
      <br>
      <hr>
      <div class="row justify-content-between">
        <p class="col-auto text-muted">&#169; 2021 Segmentation Fault, Inc.</p>
        <a class="col-auto text-end" href="#">Go to the top</a>
      </div>
    </footer>
    <!-- Bootstrap + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script>
      var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
      })
    </script>
  </body>
</html>
