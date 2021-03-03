@extends('layouts.simple')

@section('content')
    
    <a name="fill-a-complain"
        id="fill-a-complain"
        class="btn btn-hero-primary btn-block" href="{{ route('complaint-form.create') }}"
        role="button">Fill a complaint</a>

    @if (!Auth::check())
        <a name="login"
            id="login"
            class="btn btn-hero-secondary btn-block" href="{{ route('login') }}"
            role="button">Login</a>
    @endif

@endsection
