@extends('layouts.layout', ['notInlineContainer' => true])

@section('title', 'Forgot Password')

@section('content')
<div class="auth-container">
    <div class="auth-form-container">
        <h2 class="lead fs-3 fw-bold">Forgot Password</h2>
        <form class="auth-form" method="post" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group mb-3">
                <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> <b>Email address associated with your account</b> <span class="text-danger">*</span></label>
                <div class="input-group has-validation">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter email... (e.g.: email@example.com)" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback d-block">
                            {{ $errors->first('email') }}
                        </span>
                    @elseif (session('status'))
                        <span class="valid-feedback d-block">
                            {{ session('status') }}
                        </span>
                    @endif

                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Request password reset</button>
        </form>
    </div>
</div>
@stop
