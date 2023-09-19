@extends( auth()->user() ? 'layouts.app' : 'layouts.public')

@section('content')

    <div class="content">
        <div class="block-content">

            @auth()
                <div class="alert alert-danger" role="alert">
                   <strong>Automated response used:</strong><br>
                    {{ session('response')->name ??
                    'N/A (response not found/set for combination used in this complaint)'
                    }}
                </div>
            @endauth

            <div class="container">
                <div class="alert alert-success text-center" role="alert">
                    <hr>
                    <h4 class="h1 alert-heading my-3">Complaint Sent!</h4>
                    <hr>

                    {!! session('response')->response ?? '' !!}

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
