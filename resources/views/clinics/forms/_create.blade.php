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
                    name=lead_vet
                    id="lead_vet">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("lead_vet") == $user->id)
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
                            @if (old("practise_manager") == $user->id)
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
                            @if (old("vet_manager") == $user->id)
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
                <label for="gm_veterinary_options">GM Veterinary Option</label>
                <select class="form-control select2" name=gm_veterinary_options id="gm_veterinary_options">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("gm_veterinary_options") == $user->id)
                                selected
                            @endif
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
             <div class="form-group">
                <label for="gm_region">GM Region</label>
                <select class="form-control select2"
                    name=gm_region
                    id="gm_region">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            @if (old("gm_region") == $user->id)
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

    <button type="submit" class="btn btn-primary">Create</button>
</form>
