@extends('layouts.layout')

@section('title', 'Question')

@section('content')
<main class="container">
    @include('partials.question')
    <hr>
    @each('partials.answer', $question->answers, 'answer')
</main>
