@extends('layouts.layout')

@section('title', 'Register')

@section('content')
<form class="container-md auth-form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <!-- Email -->
    <div class="input-group mb-3">
      <label for="email" class="form-label"><b>Email address</b><span class="text-danger"> *</span></label>
      <div class="input-group has-validation">
        <input id="email" type="email" class="form-control" name="email" placeholder="Enter email... (e.g.: email@example.com)"value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
          <span class="invalid-feedback">
            {{ $errors->first('email') }}
          </span>
        @endif
      </div>
    </div>
    <!-- Username -->
    <div class="input-group mb-3">
      <label for="username" class="form-label"><i class="bi bi-person-fill"></i> <b>Username</b> <span class="text-danger">*</span></label>
      <div class="input-group has-validation">
        <input id="username" type="text" class="form-control" name="username" placeholder="Enter username..." value="{{ old('username') }}" required>
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
    <!-- Repeated Password -->
    <div class="input-group">
      <label for="repeated_password" class="form-label"><i class="bi bi-lock-fill"></i> <b>Repeat Password</b> <span class="text-danger">*</span></label>
      <div class="input-group has-validation">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password..." required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Signup</button>
</form>
<script src="/js/form-validation.js"></script>
@stop
