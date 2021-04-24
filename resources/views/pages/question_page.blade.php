@extends('layouts.layout')

@section('title', 'Question')

@section('content')
<div class="container">
    @include('partials.posts.question')
    <hr>
    @each('partials.posts.answer', $question->answers, 'answer')
</div>
@stop
