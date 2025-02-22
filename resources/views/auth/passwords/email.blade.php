@extends('layouts.simple')

@section('content')
<p class="text-uppercase text-center font-w700 font-size-sm text-muted">{{ __('Reset Password') }}</p>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
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
            <button type="submit" class="btn btn-hero-primary">
                {{ __('Send Password Reset Link') }}
            </button>
    </div>
</form>
@endsection
