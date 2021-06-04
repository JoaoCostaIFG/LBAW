@extends('layouts.layout', ['notInlineContainer' => true])

@section('title', 'Reset Password')

@section('content')
<div class="auth-container">
    <div class="auth-form-container">
        <h2 class="lead fs-3 fw-bold">Reset Password</h2>
        <form class="auth-form" method="post" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" id="token" name="token" value="{{ $token }}">
            <!-- Email -->
            <div class="input-group mb-3">
                <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> <b>Email address</b> <span class="text-danger">*</span></label>
                <div class="input-group has-validation">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter email... (e.g.: email@example.com)" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback d-block">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Password -->
            <div class="input-group mb-3">
                <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> <b>New Password</b> <span class="text-danger">*</span></label>
                <div class="input-group has-validation">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter new password..." required>
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
                <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill"></i> <b>Repeat New Password</b> <span class="text-danger">*</span></label>
                <div class="input-group has-validation">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Repeat new password..." required>
                </div>
            </div>
            <ul id="message-confirm" class="list-unstyled">
                <li id="repeat" class="text-danger"><i class='bi bi-x-lg'></i> Password must <b>match</b></li>
            </ul>
            <!-- submit button -->
            <button type="submit" class="btn btn-primary mt-2">Reset Password</button>
        </form>
    </div>
</div>
<script src="/js/form-validation.js"></script>
<script src="{{ asset('js/password_verification.js') }}"></script>
@stop
