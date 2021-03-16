<form
    id=complaint_form
    action="{{ route('complaint-form.store') }}"
    method="POST">
    @csrf
    <input type=hidden name=recaptcha_token id=recaptcha_token>
    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">

                    <label for="clinic_id">Clinic Name</label>
                    <select class="form-control select2" name="clinic_id" id="clinic_id">
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}"
                            data-manager="{{ $clinic->regionalManager->name }}"
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
                    placeholder="Regional Manager"
                    readonly>
                </div>

            </div>
        </div>

        <div class="col"></div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">

            <div class="form-group">
                <label for="team_member">Team Member logging the complaint:</label>
                <input type="text"
                class="form-control"
                name="team_member"
                id="team_member"
                value="{{ old('team_member') }}"
                placeholder="Team Member logging the complaint">

                @error('team_member')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">

            <div class="form-group">
                <label for="team_member_position">Position of The Member</label>
                <input type="text"
                    class="form-control"
                    name="team_member_position"
                    id="team_member_position"
                    value="{{ old('team_member_position') }}"
                    placeholder="Position of the Member">

                    @error('team_member_position')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>

        </div>

        <div class="col"></div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">

            <div class="form-group">
                <label for="client_name">Client / Owner Name:</label>
                <input type="text"
                class="form-control"
                name="client_name"
                id="client_name"
                value="{{ old('client_name') }}"
                placeholder="Client / Owner Name">
                @error('client_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text"
                    class="form-control"
                    name="patient_name"
                    id="patient_name"
                    value="{{ old('patient_name') }}"
                    placeholder="Patient Name">
                @error('patient_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">

            <div class="form-group">
                <label for="pms_code">PMS Code</label>
                <input type="text"
                    class="form-control"
                    name="pms_code"
                    id="pms_code"
                    value="{{ old('pms_code') }}"
                    placeholder="PMS Code">
                @error('pms_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

    </div>

    <div class="form-row">

        <div class="col">
            <div class="form-group">
                <label for="date_of_incident">Date of the incident</label>
                <div class="input-group date date_of_incident" data-target-input="nearest">

                    <input type="text"
                        class="form-control datetimepicker-input"
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

        <div class="col">
            <div class="form-group">
                <label for="date_of_client_complaint">Date if client complaint: (if applicable)</label>
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

        <div class="col"></div>

    </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                <label for="description">Decription of incident and/or complaint</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{
                old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                <label for="location_id">Location</label>
                <select class="form-control" name="location_id" id="location_id">
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
            <div class="col"></div>
            <div class="col"></div>
        </div>

        <div class="form-row align-items-center">

        <div class="col">

            <div class="form-group">
                <label for="complaint_category_id">Category</label>
                <select class="form-control" name="complaint_category_id" id="complaint_category_id">
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

        <div class="col">

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

        <div class="col">

            <div class="form-group">
                <label for="complaint_channel_id">Channel</label>
                <select class="form-control" readonly disabled name="complaint_channel_id" id="complaint_channel_id">
                    <option></option>
                    @foreach ($channels as $channel)
                        <option data-type="{{ $channel->complaint_type_id }}"
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
    @if($errors->has('recaptcha_token'))
        {{$errors->first('recaptcha_token')}}
    @endif
    <button type="submit" class="btn btn-primary">Submit a complaint</button>
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
