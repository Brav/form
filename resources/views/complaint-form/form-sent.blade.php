@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="block-content">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Complaint Sent!</h4>
                    <hr>
                    @if ($response)
                        <p>{{ $response->response }}</p>
                    @endif
                </div>
        </div>
    </div>
@endsection
