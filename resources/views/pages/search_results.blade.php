@extends('layouts.layout')

@section('title', 'Search Results')
@section('pageType', 'website')

@section('content')

  @php
  if (isset($_GET['search'])) {
      $search_url = '&search=' . $_GET['search'];
  } else {
      $search_url = '';
  }
  if (isset($_GET['sortBy'])) {
      $sort_url = '&sortBy=' . $_GET['sortBy'];
  } else {
      $sort_url = '';
  }
  if (isset($_GET['start_date'])) {
      $start_date_url = '&start_date=' . $_GET['start_date'];
  } else {
      $start_date_url = '';
  }
  if (isset($_GET['end_date'])) {
      $end_date_url = '&end_date=' . $_GET['end_date'];
  } else {
      $end_date_url = '';
  }
  @endphp

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
        <div class="d-flex flex-row align-items-center justify-content-between my-2">
          <h6 class="m-0 d-none d-md-block pt-2 pb-2" id="questions">{{ count($questions) }} result(s)</h6>
          <div class="d-flex flex-row gap-4">
            <!-- Filter -->
            <form method="GET" class="d-flex flex-row justify-content-center gap-2">
              <!-- From: -->
              <div class="input-group d-flex flex-row justify-content-center align-items-center gap-2">
                <label for="start-date" class="form-label m-0"><b>From:</b></label>
                <input type="date" name="start_date"
                  class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"  
                  value="" id="start_date" placeholder="mm/dd/yyyy">
                <!-- Error -->
                @if ($errors->has('start_date'))
                  <div class="invalid-feedback">
                    {{ $errors->first('start_date') }}
                  </div>
                @endif
              </div>
              <!-- To: -->
              <div class="input-group d-flex flex-row justify-content-center align-items-center gap-2">
                <label for="end-date" class="form-label m-0"><b>To:</b></label>
                <input type="date" name="end_date"
                  class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" value="" id="end_date"
                  placeholder="mm/dd/yyyy">
                <!-- Error -->
                @if ($errors->has('end_date'))
                  <div class="invalid-feedback">
                    {{ $errors->first('end_date') }}
                  </div>
                @endif
              </div>
              <!-- Filter Button -->
              <button onclick="return filter()" type="submit" class="btn btn-success">Filter</button>
            </form>
            <!-- Sort by-->
            <ul class="nav nav-pills my-2">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                  href="#" role="button">
                  <span class="d-none d-sm-block">Sort by</span>
                  <i class="bi bi-filter-right"></i></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                      href="/search?sortBy=most_recent{{ $search_url }}#questions">Most
                      Recent</a></li>
                  <li><a class="dropdown-item"
                      href="/search?sortBy=oldest{{ $search_url }}#questions">Oldest</a></li>
                  <li><a class="dropdown-item"
                      href="/search?sortBy=best_score{{ $search_url }}#questions">Best
                      Score</a></li>
                  <li><a class="dropdown-item"
                      href="/search?sortBy=worst_score{{ $search_url }}#questions">Worst
                      score</a></li>
                  <li><a class="dropdown-item" href="/search?sortBy=None{{ $search_url }}">-- No
                      order --</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        @foreach ($questions as $question)
          @include('partials.question_card')
        @endforeach

      </div>
      <!-- Users -->
      <div class="tab-pane fade" id="users">
        <div class="d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 d-none d-md-block py-2" id="users">{{ count($users) }} result(s)</h6>
          <!-- Sort by-->
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                href="#" role="button">
                <span class="d-none d-sm-block">Sort by</span>
                <i class="bi bi-filter-right"></i></a>
              <ul class="dropdown-menu">
                <li class=><a class="dropdown-item" href="/search?sortBy=most_points{{ $search_url }}#users">Most
                    Points</a></li>
                <li><a class="dropdown-item" href="/search?sortBy=least_point{{ $search_url }}s#users">Least Points</a>
                </li>
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
  
  <script>
    'use strict'

    function filter(){
      let start_date = new Date(document.querySelector("#start_date").value);
      let end_date = new Date(document.querySelector("#end_date").value);
      let question_cards = document.querySelectorAll(".question_card");

      question_cards.forEach(question => {
        let date = new Date(question.querySelectorAll(".date")[0].getAttribute("data-date"));
        if(date < start_date || date > end_date){
          question.setAttribute('style', 'display:none !important');
        }
        else question.removeAttribute('style');
      });
      return false;
    }

  </script>
@stop
