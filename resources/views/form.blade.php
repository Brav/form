@php 
    $layout = auth()->user() ? 'layouts.app' : 'layouts.public';
@endphp
@extends($layout)

@section('content')

    <div class="content">
        <div class="block-content">
            @if ($task === 'create')
                @include($view . '/forms/_create')
            @endif

            @if ($task === 'edit')
                @include($view . '/forms/_edit')
            @endif

        </div>
    </div>


@endsection
