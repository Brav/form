@extends('layouts.simple')

@section('content')

<p class="text-uppercase text-center font-w700 font-size-sm text-muted">{{ __('Login') }}</p>
   
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-group mb-0">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

        </div>
        <div class="col text-right">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    <small>{{ __('Forgot Your Password?') }}</small>
                </a>
            @endif
        </div>
    </div>


    <div class="form-group mb-0">
        <button type="submit" class="btn btn-hero-primary">
            {{ __('Login') }}
        </button>
    </div>
</form>
@endsection
