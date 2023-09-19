<tr id="forms-filters"
    class="filters"
    data-url="{{ route('complaint-form.manage') }}"
    data-pagination="pagination"
    data-container="forms-container">
    @if (!$export && $canEdit)
        <th></th>
    @endif
    <th>
        <input type="text"
            class="form-control filter filter-text"
            data-target="#date-range"
            placeholder="Date Submited"
            data-column="created_at"
            data-operator="like"
            data-type="text"
            name="date_range"
            id="date_range"/>
    </th>
    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Clinic Code"
            data-column="clinic_code"
            data-operator="like"
            data-type="text">
    </th>
    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Clinic Name"
            data-column="clinic_name"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Regional Manager"
            data-column="regional_manager"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="General Manager"
            data-column="general_manager"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Team member logging the complaint"
            data-column="team_member"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Email of Team Member"
            data-column="team_member_email"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Position of the team member"
            data-column="team_member_position"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Client/Owner name"
            data-column="client_name"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Patient name"
            data-column="patient_name"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <select class="form-control filter filter-select select-one"
        name="animal_id"
        id="animal_id"
        data-column="animal_id"
        data-type="other">
            <option value="all">All</option>
        @foreach ($animals as $animal)
            <option value="{{ $animal->id }}">{{ $animal->name }}</option>
        @endforeach
            <option value="other">Other</option>
        </select>
    </th>

    <th>
        <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Patient Number"
            data-column="pms_code"
            data-operator="like"
            data-type="text">
    </th>

    <th>
        <input type="text"
            class="form-control filter filter-text"
            placeholder="Date of the incident"
            data-column="date_of_incident"
            data-operator="like"
            data-type="text"
            name="date_of_incident_filter"
            id="date_of_incident_filter"/>
    </th>

    <th>
        <input type="text"
            class="form-control filter filter-text"
            placeholder="Date of client complaint"
            data-column="date_of_client_complaint"
            data-operator="like"
            data-type="text"
            name="date_of_client_complaint_filter"
            id="date_of_client_complaint_filter"/>
    </th>

    <th></th>
    <th>
        <select class="form-control filter filter-select select-one"
        name="aggression"
        id="aggression"
        data-column="aggression"
        data-type="select">
            <option value="all">All</option>
            <option value="none">None</option>
        @foreach ($aggressions as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
        </select>
    </th>
    <th>
        <select class="form-control filter filter-select select-one"
        name="formal_complaint_lodged"
        id="formal_complaint_lodged"
        data-column="formal_complaint_lodged"
        data-type="select">
            <option value="all">All</option>

            <option value="1">Yes</option>
            <option value="0">No</option>

        </select>
    </th>

    <th>
        <select class="form-control filter filter-select select-one"
        name="complaint_category_id"
        id="complaint_category_id"
        data-column="complaint_category_id"
        data-type="select">
            <option value="all">All</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </select>
    </th>

    <th>
        <select class="form-control filter filter-select select-one"
        name="complaint_type_id"
        id="complaint_type_id"
        data-column="complaint_type_id"
        data-type="select">
            <option value="all">All</option>
        @foreach ($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
        </select>
    </th>

    <th>
        <select class="form-control filter filter-select select-one"
        name="complaint_channel_id"
        id="complaint_channel_id"
        data-column="complaint_channel_id"
        data-type="select">
            <option value="all">All</option>
        @foreach ($channels as $channel)
            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
        @endforeach
        </select>
    </th>

    <th></th>
    <th>
        <select class="form-control filter filter-select select-one"
        name="severity"
        id="severity"
        data-column="severity_id"
        data-type="select">
            <option value="all">All</option>
        @foreach ($severities as $severity)
            <option value="{{ $severity->id }}">{{ $severity->name }}</option>
        @endforeach
        </select>
    </th>

    <th>
        <select class="form-control filter filter-select select-one text-capitalize"
        name="clinic_country"
        id="clinic_country"
        data-column="clinic_country"
        data-type="text">
            <option value="all">All</option>
        @foreach ($countries as $key => $value)
            <option value="{{ $key }}">{{ $key }}</option>
        @endforeach
        </select>
    </th>

    <th></th>

    @if ($canEdit)
        @foreach ($outcomeOptions as $option)
            <th>
                <select class="form-control filter filter-select select-one"
                    name="option_category"
                    id="option_category"
                    data-categoryid="{{ $option->id }}"
                    data-column="option_category"
                    data-type="options">
                        <option value="all">All</option>
                        @foreach ($option->options as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
            </th>
        @endforeach
        <th></th>
        <th class="small">
            <input
            type="text"
            class="form-control filter filter-text"
            placeholder="Completed by"
            data-column="completed_by"
            data-operator="like"
            data-type="text">
        </th>
        <th class="small">
            <input type="text"
            class="form-control filter filter-text"
            placeholder="Date of client complaint"
            data-column="date_completed"
            data-operator="like"
            data-type="text"
            name="date_completed_filter"
            id="date_completed_filter"/>
        </th>
        <th></th>
    @endif

    <th>
        <button type="button" id="filter-reset"
        class="btn btn-primary active">Reset</button>
    </th>
</tr>
