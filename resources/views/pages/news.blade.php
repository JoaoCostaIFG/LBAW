@extends('layouts.layout')

@section('title', 'News')
@section('pageType', 'article')

@section('content')
<div class="container">
  <h2 class="page-title">News</h2>
  <hr>

  <!-- START FEATURETTES -->
  @each('partials.news_item', $news, 'news')
  <!-- END FEATURETTES -->
</div>
@stop

