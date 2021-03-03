@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block-content">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="float-right">
                    <a href="{{ route('location.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="location"
                            data-attr="{{ route('location.create') }}"
                            class="btn btn-primary my-2">Create Location</a>
                </div>

                @include('location/partials/_locations')
        </div>
    </div>
@endsection
