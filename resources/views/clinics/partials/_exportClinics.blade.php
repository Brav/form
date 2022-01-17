<?php
    use App\Models\Clinic;
?>
@foreach ($clinics as $clinic)
    <tr>
        <th>{{ $clinic->name }}</th>
        <th>
            @if ($clinic->practiseManager)
                <?php
                    echo Clinic::printUsers($clinic->practiseManager, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->practiseManager)
                <?php
                    echo Clinic::printUsers($clinic->practiseManager, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                <?php
                    echo Clinic::printUsers($clinic->leadVet, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->leadVet)
                <?php
                    echo Clinic::printUsers($clinic->leadVet, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                <?php
                    echo Clinic::printUsers($clinic->regionalManager, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->regionalManager)
                <?php
                    echo Clinic::printUsers($clinic->regionalManager, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                <?php
                    echo Clinic::printUsers($clinic->vetManager, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->vetManager)
                <?php
                    echo Clinic::printUsers($clinic->vetManager, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                <?php
                    echo Clinic::printUsers($clinic->generalManager, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->generalManager)
                <?php
                    echo Clinic::printUsers($clinic->generalManager, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                <?php
                    echo Clinic::printUsers($clinic->gmVeterinaryOperation, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->gmVeterinaryOperation)
                <?php
                    echo Clinic::printUsers($clinic->gmVeterinaryOperation, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                <?php
                    echo Clinic::printUsers($clinic->gmVetsServices, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->gmVetsServices)
                <?php
                    echo Clinic::printUsers($clinic->gmVetsServices, 'email');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->other)
                <?php
                    echo Clinic::printUsers($clinic->other, 'name');
                ?>
            @endif
        </th>

        <th>
            @if ($clinic->other)
                <?php
                    echo Clinic::printUsers($clinic->other, 'email');
                ?>
            @endif
        </th>

    </tr>
@endforeach
