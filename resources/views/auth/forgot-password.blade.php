<form method="post" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" id="">
    @if ($errors->has('email'))
        <span class="invalid-feedback d-block">
            {{ $errors->first('email') }}
        </span>
    @endif
    <input type="submit" value="Submit">
</form>
