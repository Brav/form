<h1>Complaints Reporting Form</h1>

<form
    id=complaint_form
    class="max-1024"
    action="{{ route('complaint-form.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input
        type="file"
        name="documents[]"
        id="hidden-documents"
        multiple
        class="d-none"
        >
    <input type=hidden name=recaptcha_token id=recaptcha_token>
    <div class="form-row align-items-center">

        <div class="col-md-4">
            <div class="form-group">
                    <label for="clinic_id">Clinic Name</label>
                    <select class="form-control select2" name="clinic_id" id="clinic_id">
                    <option></option>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}"
                            data-manager="{{ $clinic->regionalManager ?
                                $clinic->regionalManager->first()->user->name : '' }}"

                            data-veterinary="{{ $clinic->vetManager ?
                                $clinic->vetManager->first()->user->name : '' }}"

                            data-general="{{ $clinic->generalManager ?
                                $clinic->generalManager->first()->user->name : '' }}"
                            @if (old('clinic_id') == $clinic->id)
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

        <div class="col">
            <div class="form-group">

                <div class="form-group">
                    <label for="regional_manager">Regional Manager</label>
                    <input type="text"
                    class="form-control" name="regional_manager"
                    id="regional_manager"
                    readonly>
                </div>

            </div>
        </div>

        <div class="col">
            <div class="form-group">

                <div class="form-group">
                    <label for="veterinary_manager">Veterinary Manager</label>
                    <input type="text"
                    class="form-control" name="veterinary_manager"
                    id="veterinary_manager"
                    readonly>
                </div>

            </div>
        </div>

        <div class="col">
            <div class="form-group">

                <div class="form-group">
                    <label for="general_manager">General Manager</label>
                    <input type="text"
                    class="form-control" name="general_manager"
                    id="general_manager"
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
                value="{{ old('team_member') }}">

                @error('team_member')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member_email">Email of Team Member</label>
                <input type="email"
                    class="form-control"
                    name="team_member_email"
                    id="team_member_email"
                    value="{{ old('team_member_email') }}">

                    @error('team_member_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member_position">Position of Team Member</label>
                <input type="text"
                    class="form-control"
                    name="team_member_position"
                    id="team_member_position"
                    value="{{ old('team_member_position') }}">

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
                value="{{ old('client_name') }}">
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
                    value="{{ old('patient_name') }}">
                @error('patient_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-8">

            <div class="form-group">
                <label for="pms_code">PMS Code</label>
                <input type="text"
                    class="form-control"
                    name="pms_code"
                    id="pms_code"
                    value="{{ old('pms_code') }}">
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
                        class="form-control datetimepicker-input datetimepicker"
                        data-target=".date_of_incident"
                        name="date_of_incident"
                        id="date_of_incident"
                        value="{{ old('date_of_incident') }}"/>
                    <div class="input-group-append"
                        data-target=".date_of_incident"
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
                <label for="date_of_client_complaint">Date of client complaint: (if applicable)</label>
                <div class="input-group date date_of_client_complaint" id="start_dt_2" data-target-input="nearest" >
                    <input type="text"
                        class="form-control datetimepicker-input datetimepicker"
                        data-target="#start_dt_2"
                        name="date_of_client_complaint"
                        id="date_of_client_complaint"
                        value="{{ old('date_of_client_complaint') }}"/>
                    <div class="input-group-append"
                        data-target="#start_dt_2"
                        data-toggle="datetimepicker">
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
            <textarea class="form-control" name="description" id="description" rows="4">{{
            old('description') }}</textarea>
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
            <select class="form-control" name="location_id" id="location_id">
                <option></option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}"
                        @if (old('location_id') == $location->id)
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

        <div class="col-md-4">

            <div class="form-group">
                <label for="complaint_category_id">Category</label>
                <select class="form-control" name="complaint_category_id" id="complaint_category_id">
                    <option></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (old('complaint_category_id') == $category->id)
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

        <div class="col-md-4">

            <div class="form-group">
                <label for="complaint_type_id">Type of complaint</label>
                <select class="form-control" name="complaint_type_id" id="complaint_type_id">
                    <option></option>
                    @foreach ($types as $type)
                        <option data-category="{{ $type->complaint_category_id }}"
                            value="{{ $type->id }}"
                            @if (old('complaint_type_id') == $type->id)
                                selected
                            @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('complaint_type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>
     <div class="form-row align-items-center">

        <div class="col-md-4">

            <div class="form-group">
                <label for="severity_id">Severity</label>
                <select class="form-control" name="severity_id" id="severity_id">
                    @foreach ($severities as $severity)
                        <option
                            value="{{ $severity->id }}"
                            @if (old('severity_id') == $severity->id)
                                selected
                            @endif
                            >{{ \ucwords($severity->name) }}</option>
                    @endforeach
                </select>
                @error('severity_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="complaint_channel_id">Channel</label>
                <select class="form-control" name="complaint_channel_id" id="complaint_channel_id">
                    <option></option>
                    @foreach ($channels as $channel)
                        <option
                            value="{{ $channel->id }}"
                            @if (old('complaint_channel_id') == $channel->id)
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

    @if($errors->has('recaptcha_token'))
        {{$errors->first('recaptcha_token')}}
    @endif
    <button type="submit" class="btn btn-hero-primary mt-3">Submit a complaint</button>

            <div class="d-block pb-5"></div>
</form>

@section('js_after')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.api_site_key') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('recaptcha.api_site_key') }}', {action: "complaint_form"})
                .then(function(token) {
                    document.getElementById("recaptcha_token").value = token;
                });
        });
    </script>
@endsection
