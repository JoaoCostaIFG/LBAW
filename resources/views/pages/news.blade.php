@extends('layouts.layout')

@section('title', 'News')

@section('content')
<main class="container">
<h2 class="page-title">News</h2>

<!-- START FEATURETTES -->
@each('partials.news_item', $news, 'news')
<!-- END FEATURETTES -->
</main>
@stop

