@extends('layouts.layout', ['notInlineContainer' => true])

@section('title', 'Register')

@section('content')
<div class="auth-container">
  <div class="auth-form-container">
    <span class="lead fs-3 fw-bold">Welcome to Segmentation fault</span>

    <form class="auth-form" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      <!-- Email -->
      <div class="input-group mb-3">
        <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> <b>Email address</b> <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
          <input id="email" type="email" class="form-control" name="email" placeholder="Enter email... (e.g.: email@example.com)"value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback d-block">
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
            <span class="invalid-feedback d-block">
              {{ $errors->first('username') }}
            </span>
          @endif
        </div>
      </div>
      <!-- Password -->
      <div class="input-group mb-3">
        <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> <b>Password</b> <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
          <input id="password" type="password" class="form-control" name="password" placeholder="Enter password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" >
          @if ($errors->has('password'))
            <span class="invalid-feedback d-block">
              {{ $errors->first('password') }}
            </span>
          @endif
        </div>
      </div>
      <ul id="message-password" class="list-unstyled">
        <li id="letter" class="text-danger"><i class='bi bi-x-lg'></i> Must have a <b>lowercase</b> letter</li>
        <li id="capital" class="text-danger"><i class='bi bi-x-lg'></i> Must have a <b>capital (uppercase)</b> letter</li>
        <li id="number" class="text-danger"><i class='bi bi-x-lg'></i> Must have a <b>number</b></li>
        <li id="length" class="text-danger"><i class='bi bi-x-lg'></i> Minimum <b>6 characters</b></li>
      </ul>
      <!-- Repeated Password -->
      <div class="input-group mb-3">
        <label for="repeated_password" class="form-label"><i class="bi bi-lock-fill"></i> <b>Repeat Password</b> <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
          <input id="repeated_password" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password..." required>
        </div>
      </div>
      <ul id="message-confirm" class="list-unstyled">
        <li id="repeat" class="text-danger"><i class='bi bi-x-lg'></i> Password must <b>match</b></li>
      </ul>
      <!-- submit button -->
      <button type="submit" class="btn btn-primary mt-2">Signup</button>
    </form>    
  </div>
</div>
<script src="{{ asset('js/form-validation.js') }}" defer></script>
<script src="{{ asset('js/password_verification.js') }}" defer></script>
@stop
