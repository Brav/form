<form
    action="{{ route('complaint-type.update', $type->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    @method('PUT')
    <input type="hidden" name="table" id=table value="complaint-types">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $type->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $type->name) }}">

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
                      <option
                        value="{{ $category->id }}"
                        @if ((int) $type->complaint_category_id === (int) $category->id)
                            selected
                        @endif
                        >{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label class="d-block">Automated Email Sending</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="channel_settings_default" name="channel_settings_select" value="null"
                    @if ($type->complaint_channels_settings === null)
                        checked
                    @endif>
                    <label class="form-check-label" for="channel_settings_default">Use default channels settings</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                    id="channel_settings_custom"
                    name="channel_settings_select" value="custom"
                    @if ($type->complaint_channels_settings !== null)
                        checked
                    @endif>

                    <label class="form-check-label" for="channel_settings_custom">Custom Settings</label>
                </div>
            </div>
        </div>

    </div>

    @if ($type->complaint_channels_settings !== null)
        <div class="form-row align-items-center" id="channel_settings">
        <div class="col">
            <div id="accordion2" role="tablist" aria-multiselectable="true">
            @foreach ($severities as $key => $value)

                @if ($key !== 'none')

                    @php
                        $channelKey = str_replace(' ',  '_', $value);
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
                                            <select class="form-control" name="channel_settings[{{ $channelKey }}][{{ $channel->id }}]" id="{{ $channel->name . '_' . $value }}">
                                                <option value="no_sending">Don't send</option>
                                                @foreach ($levels as $level)
                                                    <option
                                                        @if ($type->complaint_channels_settings[$channelKey][$channel->id]['level'] == $level)
                                                        selected
                                                    @endif>{{ $level }}</option>
                                                @endforeach
                                            </select>

                                            <select class="form-control"
                                            name="channel_settings[{{ $channelKey }}][{{ $channel->id }}][roles][]"
                                            multiple
                                                id="{{ $channel->name . '_' . $value . '_roles'}}">
                                                @foreach ($roles as $role)
                                                    <option
                                                    @if (isset($type->complaint_channels_settings[$channelKey][$channel->id]['roles']) &&
                                                    in_array($role->id, $type->complaint_channels_settings[$channelKey][$channel->id]['roles']))
                                                        selected
                                                    @endif
                                                    value={{ $role->id }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                        </div>
                    </div>
                @endif

            @endforeach

            </div>
        </div>
    </div>
    @endif


    <button type="submit" class="btn btn-primary">Update</button>
</form>
