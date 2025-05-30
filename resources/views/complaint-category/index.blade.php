@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="row col-md-12">
                    <div class="float-right">
                        <a href="{{ route('complaint-category.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="complaint-category"
                            data-attr="{{ route('complaint-category.create') }}"
                            class="btn btn-primary my-2">Create Category</a>

                            <a href="{{ route('complaint-type.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="complaint-types"
                            data-attr="{{ route('complaint-type.create') }}"
                            class="btn btn-primary my-2">Create Complaint Type</a>

                            <a href="{{ route('complaint-channel.create') }}"
                                role="bigModal"
                                data-toggle="modal"
                                data-target="#bigModal"
                                data-table="complaint-channel"
                                data-attr="{{ route('complaint-channel.create') }}"
                                class="btn btn-primary my-2">Create Complaint Channel</a>

                            <a href="{{ route('severity.create') }}"
                                role="bigModal"
                                data-toggle="modal"
                                data-target="#bigModal"
                                data-table="severity"
                                data-attr="{{ route('severity.create') }}"
                                class="btn btn-primary my-2">Create Severity</a>

                            <a href="{{ route('animals.create') }}"
                                role="bigModal"
                                data-toggle="modal"
                                data-target="#bigModal"
                                data-table="animals"
                                data-attr="{{ route('animals.create') }}"
                                class="btn btn-primary my-2">Add Animal</a>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="true">Categories</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="types-tab" data-toggle="tab" href="#types" role="tab" aria-controls="types" aria-selected="false">Types of Complaint</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="channel-tab" data-toggle="tab" href="#channel" role="tab" aria-controls="channel" aria-selected="false">Complaint Channel</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="severities-tab" data-toggle="tab" href="#severities" role="tab" aria-controls="severities" aria-selected="false">Severity</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="animals-tab" data-toggle="tab" href="#animals" role="tab" aria-controls="animals" aria-selected="false">Animals</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    @include('complaint-category/partials/_categories')

                    @include('complaint-types/partials/_types')

                    @include('complaint-channel/partials/_channels')

                    @include('severities/partials/_items')

                    @include('animals/partials/_items')
                </div>


            </div>
        </div>
    </div>
@endsection
