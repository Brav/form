@foreach ($clinics as $clinic)
    <tr id="item-{{ $clinic->id }}">
        <th>{{ $clinic->id }}</th>
        <th>{{ $clinic->name }}</th>
        <th>
            @if ($clinic->leadVet)
                @foreach ($clinic->leadVet as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif

        </th>
        <th>
            @if ($clinic->practiseManager)
                @foreach ($clinic->practiseManager as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif

        </th>
        <th>
            @if ($clinic->vetManager)
                @foreach ($clinic->vetManager as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif
        </th>
        <th>
            @if ($clinic->gmVeterinaryOperation)
                @foreach ($clinic->gmVeterinaryOperation as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif
        </th>
        <th>
            @if ($clinic->generalManager)
                @foreach ($clinic->generalManager as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif
        </th>
        <th>
            @if ($clinic->regionalManager)
                @foreach ($clinic->regionalManager as $user)
                    {{ $user->user->name }} <br>
                @endforeach
            @endif
        </th>
        <th>
            <a href="{{ route('clinics.edit', $clinic->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('clinics.delete', $clinic->id) }}" title="Delete Clinic">
                    <i class="fa fa-trash-o fa-lg"></i> Delete
                </a>
        </th>
    </tr>
@endforeach
