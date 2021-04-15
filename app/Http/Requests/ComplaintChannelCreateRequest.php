<?php

namespace App\Http\Requests;

use App\Models\ComplaintType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComplaintChannelCreateRequest extends FormRequest
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
            'name'              => ['required', 'min:3', 'unique:App\Models\ComplaintChannel,name'],
            'level' => ['nullable',
                Rule::in([1, 2, 3, "None"]),
            ],
        ];
    }
}
