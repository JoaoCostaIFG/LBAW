@extends('layouts.layout')

@section('title', 'Question')

@section('content')
<div class="container">
    @include('partials.question')
    <hr>
    @each('partials.answer', $question->answers, 'answer')
</div>
@stop