@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <form
                    action="{{ route('complaint-form.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-row align-items-center">

                        <div class="col">
                            <div class="form-group">

                                  <label for="clinic_id">Clinic Name</label>
                                  <select class="form-control select2" name="clinic_id" id="clinic_id">
                                    @foreach ($clinics as $clinic)
                                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
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

                    </div>

                    <div class="form-row align-items-center">

                        <div class="col">

                            <div class="form-group">
                                <label for="team_member">Team Member logging the complaint:</label>
                                <input type="text"
                                class="form-control"
                                name="team_member"
                                id="team_member"
                                placeholder="Team Member logging the complaint">
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="team_member_position">Position of The Member</label>
                                <input type="text"
                                    class="form-control"
                                    name="team_member_position"
                                    id="team_member_position"
                                    aria-describedby="helpId"
                                    placeholder="Position of the Member">
                            </div>

                        </div>

                    </div>

                    <div class="form-row align-items-center">

                        <div class="col">

                            <div class="form-group">
                                <label for="client_name">Client / Owner Name:</label>
                                <input type="text"
                                class="form-control"
                                name="client_name"
                                id="client_name"
                                placeholder="Client / Owner Name">
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="patient_name">Patient Name</label>
                                <input type="text"
                                    class="form-control"
                                    name="patient_name"
                                    id="patient_name"
                                    placeholder="Patient Name">
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="pms_code">PMS Code</label>
                                <input type="text"
                                    class="form-control"
                                    name="pms_code"
                                    id="pms_code"
                                    placeholder="PMS Code">
                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col">
                            <div class="form-group">
                                <label for="date_of_incident">Date of the incident</label>
                                <div class="input-group date datetimepicker-datetime" data-target-input="nearest">

                                    <input type="text"
                                        class="form-control datetimepicker-input"
                                        data-target=".datetimepicker-datetime"
                                        name="date_of_incident"
                                        id="date_of_incident"/>
                                    <div class="input-group-append"
                                        data-target=".datetimepicker-datetime"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="date_of_incident">Date if client complaint: (if applicable)</label>
                                <div class="input-group date timepicker1" id="start_dt_2" data-target-input="nearest" >
                                    <input type="text"
                                        class="form-control datetimepicker-input datetimepicker"
                                        data-target="#start_dt_2"
                                        name="date_of_client_complaint"
                                        id="date_of_client_complaint"/>
                                        <div class="input-group-append"
                                        data-target="#start_dt_2"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                     <div class="form-row">
                         <div class="col">
                             <div class="form-group">
                               <label for="">Decription of incident and/or complaint</label>
                               <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                             </div>
                         </div>
                     </div>

                     <div class="form-row align-items-center">

                        <div class="col">

                            <div class="form-group">
                              <label for="complaint_category_id">Category</label>
                              <select class="form-control" name="complaint_category_id" id="complaint_category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                              <label for="complaint_type_id">Type of complaint</label>
                              <select class="form-control" name="complaint_type_id" id="complaint_type_id">
                                    <option></option>
                                    @foreach ($types as $type)
                                        <option data-category="{{ $type->complaint_category_id }}"

                                            value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                              </select>
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                              <label for="complaint_channel_id">Channel</label>
                              <select class="form-control" readonly disabled name="complaint_channel_id" id="complaint_channel_id">
                                <option></option>
                                @foreach ($channels as $channel)
                                    <option data-type="{{ $channel->complaint_type_id }}"

                                        value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                              </select>
                            </div>

                        </div>

                     </div>

                    <button type="submit" class="btn btn-primary">Submit a complaint</button>
                </form>

            </div>
        </div>
    </div>


@endsection
