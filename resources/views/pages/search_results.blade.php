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
    <h2 class="page-title">Search Results{{ isset($tag) ? ' - ' . $tag : '' }}</h2>
    <div class="py-3 border-bottom pb-0">
      <!-- Tabs -->
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#questions" class="nav-link active" data-toggle="tab">Questions</a>
        </li>
        @if (isset($users))
          <li class="nav-item">
            <a href="#users" class="nav-link" data-toggle="tab">Users</a>
          </li>
        @endif
      </ul>
    </div>

    <div class="tab-content">
        @include('partials.search_results.questions', ['questions' => $questions, 'search_url' => $search_url])
        @if (isset($users))
          @include('partials.search_results.users', ['users' => $users, 'search_url' => $search_url])
        @endif
    </div>
  </div>

  <script src="/js/tabs.js"></script>
@stop
