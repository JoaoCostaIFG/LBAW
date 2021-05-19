<form method="post" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" id="token" name="token" value="{{ $token }}">
    <input id="email" type="email" class="form-control" name="email" placeholder="Enter email... (e.g.: email@example.com)"value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
    <span class="invalid-feedback d-block">
        {{ $errors->first('email') }}
    </span>
    @endif
    <input id="password" type="password" class="form-control" name="password" placeholder="Enter password..." required>
    @if ($errors->has('password'))
    <span class="invalid-feedback d-block">
        {{ $errors->first('password') }}
    </span>
    @endif
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password..." required>
    <input type="submit" value="Submit">
</form>
