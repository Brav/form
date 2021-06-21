<tr id="item-{{ $channel->id }}">
        <th>{{ $channel->id }}</th>
        <th>{{ $channel->name }}</th>
        <th>{{ $channel->level ?? '/' }}</th>
        <th>{{ $channel->additional_email ?? '/' }}</th>
        <th>
            <a href="{{ route('complaint-channel.edit', $channel->id) }}"
                class="btn btn-primary btn-sm active"
                role="bigModal"
                data-toggle="modal"
                data-target="#bigModal"
                data-table="complaint-channel"
                data-attr="{{ route('complaint-channel.edit', $channel->id) }}"
                aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('complaint-channel.delete', $channel->id) }}"
                title="Delete Category">
                    <i class="fa fa-trash-o  fa-lg"></i> Delete
                </a>
        </th>
    </tr>
