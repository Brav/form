<?php

namespace App\Http\Requests;

use App\Models\ComplaintCategory;
use App\Models\Severity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComplaintTypeUpdateRequest extends FormRequest
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
        dd(\implode(',', \array_keys(Severity::SEVERITIES)));
        return [
            'name' => ['required', 'min:3',
                Rule::unique('complaint_types')->ignore($this->type->id)
            ],
            'complaint_category_id' => ['required',
                Rule::in(ComplaintCategory::all()->pluck('id')->toArray()),
            ],
            'level' => ['required',
                Rule::in(\array_keys(Severity::SEVERITIES)),
            ],
        ];
    }
}
