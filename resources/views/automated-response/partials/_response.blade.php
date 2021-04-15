<tr id="item-{{ $response->id }}">
    <th>{{ $response->id }}</th>
    <th>{{ $response->name }}</th>
    <th>{{ $response->response }}</th>
    <th>
        @if ($response->scenario)
            {{ $response->scenarioCase }}
        @endif
    </th>
    <th>
        <a href="{{ route('automated-response.edit', $response->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="response"
            data-attr="{{ route('automated-response.edit', $response->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('automated-response.delete', $response->id) }}" title="Delete Response">
                <i class="fa fa-trash-o fa-lg"></i> Delete</a>
    </th>
</tr>
