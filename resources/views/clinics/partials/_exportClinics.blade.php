@foreach ($clinics as $clinic)
    <tr>
        <th>{{ $clinic->name }}</th>
        <th>
            @if ($clinic->practiseManager)
                @foreach ($clinic->practiseManager as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->practiseManager)
                @foreach ($clinic->practiseManager as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                @foreach ($clinic->leadVet as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                @foreach ($clinic->leadVet as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                @foreach ($clinic->regionalManager as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                @foreach ($clinic->regionalManager as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                @foreach ($clinic->vetManager as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                @foreach ($clinic->vetManager as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                @foreach ($clinic->generalManager as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                @foreach ($clinic->generalManager as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                @foreach ($clinic->gmVeterinaryOperation as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                @foreach ($clinic->gmVeterinaryOperation as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                @foreach ($clinic->gmVetsServices as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                @foreach ($clinic->gmVetsServices as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->other)
                @foreach ($clinic->other as $user)
                    {{ $user->user->name ?? '' }} <br>
                @endforeach
            @endif
        </th>

        <th>
            @if ($clinic->other)
                @foreach ($clinic->other as $user)
                    {{ $user->user->email ?? '' }} <br>
                @endforeach
            @endif
        </th>

    </tr>
@endforeach
