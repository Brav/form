<?php
    use App\Models\Clinic;
?>
@foreach ($clinics as $clinic)
    <tr>
        <th>{{ $clinic->name }}</th>
        <th>
            @if ($clinic->practiseManager)
                {{ Clinic::printUsers($clinic->practiseManager, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->practiseManager)
                {{ Clinic::printUsers($clinic->practiseManager, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                {{ Clinic::printUsers($clinic->leadVet, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                {{ Clinic::printUsers($clinic->leadVet, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                {{ Clinic::printUsers($clinic->regionalManager, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                {{ Clinic::printUsers($clinic->regionalManager, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                {{ Clinic::printUsers($clinic->vetManager, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                {{ Clinic::printUsers($clinic->vetManager, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                {{ Clinic::printUsers($clinic->generalManager, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                {{ Clinic::printUsers($clinic->generalManager, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                {{ Clinic::printUsers($clinic->gmVeterinaryOperation, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                {{ Clinic::printUsers($clinic->gmVeterinaryOperation, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                {{ Clinic::printUsers($clinic->gmVetsServices, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                {{ Clinic::printUsers($clinic->gmVetsServices, 'email') }}
            @endif
        </th>

        <th>
            @if ($clinic->other)
                {{ Clinic::printUsers($clinic->other, 'name') }}
            @endif
        </th>

        <th>
            @if ($clinic->other)
                {{ Clinic::printUsers($clinic->other, 'email') }}
            @endif
        </th>

    </tr>
@endforeach
