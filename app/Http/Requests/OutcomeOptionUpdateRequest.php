<?php

namespace App\Http\Requests;

use App\Models\OutcomeOptionsCategories;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OutcomeOptionUpdateRequest extends FormRequest
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
            'name'        => ['required', 'string', 'min:3', 'max:255',
                Rule::unique('outcome_options')->ignore($this->option->id)
            ],
            'category_id' => ['required',
                Rule::in(OutcomeOptionsCategories::all()->pluck('id')->toArray())]
            ];
    }
}
