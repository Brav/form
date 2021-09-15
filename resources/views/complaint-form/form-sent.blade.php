@extends( auth()->user() ? 'layouts.app' : 'layouts.public')

@section('content')

    <div class="content">
        <div class="block-content">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Complaint Sent!</h4>
                    <hr>
                    @if (session('response'))
                        {!! session('response') !!}
                    @endif
                </div>
        </div>
    </div>
@endsection
