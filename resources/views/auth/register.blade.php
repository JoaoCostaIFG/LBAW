{{-- @extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="username">Username</label>
    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection --}}


<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="modal-body">
      <!-- Email -->
      <div class="input-group mb-3">
        <label for="email" class="form-label"><b>Email address</b><span class="text-danger"> *</span></label>
        <div class="input-group has-validation">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
              <span class="error">
                  {{ $errors->first('email') }}
              </span>
            @endif
        </div>
      </div>
      <!-- Username -->
      <div class="input-group mb-3">
        <label for="username" class="form-label"><b>Username</b><span class="text-danger"> *</span></label>
        <div class="input-group has-validation">
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
            @if ($errors->has('username'))
              <span class="error">
                  {{ $errors->first('username') }}
              </span>
            @endif
        </div>
      </div>
      <!-- Password -->
      <div class="input-group mb-3">
        <label for="password" class="form-label"><b>Password</b><span class="text-danger"> *</span></label>
        <div class="input-group has-validation">
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
              <span class="error">
                  {{ $errors->first('password') }}
              </span>
            @endif
        </div>
      </div>
      <!-- Repeated Password -->
      <div class="input-group">
        <label for="repeated_password" class="form-label"><b>Repeat Password</b><span class="text-danger"> *</span></label>
        <div class="input-group has-validation">
          <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Signup</button>
    </div>
</form>
