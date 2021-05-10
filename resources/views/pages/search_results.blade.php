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
    <h2 class="page-title">Search Results</h2>
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
        <div class="row align-items-center justify-content-between my-2 py-1 gx-0">
          <h6 id="questions" class="col-12 col-lg-3 m-0">
            Showing {{ $questions->count() }} out of {{ $questions->total() }} result(s)
          </h6>
          <!-- Filter -->
          <form id="search-filters-form" method="GET" class="col-12 col-lg-9 row gx-0 gap-1">
            <!-- From: -->
            <div class="col-12 col-md-auto">
              <label for="start-date" class="form-label m-0"><b>From:</b></label>
              <input type="date" name="start_date"
                class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" value="" id="start_date"
                placeholder="mm/dd/yyyy">
              @if ($errors->has('start_date'))
                <div class="invalid-feedback">
                  {{ $errors->first('start_date') }}
                </div>
              @endif
            </div>
            <!-- To: -->
            <div class="col-12 col-md-auto">
              <label for="end-date" class="form-label m-0"><b>To:</b></label>
              <input type="date" name="end_date" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                value="" id="end_date" placeholder="mm/dd/yyyy">
              @if ($errors->has('end_date'))
                <div class="invalid-feedback">
                  {{ $errors->first('end_date') }}
                </div>
              @endif
            </div>
            <!-- Sort By -->
            <select class="col-auto" aria-label="Sort by" name="sortBy">
              <option value="">Sort By: ---</option>
              <option value="most_recent">Sort By: Most Recent</option>
              <option value="oldest">Sort By: Oldest</option>
              <option value="best_score">Sort By: Best Score</option>
              <option value="worst_score">Sort By: Worst Score</option>
            </select>
            @if ($errors->has('sortBy'))
              <div class="invalid-feedback">
                {{ $errors->first('sortBy') }}
              </div>
            @endif
            <!-- Filter Button -->
            <button onclick="" type="submit" class="col-auto btn btn-success">Apply</button>
          </form>
        </div>
        @foreach ($questions as $question)
          @include('partials.question_card')
        @endforeach
        <!-- Pagination -->
        <div class="d-flex justify-content-end">
          {{ $questions->links() }}
        </div>
      </div>
      <!-- Users -->
      <div class="tab-pane fade" id="users">
        <div class="d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 d-none d-md-block pt-2 pb-2" id="questions">Showing {{ $users->count() }} out of
            {{ $users->total() }} result(s)</h6>
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
        <!-- Pagination -->
        <div class="d-flex justify-content-end">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>

  <script src="/js/tabs.js"></script>
@stop
