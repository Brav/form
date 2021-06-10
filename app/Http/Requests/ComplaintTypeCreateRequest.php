<?php

namespace App\Http\Requests;

use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\Severity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComplaintTypeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'                  => ['required', 'min:3', 'unique:App\Models\ComplaintType,name'],
            'complaint_category_id' => ['required',
                Rule::in(ComplaintCategory::all()->pluck('id')->toArray()),
            ],
            'channel_settings_select' => ['required', Rule::in(['null', 'custom'])],
            'channel_settings'        => ['nullable'],

        ];
    }
}
