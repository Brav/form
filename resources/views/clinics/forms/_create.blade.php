<form action="{{ route('clinics.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Clinic Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row align-items-center">

        <div class="col">
             <div class="form-group">
                <label for="lead_vet">Lead Vet</label>
                <select class="form-control select2"
                    multiple
                    name="lead_vet[]"
                    id="lead_vet">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (in_array($user->id, old("lead_vet") ?? []))
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('lead_vet')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="practice_manager">Practice Manager</label>
                <select class="form-control select2" name=practice_manager id="practice_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("practice_manager") == $user->id)
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('practice_manager')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="veterinary_manager">Vet Manager</label>
                <select class="form-control select2" name=veterinary_manager id="veterinary_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("veterinary_manager") == $user->id)
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('veterinary_manager')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                            @if (old("gm_veterinary_operations") == $user->id)
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('gm_veterinary_operations')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                            @if (old("general_manager") == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="regional_manager">Regional Manager</label>
                <select class="form-control select2"
                    name=regional_manager
                    id="regional_manager">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("regional_manager") == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
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
                            @if (old("gm_vet_services") == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('gm_vet_services')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                            @if (old("other") == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('other')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col"></div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
