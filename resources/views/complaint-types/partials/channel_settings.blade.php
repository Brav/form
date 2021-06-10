<div id="accordion" role="tablist" aria-multiselectable="true">
    @foreach ($settings as $key => $value)
        <div class="block block-rounded mb-1">
            <div class="block-header block-header-default" role="tab" id="accordion2_h{{ $key }}">
            <a class="font-w600" data-toggle="collapse" data-parent="#accordion" href="#accordion2_q{{ $key }}" aria-expanded="true" aria-controls="accordion2_q{{ $key }}">
            {{ ucwords(str_replace('_', ' ', $key)) }}</a>
            </div>
            <div id="accordion2_q{{ $key }}" class="collapse" role="tabpanel" aria-labelledby="accordion2_h{{ $key }}" >
            <div class="block-content">

                 @foreach ($value as $k => $v)
                    @php
                        $channel = $channels->first(function($item) use($k){
                            return $item->id == $k;
                        })
                    @endphp
                    <span>{{ $channel->name }} - {{ $v }}</span><br>
                @endforeach

            </div>
            </div>
        </div>

    @endforeach
</div>
