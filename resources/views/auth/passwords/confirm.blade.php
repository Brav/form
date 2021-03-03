@extends('layouts.simple')

@section('content')

<p class="text-uppercase text-center font-w700 font-size-sm text-muted">{{ __('Confirm Password') }}</p>

<p>{{ __('Please confirm your password before continuing.') }}</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-hero-primary">
            {{ __('Confirm Password') }}
        </button>

        @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>
</form>
@endsection
