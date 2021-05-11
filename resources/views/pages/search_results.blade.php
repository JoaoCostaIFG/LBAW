@extends('layouts.layout')

@section('title', 'Search')
@section('pageType', 'website')

@section('content')

  <!-- Page Top -->
  <div class="container">
    <!-- Title -->
    <h2 class="page-title">Search results
      @if (isset($tag)) 
          for "{{$tag}}"
      @else
        @if(@isset($q))
          for "{{$q}}"
        @endif
      @endif
    </h2>
    <div class="py-3 border-bottom pb-0">
      <!-- Tabs -->
      <ul class="nav nav-tabs" role="navigation">
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
      @include('partials.search_results.questions', ['questions' => $questions])
      @if (isset($users))
        @include('partials.search_results.users', ['users' => $users])
      @endif
    </div>
  </div>
  <script src="/js/tabs.js"></script>
@stop
