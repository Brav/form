<h1>Complaints Reporting Form Update</h1>

<form
    class="max-1024"
    action="{{ route('complaint-form.update', $form->id) }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if(auth()->user()->role->name === 'New Zealand Maintenance')
        <fieldset disabled="disabled">
    @endif
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

    <fieldset class="p-4 mb-4 mt-4 border border-primary bg-light" style="background: #e0e0e0 !important;">

        <legend style="width: fit-content; padding: 0 10px" >Outcome Updates</legend>

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
                        id="outcomeOptions-{{ $option->selectName }}"
                              @if ($readOnlyOutcomes === 'readonly')
                                  disabled="disabled"
                              @endif

                          {{ $readOnlyOutcomes }}>
                      >
                        <option></option>
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
                    <label for="outcome"><strong>Update or outcome of incident/complaint</strong>
                        <span class="font-weight-normal"> - please date each additional entry </span></label>
                  <textarea class="form-control"
                    name="outcome"
                    id="outcome"
                    rows="5"
                    @if ($readOnlyOutcomes === 'readonly')
                        disabled="disabled"
                     @endif

                    {{ $readOnlyOutcomes }}
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
                    @if ($readOnlyOutcomes === 'readonly')
                        disabled="disabled"
                     @endif

                    {{ $readOnlyOutcomes }}
                    value="{{ old('completed_by', $form->completed_by) }}">
                    @error('completed_by')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">

                    <label for="date_completed">Date completed</label>
                    @if($readOnlyOutcomes)
                        <input class="form-control"
                               type="text"
                               disabled
                               readonly
                               value="{{ old('date_completed', optional($form->date_completed)->format('d/m/Y')) }}"
                        >
                    @else
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
                    @endif

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

        <button type="submit" class="btn btn-primary mt-3 mb-3">Update the complaint</button>

    </fieldset>

    <div class="form-row align-items-center">

        <div class="col-md-4">
            <div class="form-group">

                    <label for="clinic_id">Clinic Name *</label>
                    <select class="form-control @if ($readonly !== 'readonly')
                        select2
                    @endif"
                        id="clinic_id"

                        @if ($readonly === 'readonly')
                            disabled="disabled"
                        @endif

                        @if ($readonly !== 'readonly')
                            name="clinic_id"
                        @endif

                        {{ $readonly }}>
                        <option></option>
                        @foreach ($clinics as $clinic)


                            @php
                                $vetManagers = [];
                                $generalManagers = [];
                            @endphp

                            @foreach($clinic->vetManager ?? [] as $manager)
                                @php
                                    $vetManagers[] = $manager?->user?->name ?? ''
                                @endphp
                            @endforeach

                            @foreach($clinic->generalManager ?? [] as $manager)
                                @php
                                    $generalManagers[] = $manager?->user?->name ?? ''
                                @endphp
                            @endforeach

                            <option value="{{ $clinic->id }}"
                                data-manager="{{
                                    $clinic->regionalManager ? $clinic->regionalManager->first()->user->name ?? '' : '' }}"

                                    data-veterinary="{{ trim(implode(', ', $vetManagers), ',') }}"

                                    data-general="{{ trim(implode(',', $generalManagers), ',') }}"

                                @if (old('clinic_id', $form->clinic_id) == $clinic->id)
                                    selected
                                @endif
                                >{{ $clinic->name }}</option>
                        @endforeach
                    </select>

                    @if ($readonly === 'readonly')
                        <input type="hidden" name="clinic_id" value="{{ $form->clinic_id }}">
                    @endif

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
                    class="form-control"
                    name="regional_manager"
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
                <label for="team_member">Team Member logging the complaint: *</label>
                <input type="text"
                class="form-control"
                name="team_member"
                id="team_member"
                value="{{ old('team_member', $form->team_member) }}"
                {{ $readonly }}>

                @error('team_member')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member_email">Email of Team Member *</label>
                <input type="email"
                    class="form-control"
                    name="team_member_email"
                    id="team_member_email"
                    value="{{ old('team_member_email', $form->team_member_email) }}"
                    {{ $readonly }}>

                    @error('team_member_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="team_member_position">Position of Team Member *</label>
                <input type="text"
                    class="form-control"
                    name="team_member_position"
                    id="team_member_position"
                    value="{{ old('team_member_position', $form->team_member_position) }}"
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
                <label for="client_name">Client / Owner Name: *</label>
                <input type="text"
                class="form-control"
                name="client_name"
                id="client_name"
                value="{{ old('client_name', $form->client_name) }}"
                {{ $readonly }}>
                @error('client_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="patient_name">Patient Name *</label>
                <input type="text"
                    class="form-control"
                    name="patient_name"
                    id="patient_name"
                    value="{{ old('patient_name', $form->patient_name) }}"
                    {{ $readonly }}>
                @error('patient_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="animal_id">Species *</label>
                <select class="form-control" name="animal_id" id="animal_id" {{ $readonly }}>
                @foreach ($animals as $animal)
                    <option value="{{ $animal->id }}"
                        @if (old('animal_id') == $animal->id)
                            selected
                        @endif
                        >{{ $animal->name }}</option>
                @endforeach
                <option value="other">Other</option>
            </select>

            @error('animal_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="pms_code">Patient Number *</label>
                <input type="text"
                    class="form-control"
                    name="pms_code"
                    id="pms_code"
                    value="{{ old('pms_code', $form->pms_code) }}"
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
                <label for="date_of_incident">Date of the incident *</label>
                <div class="input-group date date_of_incident" data-target-input="nearest">

                    <input type="text"
                        class="form-control datetimepicker-input"
                        data-target=".datetimepicker-datetime"
                        name="date_of_incident"
                        id="date_of_incident"
                        value="{{ old('date_of_incident', $form->date_of_incident->format('d/m/Y')) }}"
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

                <label for="date_of_client_complaint">Date of client complaint: (if applicable)</label>
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
            <label for="description">Summary of incident and/or complain *</label>
            <textarea class="form-control"
                name="description"
                id="description"
                rows="4"
                minlength="2"
                maxlength="250"
                {{ $readonly }}>{{
            old('description', $form->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>
    </div>

    <div class="form-row">

        <div class="col-md-6">
            <div class="form-group">
            <label for="aggression_choice">Has there been any client aggression? *</label>
            <select class="form-control no-keyboard" name="aggression_choice" id="aggression_choice" {{ $readonly }}>
                <option value="no"
                    @if (old('aggression_choice') === 'no')
                        selected
                    @endif
                >No</option>
                <option value="yes"
                    @if (old('aggression_choice') === 'yes' || $form->aggression)
                        selected
                    @endif
                >Yes</option>
            </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
            <label for="aggression">If Yes, select type of aggression?</label>

            <select
                @if (old('aggression_choice') !== 'yes' && !$form->aggression)
                    disabled
                @endif
                class="form-control no-keyboard" name="aggression" id="aggression">
                @foreach ($aggressions as $key => $value)

                    <option
                    @if (old('aggression', $form->aggression) == $key)
                            selected
                        @endif
                    value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>

            </div>
        </div>


    </div>

    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">

            <label for="formal_complaint_lodged">Has a complaint been lodged *</label>
            <select class="form-control no-keyboard" name="formal_complaint_lodged" id="formal_complaint_lodged" {{$readonly}}>
                <option value="no"
                    @if (old('formal_complaint_lodged', $form->formal_complaint_lodged ? 'yes' : 'no') === 'no')
                        selected
                    @endif>No</option>

                <option value="yes"
                @if (old('formal_complaint_lodged', $form->formal_complaint_lodged ? 'yes' : 'no') === 'yes')
                    selected
                @endif>Yes</option>

            </select>

            @error('formal_complaint_lodged')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>
    </div>

    <div class="form-row align-items-center">

        <div class="col-md-3">

            <div class="form-group">
                <label for="complaint_category_id">Category *</label>
                <select
                    class="form-control"
                    id="complaint_category_id"
                    @if ($readonly === 'readonly')
                        disabled="disabled"
                    @endif

                    @if ($readonly !== 'readonly')
                        name="complaint_category_id"
                    @endif
                    {{ $readonly }}>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"

                            @if ($category->values_used)

                                @if ($category->values_used['channels'])
                                        data-channels="{{ json_encode($category->values_used['channels']) }}"
                                @endif

                                @if ($category->values_used['severities'])
                                    data-severities="{{ json_encode($category->values_used['severities']) }}"
                                @endif

                            @endif

                            @if (old('complaint_category_id', $form->complaint_category_id) == $category->id)
                                selected
                            @endif
                            >{{ $category->name }}</option>
                    @endforeach
                </select>

                @if ($readonly === 'readonly')
                    <input type="hidden" name="complaint_category_id" value="{{ $form->complaint_category_id }}">
                @endif

                @error('complaint_category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">
                <label for="complaint_type_id">Type of complaint *</label>
                <select class="form-control"
                    id="complaint_type_id"

                    @if ($readonly === 'readonly')
                        disabled="disabled"
                    @endif

                    @if ($readonly !== 'readonly')
                        name="complaint_type_id"
                    @endif

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

                @if ($readonly === 'readonly')
                    <input type="hidden" name="complaint_type_id" value="{{ $form->complaint_type_id }}">
                @endif
                @error('complaint_type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        </div>

        <div class="form-row d-none" id="other-type-of-complaint-container">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="other_type_of_complaint">Please describe type of complaint *</label>
                    <input class="form-control"
                        name="other_type_of_complaint"
                        id="other_type_of_complaint"
                        minlength="2"
                        maxlength="250"
                        value="{{ old('other_type_of_complaint', $form->other_type_of_complaint) }}"
                    />

                    @error('other_type_of_complaint')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-row d-none" id="near-miss-description-container">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="near_miss_description">Near miss description *</label>
                    <input class="form-control"
                           name="near_miss_description"
                           id="near_miss_description"
                           minlength="2"
                           maxlength="250"
                           value="{{old('near_miss_description', $form->near_miss_description) }}" />
                    @error('near-miss-description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

     <div class="form-row align-items-center">

        <div class="col-md-4">

            <div class="form-group">
                <label for="severity_id">Severity *</label>
                <select class="form-control"

                    id="severity_id"

                    @if ($readonly === 'readonly')
                        disabled="disabled"
                    @endif

                    @if ($readonly !== 'readonly')
                        name="severity_id"
                    @endif

                    {{ $readonly }}>
                    @foreach ($severities as $severity)
                        <option
                            value="{{ $severity->id }}"
                            @if (old('severity_id', $form->severity_id) == $severity->id)
                                selected
                            @endif
                            >{{ \ucwords($severity->name) }}</option>
                    @endforeach
                </select>

                @if ($readonly === 'readonly')
                    <input type="hidden" name="severity_id" value="{{ $form->severity_id }}">
                @endif

                @error('severity_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

         <div class="col-md-4">

             <div class="form-group">
                 <label for="patient_injury_type_id">Patient Injury Type (if applicable)</label>
                 <select class="form-control no-keyboard"
                         name="patient_injury_type_id"

                         @if ($readonly === 'readonly')
                             disabled="disabled"
                         @endif

                         @if ($readonly !== 'readonly')
                             name="patient_injury_type_id"
                     @endif

                     {{ $readonly }}>
                 >
                     <option></option>
                     @foreach ($patientInjuryTypes as $type)
                         <option
                             value="{{ $type->id }}"
                             @if (old('patient_injury_type_id') == $type->id)
                                 selected
                             @endif
                         >{{ \ucwords($type->name) }}</option>
                     @endforeach
                 </select>

                 @if ($readonly === 'readonly')
                     <input type="hidden" name="patient_injury_type_id" value="{{ $form->patient_injury_type_id }}">
                 @endif
                 @error('patient_injury_type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
             </div>

         </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="complaint_channel_id">Channel *</label>
                <select class="form-control"
                    id="complaint_channel_id"

                    @if ($readonly === 'readonly')
                        disabled="disabled"
                    @endif

                    @if ($readonly !== 'readonly')
                        name="complaint_channel_id"
                    @endif

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

                    @if ($readonly === 'readonly')
                        <input type="hidden" name="complaint_channel_id" value="{{ $form->complaint_channel_id }}">
                    @endif
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
        <div class="mt-4 mb-4 bg-white p-4">
            <h4>Files</h4>
            <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Download</th>

                        @if (auth()->user()->admin)
                            <th scope="col">Delete</th>
                        @endif

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
                                    'form'  => $form->id,
                                    'file' => $file,
                                ]) }}"><i class="fas fa-download"></i></a>
                            </th>

                            @if (auth()->user()->admin)
                                <th>
                                    <a  class="d-block mb-1 file-delete"
                                        href="#"
                                        data-route="{{ route('file.delete', $form->id) }}"
                                        data-file="{{ $file }}"
                                        data-id="file-{{ $form->id . '-' . $i  }}""><i class="fas fa-trash"></i></a>
                                </th>
                            @endif

                        </tr>
                        @php
                            $i++
                        @endphp
                    @endforeach

                </tbody>
            </table>


        </div>
    @endif

    <button type="submit" class="btn btn-primary mt-3 mb-3">Update the complaint</button>
    @if(auth()->user()->role->name === 'New Zealand Maintenance')
        </fieldset>
    @endif
</form>
