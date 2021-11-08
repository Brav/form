@extends( auth()->user() ? 'layouts.app' : 'layouts.public')

@section('content')

    <div class="content">
        <div class="block-content">
            <div class="container">
                <div class="alert alert-success text-center" role="alert">
                    <hr>
                    <h4 class="h1 alert-heading my-3">Complaint Sent!</h4>
                    <hr>
                    @if (session('response'))
                        {!! session('response') !!}
                    @endif
                </div>

                <div class="text-center mb-5">
                    <h4 class="h2 my-3">Useful resources for dealing with complaints</h4>
                    <a class="btn btn-primary my-2 mx-auto d-block btn-lg" style="max-width: 600px" href="https://rise.articulate.com/share/ebvbTT1KJhQKagctvBlQGhcH1F5ACXN8#/">Difficult Conversation Planning</a>
                    <a class="btn btn-primary my-2 mx-auto d-block btn-lg" style="max-width: 600px" href="https://rise.articulate.com/share/9WMRd5wNr9CVkiIlFSWRnI3TQlW6NMX7#/">How to Have a Difficult Conversation</a>
                    <a class="btn btn-primary my-2 mx-auto d-block btn-lg" style="max-width: 600px" href="https://rise.articulate.com/share/IrnA9Lkdv_7s6S7QMrlV9BetXvHjidXl#/">Managing Client Complaints and Angry Customers</a>
                    <a class="btn btn-primary my-2 mx-auto d-block btn-lg" style="max-width: 600px" href="{{ route('operational_policy') }}">Clients Complaints and Concerns - Operational Policy</a>
                </div>
            </div>
        </div>
    </div>
@endsection
