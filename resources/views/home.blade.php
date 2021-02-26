@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row align-self-center">
        <div class="col-md-12 ">
            <div class="card vh-100 d-flex align-self-center">

                <a name="fill-a-complain"
                    id="fill-a-complain"
                    class="btn btn-primary" href="{{ route('complaint-form.create') }}"
                    role="button">Fill a complaint</a>

                @if (!Auth::check())
                    <a name="login"
                        id="login"
                        class="btn btn-primary" href="{{ route('login') }}"
                        role="button">Login</a>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
