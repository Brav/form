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
                <ul class=list-group>
                    <li class="list-group-item"><a href="https://rise.articulate.com/share/ebvbTT1KJhQKagctvBlQGhcH1F5ACXN8#/">Difficult Conversation Planning </a></li>
                    <li class="list-group-item"><a href="https://rise.articulate.com/share/9WMRd5wNr9CVkiIlFSWRnI3TQlW6NMX7#/">How to Have a Difficult Conversation</a></li>
                    <li class="list-group-item"><a href="https://rise.articulate.com/share/IrnA9Lkdv_7s6S7QMrlV9BetXvHjidXl#/">Managing Client Complaints and Angry Customers</a></li>
                    <li class="list-group-item"><a href="{{ route('operational_policy') }}">Clients Complaints and Concerns - Operational Policy</a></li>
                    <li class="list-group-item"><a href="<?php echo asset('media/documents/responding_to_reviews.pdf') ?>" class="d-block" target=_blank rel=noopener rel=nofollow>
                            <i class="fas fa-file-pdf fa-lg fa-fw"></i> Responding To Reviews
                        </a></li>
                </ul>
                </p>
        </div>
    </div>
@endsection
