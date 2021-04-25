{{-- @extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection --}}

<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="modal-body">
      <!-- Email -->
      <div class="input-group mb-3">
        <label for="email" class="form-label"><b>Email</b><span class="text-danger"> *</span></label>
        <div class="input-group has-validation">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="error">
                  {{ $errors->first('email') }}
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
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Log in</button>
    </div>
  </form>
