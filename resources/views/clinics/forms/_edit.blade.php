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
                            @if (in_array($user->id, old("lead_vet",
                                 $clinic->leadVet ? $clinic->leadVet->pluck('user_id')->toArray() : [])))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="practice_manager">Practice Manager</label>
                <select class="form-control select2" name=practice_manager id="practice_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("practice_manager",
                                    $clinic->practiseManager ? $clinic->practiseManager->pluck('user_id')->toArray()
                                    : [])))
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="veterinary_manager">Vet Manager</label>
                <select class="form-control select2" name=veterinary_manager id="veterinary_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("veterinary_manager",
                                $clinic->vetManager ? $clinic->vetManager->pluck('user_id')->toArray() : [])))
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
                                old("gm_veterinary_operations",
                                    $clinic->gmVeterinaryOperation ?
                                        $clinic->gmVeterinaryOperation->pluck('user_id')->toArray() : [])))
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
                                old("general_manager",
                                    $clinic->generalManager ?
                                        $clinic->generalManager->pluck('user_id')->toArray() : [])))
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
                                old("regional_manager",
                                    $clinic->regionalManager ?
                                        $clinic->regionalManager->pluck('user_id')->toArray() : [] )))
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
                                old("gm_vet_services",
                                    $clinic->gmVetServicesManager ?
                                        $clinic->gmVetServicesManager->pluck('user_id')->toArray() : [])))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="other">Other</label>
                <select class="form-control select2"
                    name=other
                    id="other">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id,
                                old("other",
                                    $clinic->other ?
                                        $clinic->other->pluck('user_id')->toArray() : [])))
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
