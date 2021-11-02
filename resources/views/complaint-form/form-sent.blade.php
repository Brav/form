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

                <p>
                <h4>Useful resources for dealing with complaints</h4><br>
                <span><a href="https://rise.articulate.com/share/ebvbTT1KJhQKagctvBlQGhcH1F5ACXN8#/">Difficult Conversation Planning </a></span><br>
                    <span><a href="https://rise.articulate.com/share/9WMRd5wNr9CVkiIlFSWRnI3TQlW6NMX7#/">How to Have a Difficult Conversation</a></span><br>
                    <span><a href="https://rise.articulate.com/share/IrnA9Lkdv_7s6S7QMrlV9BetXvHjidXl#/">Managing Client Complaints and Angry Customers</a></span><br>
                    <span><a href="{{ route('operational_policy') }}">Clients Complaints and Concerns - Operational Policy</a></span><br>
                </p>
        </div>
    </div>
@endsection
