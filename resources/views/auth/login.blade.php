@extends('layouts.layout')

@section('title', 'Login')

@section('content')
<form class="container-sm authform" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}
  <!-- Username -->
  <div class="input-group mb-3">
    <label for="username" class="form-label"><i class="bi bi-person-fill"></i> <b>Username</b> <span class="text-danger">*</span></label>
    <div class="input-group has-validation">
      <input id="username" type="text" class="form-control" name="username" placeholder="Enter your username..." value="{{ old('username') }}" required autofocus>
      @if ($errors->has('username'))
        <span class="invalid-feedback">
          {{ $errors->first('username') }}
        </span>
      @endif
    </div>
  </div>
  <!-- Password -->
  <div class="input-group mb-3">
    <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> <b>Password</b> <span class="text-danger">*</span></label>
    <div class="input-group has-validation">
      <input id="password" type="password" class="form-control" name="password" placeholder="Enter password..." required>
      @if ($errors->has('password'))
        <span class="invalid-feedback">
          {{ $errors->first('password') }}
        </span>
      @endif
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Log in</button>
</form>
<script src="/js/form-validation.js"></script>
@stop
