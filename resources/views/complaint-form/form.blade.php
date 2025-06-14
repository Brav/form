@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="block-content">

                <form
                    class="max-1024"
                    action="{{ route('complaint-form.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-row align-items-center">

                        <div class="col-md-4">
                            <div class="form-group">

                                  <label for="clinic_id">Clinic Name</label>
                                  <select class="form-control select2" name="clinic_id" id="clinic_id">
                                    @foreach ($clinics as $clinic)
                                        <option value="{{ $clinic->id }}"
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
                                value="{{ old('team_member') }}"
                                placeholder="Team Member logging the complaint">

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
                                    value="{{ old('team_member_position') }}"
                                    placeholder="Position of the Member">

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
                                value="{{ old('client_name') }}"
                                placeholder="Client / Owner Name">
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
                                    value="{{ old('patient_name') }}"
                                    placeholder="Patient Name">
                                @error('patient_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="pms_code">Patient Number</label>
                                <input type="text"
                                    class="form-control"
                                    name="pms_code"
                                    id="pms_code"
                                    value="{{ old('pms_code') }}"
                                    placeholder="Patient Number">
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
                                <div class="input-group date datetimepicker-datetime" data-target-input="nearest">

                                    <input type="text"
                                        class="form-control datetimepicker-input"
                                        data-target=".datetimepicker-datetime"
                                        name="date_of_incident"
                                        id="date_of_incident"
                                        value="{{ old('date_of_incident') }}"/>
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
                                <label for="date_of_client_complaint">Date of client complaint: (if applicable)</label>
                                <div class="input-group date timepicker1" id="start_dt_2" data-target-input="nearest" >
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
                                <label for="description">Summary of incident and/or complain</label>
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

                    <button type="submit" class="btn btn-hero-primary mt-3">Submit a complaint</button>
                </form>
                <div class="d-block pb-5"></div>

        </div>
    </div>


@endsection
