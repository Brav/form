<form
    action="{{ route('complaint-type.store') }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="complaint-types">
    <input type="hidden" name="action" id=action value="create">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">
              <label for="complaint_category_id">Complaint Category</label>
              <select class="form-control" name="complaint_category_id" id="complaint_category_id">
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label class="d-block">Automated Email Sending</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="channel_settings_default" name="channel_settings_select" value="null" checked>
                    <label class="form-check-label" for="channel_settings_default">Use default channels settings</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                    id="channel_settings_custom"
                    name="channel_settings_select" value="custom">
                    <label class="form-check-label" for="channel_settings_custom">Custom Settings</label>
                </div>
            </div>
        </div>

    </div>

    <div class="form-row align-items-center d-none" id="channel_settings">
        <div class="col">
            <p class="text-info">
                Don't select any roles if you want for that channel to use default roles for sending emails.
            </p>
            <div id="accordion2" role="tablist" aria-multiselectable="true">
            @foreach ($severities as $key => $value)

                @php
                    $channelKey = strtolower(str_replace(' ',  '_', $value));
                @endphp
                <div class="block block-rounded mb-1">
                    <div class="block-header block-header-default" role="tab" id="accordion2_h{{ $key }}">
                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_q{{ $key }}" aria-expanded="true" aria-controls="accordion2_q{{ $key }}">
                    {{ ucwords($value) }}</a>
                    </div>
                    <div id="accordion2_q{{ $key }}" class="collapse" role="tabpanel" aria-labelledby="accordion2_h{{ $key }}" >
                    <div class="block-content">

                            @foreach ($channels as $channel)
                                <div class="form-group row">
                                    <label for="{{ $channel->name . '_' . $value }}" class="col-sm-4 col-form-label">{{ $channel->name }}</label>
                                    <div class="col-md-8">
                                        <label for="{{ $channel->name . '_' . $value }}">Level</label>
                                        <select class="form-control" name="channel_settings[{{ $channelKey }}][{{ $channel->id }}][level]" id="{{ $channel->name . '_' . $value }}">
                                            <option value="no_sending">Don't send</option>
                                            @foreach ($levels as $level)
                                                <option @if ($channel->level == $level)
                                                    selected
                                                @endif>{{ $level }}</option>
                                            @endforeach
                                        </select>

                                        <label for="{{ $channel->name . '_' . $value . '_roles'}}">Roles</label>
                                        <select class="form-control"
                                        name="channel_settings[{{ $channelKey }}][{{ $channel->id }}][roles][]"
                                        multiple
                                            id="{{ $channel->name . '_' . $value . '_roles'}}">
                                            @foreach ($roles as $role)
                                                <option value={{ $role->id }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                            <small class="form-text text-muted">Leave empty if you want to use default settings</small>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="{{ $channel->name . '_' . $value . '_additional_emails'}}">Additional emails</label>
                                          <textarea class="form-control"
                                            name="channel_settings[{{ $channelKey }}][{{ $channel->id }}]['additional_emails']"
                                            id="{{ $channel->name . '_' . $value . '_additional_emails'}}"
                                            rows="3"></textarea>
                                            <small class="form-text text-muted">Add additional user emails which will reacive notification when the complaint is created (use comma to sepparate multiple emails (test@test.com, second@test.com, another@test.com ...))</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            @endforeach

            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
