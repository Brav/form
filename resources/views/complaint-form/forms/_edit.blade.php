<span class="smini-hidden">
    <img src="{{ asset('media/logos/logo-1x.png')}}" alt="VetsDirect" class="img-fluid">
</span>
<h1>Complaint Form Update</h1>
<form
    class="max-1024"
    action="{{ route('complaint-form.update', $form->id) }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input
        type="file"
        name="documents[]"
        id="hidden-documents"
        multiple
        class="d-none"
        >
    <div class="form-row align-items-center">
        <div class="col-md-4">
            <div class="form-group">
              <label for="created_at">Date/Time</label>
              <input type="text"
                class="form-control"
                name="created_at"
                id="created_at"
                readonly
                value={{ $form->created_at->format('d/m/Y g:i A') }}>
              <small id="helpId" class="form-text text-muted">Timestamp when complaint logged</small>
            </div>
        </div>

    </div>

    <div class="form-row align-items-center">

        @foreach ($outcomeOptions as $option)

            @php
                $categoryKey = array_search($option->id, array_column($form->outcome_options ?? [], 'category_id'));
                $outcome = $form->outcome_options ? $form->outcome_options[$categoryKey]['option_id'] : null;
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                  <label for="outcomeOptions-{{ $option->selectName }}">{{ $option->name }}</label>

                  <select class="form-control"
                    name="outcomeOptions[{{ $option->selectName }}]"
                    id="outcomeOptions-{{ $option->selectName }}">
                    @foreach ($option->options as $item)
                        <option value="{{ $item->id }}"
                            @if (old('outcomeOptions-' . $option->selectName, $outcome)
                            == $item->id)
                                selected
                            @endif
                            >{{ $item->name }}</option>
                    @endforeach
                  </select>

                </div>
            </div>
        @endforeach

    </div>

    <div class="form-row align-items-center">

        <div class="col-md-8">
            <div class="form-group">
              <label for="outcome">Outcome of incident and/or complaint</label>
              <textarea class="form-control"
                name="outcome"
                id="outcome"
                rows="5"
                >{{ old('outcome', $form->outcome) }}</textarea>
                @error('outcome')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-row alight-items-center">
        <div class="col-md-4">
            <div class="form-group">
              <label for="completed_by">Completed by</label>
              <input type="text"
                class="form-control"
                name="completed_by"
                id="completed_by"
                placeholder="Completed by"
                value="{{ old('completed_by', $form->completed_by) }}">
                @error('completed_by')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <label for="date_completed">Date completed</label>
                <div class="input-group date date_completed" id="date-completed" data-target-input="nearest" >
                    <input type="text"
                        class="form-control datetimepicker-input datetimepicker"
                        data-target="#date-completed"
                        name="date_completed"
                        id="date_completed"
                        value="{{ old('date_completed', optional($form->date_completed)->format('d/m/Y')) }}"/>
                    <div class="input-group-append"
                        data-target="#date-completed"
                        data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('date_completed')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    <div class="form-row align-items-center">

        <div class="col-md-4">
            <div class="form-group">

                    <label for="clinic_id">Clinic Name</label>
                    <select class="form-control select2" name="clinic_id"
                        id="clinic_id"
                        {{ $readonly }}>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}"
                            data-manager="{{
                                $clinic->regionalManager ? $clinic->regionalManager->first()->user->name : '' }}"
                            @if (old('clinic_id', $form->clinic_id) == $clinic->id)
                                selected
                            @endif
                            >{{ $clinic->name }}</option>
                    @endforeach
                    </select>

                @error('clinic_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">

                <div class="form-group">
                    <label for="regional_manager">Regional Manager</label>
                    <input type="text"
                    class="form-control" name="regional_manager"
                    id="regional_manager"
                    placeholder="Regional Manager"
                    readonly>
                </div>

            </div>
        </div>


    </div>

    <div class="form-row align-items-center">

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member">Team Member logging the complaint:</label>
                <input type="text"
                class="form-control"
                name="team_member"
                id="team_member"
                value="{{ old('team_member', $form->team_member) }}"
                placeholder="Team Member logging the complaint"
                {{ $readonly }}>

                @error('team_member')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member_position">Position of The Member</label>
                <input type="text"
                    class="form-control"
                    name="team_member_position"
                    id="team_member_position"
                    value="{{ old('team_member_position', $form->team_member_position) }}"
                    placeholder="Position of the Member"
                    {{ $readonly }}>

                    @error('team_member_position')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>

        </div>


    </div>

    <div class="form-row align-items-center">

        <div class="col-md-4">

            <div class="form-group">
                <label for="client_name">Client / Owner Name:</label>
                <input type="text"
                class="form-control"
                name="client_name"
                id="client_name"
                value="{{ old('client_name', $form->client_name) }}"
                placeholder="Client / Owner Name"
                {{ $readonly }}>
                @error('client_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text"
                    class="form-control"
                    name="patient_name"
                    id="patient_name"
                    value="{{ old('patient_name', $form->patient_name) }}"
                    placeholder="Patient Name"
                    {{ $readonly }}>
                @error('patient_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="pms_code">PMS Code</label>
                <input type="text"
                    class="form-control"
                    name="pms_code"
                    id="pms_code"
                    value="{{ old('pms_code', $form->pms_code) }}"
                    placeholder="PMS Code"
                    {{ $readonly }}>
                @error('pms_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_incident">Date of the incident</label>
                <div class="input-group date date_of_incident" data-target-input="nearest">

                    <input type="text"
                        class="form-control datetimepicker-input"
                        data-target=".datetimepicker-datetime"
                        name="date_of_incident"
                        id="date_of_incident"
                        value="{{ old('date_of_incident', $form->date_of_incident->format('d/m/Y g:i A')) }}"
                        {{ $readonly }}/>
                    <div class="input-group-append"
                        data-target=".datetimepicker-datetime"
                        data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                @error('date_of_incident')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">

            <div class="form-group">

                <label for="date_of_client_complaint">Date to client complaint: (if applicable)</label>
                <div class="input-group date date_of_client_complaint" id="start_dt_2" data-target-input="nearest" >
                    <input type="text"
                        class="form-control datetimepicker-input datetimepicker"
                        data-target="#start_dt_2"
                        name="date_of_client_complaint"
                        id="date_of_client_complaint"
                        value="{{ old('date_of_client_complaint', optional($form->date_of_client_complaint)->format('d/m/Y')) }}"
                        {{ $readonly }}/>
                    <div class="input-group-append"
                        data-target="#start_dt_2"
                        data-toggle="datetimepicker"
                        >
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>

            </div>

                @error('date_of_client_complaint')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

        <div class="form-row">
            <div class="col-md-8">
                <div class="form-group">
                <label for="description">Description of incident and/or complaint</label>
                <textarea class="form-control"
                    name="description"
                    id="description"
                    rows="4"
                    {{ $readonly }}>{{
                old('description', $form->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                <label for="location_id">Location</label>
                <select class="form-control" name="location_id" id="location_id" {{ $readonly }}>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}"
                            @if (old('location_id', $form->location_id) == $location->id)
                                selected
                            @endif
                            >{{ $location->name }}</option>
                    @endforeach
                </select>

                @error('location_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>

        <div class="form-row align-items-center">

        <div class="col-md-3">

            <div class="form-group">
                <label for="complaint_category_id">Category</label>
                <select
                    class="form-control"
                    name="complaint_category_id"
                    id="complaint_category_id"
                    {{ $readonly }}>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (old('complaint_category_id', $form->complaint_category_id) == $category->id)
                                selected
                            @endif
                            >{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('complaint_category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">
                <label for="complaint_type_id">Type of complaint</label>
                <select class="form-control"
                    name="complaint_type_id"
                    id="complaint_type_id"
                    {{ $readonly }}>
                    <option></option>
                    @foreach ($types as $type)
                        <option data-category="{{ $type->complaint_category_id }}"
                            value="{{ $type->id }}"
                            @if (old('complaint_type_id', $form->complaint_type_id) == $type->id)
                                selected
                            @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('complaint_type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">
                <label for="severity">Severity</label>
                <select class="form-control"
                    name="severity"
                    id="severity"
                    {{ $readonly }}>
                    <option value=null>None</option>
                    @foreach ($severities as $key => $value)
                        <option
                            value="{{ $key }}"
                            @if (old('severity', $form->severity) == $key)
                                selected
                            @endif
                            >{{ \ucwords($value) }}</option>
                    @endforeach
                </select>
                @error('severity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">
                <label for="complaint_channel_id">Channel</label>
                <select class="form-control"
                    name="complaint_channel_id"
                    id="complaint_channel_id"
                    {{ $readonly }}>
                    <option></option>
                    @foreach ($channels as $channel)
                        <option
                            value="{{ $channel->id }}"
                            @if (old('complaint_channel_id', $form->complaint_channel_id) == $channel->id)
                                selected
                            @endif
                            >{{ $channel->name }}</option>
                    @endforeach
                </select>
                @error('complaint_channel_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

    </div>

    <div class="form-row">
        <div class="col-md-4">
            <div class="custom-file">
                <label for="documents" class="custom-file-label">Files/Documents</label>
                <input type="file"
                name="files[]"
                id="documents" multiple
                class="custom-file-input">
                @error('documents')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="files-for-upload" class='d-none mt-2'>
                <p class="font-weight-bold">Files for upload:</p>
                <div class="files"></div>
            </div>
        </div>
    </div>

    @if ($form->files)
        <div class="mb-2 col-md-4">
            <h4>Files</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Download</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $i = 1;
                    @endphp
                    @foreach ($form->files as $file)

                        @php
                            $fileInfo = explode('.', $file);
                        @endphp
                        <tr id="file-{{ $form->id . '-' . $i  }}">

                            <th>{{ $file }}</th>

                            <th>
                                <a  class="d-block mb-1"
                                    href="{{ route('complaint-form.download', [
                                    'form'      => $form->id,
                                    'file'      => $fileInfo[0],
                                    'extension' => $fileInfo[1],
                                ]) }}"><i class="fas fa-download"></i></a>
                            </th>

                            <th>
                                <a  class="d-block mb-1 file-delete"
                                    href="#"
                                    data-route="{{ route('file.delete', $form->id) }}"
                                    data-file="{{ $file }}"
                                    data-id="file-{{ $form->id . '-' . $i  }}""><i class="fas fa-trash"></i></a>
                            </th>

                        </tr>
                        @php
                            $i++
                        @endphp
                    @endforeach

                </tbody>
            </table>


        </div>
    @endif

    <button type="submit" class="btn btn-primary">Update the complaint</button>
</form>
