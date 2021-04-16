<form action="{{ route('clinics.update', $clinic->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Clinic Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name', $clinic->name) }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row align-items-center">

        <div class="col">
             <div class="form-group">
                <label for="lead_vet">Lead Vet</label>
                <select class="form-control select2"
                    name=lead_vet[]
                    multiple
                    id="lead_vet">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id, old("lead_vet", $clinic->leadVet->pluck('user_id')->toArray())))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="practise_manager">Practise Manager</label>
                <select class="form-control select2" name=practise_manager id="practise_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("practise_manager", $clinic->practiseManager->pluck('user_id')->toArray())))
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="vet_manager">Vet Manager</label>
                <select class="form-control select2" name=vet_manager id="vet_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("vet_manager", $clinic->vetManager->pluck('user_id')->toArray())))
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

     <div class="form-row align-items-center">

        <div class="col">
             <div class="form-group">
                <label for="gm_veterinary_operations">GM Veterinary Operations</label>
                <select class="form-control select2" name=gm_veterinary_operations id="gm_veterinary_operations">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("gm_veterinary_operations", $clinic->gmVeterinaryOperation->pluck('user_id')->toArray())))
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="general_manager">General Manager</label>
                <select class="form-control select2"
                    name=general_manager
                    id="general_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("general_manager", $clinic->generalManager->pluck('user_id')->toArray())))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="regional_manager">Regional Manager</label>
                <select class="form-control select2" name=regional_manager id="regional_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("regional_manager", $clinic->regionalManager->pluck('user_id')->toArray())))
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('regional_manager')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-row align-items-center">

        <div class="col">
             <div class="form-group">
                <label for="gm_vet_services">GM Vet Services</label>
                <select class="form-control select2"
                    name=gm_vet_services
                    id="gm_vet_services">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("gm_vet_services", $clinic->gmVetServicesManager->pluck('user_id')->toArray())))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="other">GM Vet Services</label>
                <select class="form-control select2"
                    name=other
                    id="other">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("other", $clinic) == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col"></div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
