<?php

namespace App\Http\Requests;

use App\Models\ComplaintChannel;
use App\Models\Severity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComplaintCategoryUpdateRequest extends FormRequest
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
            'name' => ['required', 'min:3',
                Rule::unique('complaint_categories')->ignore($this->complaint->id)
            ],
            'channels'     => ['nullable',],
            'channels.*'   => [Rule::in(ComplaintChannel::all()->pluck('id')->toArray())],
            'severities'   => ['nullable'],
            'severities.*' => [Rule::in(Severity::all()->pluck('id')->toArray())],
        ];
    }
}
