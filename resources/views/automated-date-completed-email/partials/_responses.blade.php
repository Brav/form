<tr id="item-{{ $response->id }}">
    <th>{!! implode(',<br>', $response->emails) !!}</th>
    <th>
        <a href="{{ route('automated-date-completed-email.edit', $response->id) }}"
           class="btn btn-primary btn-sm active"
           role="bigModal"
           data-toggle="modal"
           data-target="#bigModal"
           data-table="response"
           data-attr="{{ route('automated-date-completed-email.edit', $response->id) }}"
           aria-pressed="true">Edit</a>
    </th>
</tr>
