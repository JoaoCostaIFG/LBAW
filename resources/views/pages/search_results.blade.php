@extends('layouts.layout')

@section('title', 'Search Results')

@section('content')



  <!-- Page Top -->
  <div class="container">
    <h2 class="page-title"> Search Results </h2>
    <div class="py-3 border-bottom pb-0">
      <!-- Tabs -->
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#questions" class="nav-link active" data-toggle="tab">Questions</a>
        </li>
        <li class="nav-item">
          <a href="#users" class="nav-link" data-toggle="tab">Users</a>
        </li>
      </ul>
    </div>

    <div class="tab-content">
      <!-- Questions Tab -->
      <div class="tab-pane fade show active" id="questions">
        <div class="d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 d-none d-md-block pt-2 pb-2" id="questions">{{ count($questions) }} result(s)</h6>
          <!-- Sort by-->
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                href="#" role="button">
                <span class="d-none d-sm-block">Sort by</span>
                <i class="bi bi-filter-right"></i></a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/search?q=most_recent#questions">Most Recent</a></li>
                <li><a class="dropdown-item" href="/search?q=oldest#questions">Oldest</a></li>
                <li><a class="dropdown-item" href="/search?q=best_score#questions">Best Score</a></li>
                <li><a class="dropdown-item" href="/search?q=worst_score#questions">Worst score</a></li>
                <li><a class="dropdown-item" href="/search">-- No order --</a></li>
              </ul>
            </li>
          </ul>
        </div>
        @foreach ($questions as $question)
          @include('partials.question_card')
        @endforeach

      </div>
      <!-- Users -->
      <div class="tab-pane fade" id="users">
        <div class="d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 d-none d-md-block pt-2 pb-2" id="users">{{ count($users) }} result(s)</h6>
          <!-- Sort by-->
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                href="#" role="button">
                <span class="d-none d-sm-block">Sort by</span>
                <i class="bi bi-filter-right"></i></a>
              <ul class="dropdown-menu">
                <li class=><a class="dropdown-item" href="/search?q=most_points#users">Most Points</a></li>
                <li><a class="dropdown-item" href="/search?q=least_points#users">Least Points</a></li>
                <li><a class="dropdown-item" href="/search">-- No order --</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="container">
          @for ($i = 0; $i < count($users); $i += 2)
            <div class="row py-1 gap-2">
              @include('partials.search_results.user_card', ['user' => $users[$i]])
              @if (isset($users[$i + 1]))
                @include('partials.search_results.user_card', ['user' => $users[$i + 1]])
              @endif
            </div>
          @endfor
        </div>
      </div>
    </div>
  </div>

  <script src="/js/tabs.js"></script>
  <script src="/js/sort_dropdown.js"></script>
@stop
