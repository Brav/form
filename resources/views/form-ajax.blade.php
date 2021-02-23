<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($task === 'create')
                @include($view . '/forms/_create')
            @endif

            @if ($task === 'edit')
                @include($view . '/forms/_edit')
            @endif

        </div>
    </div>
</div>
