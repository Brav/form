<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AutomatedCountryEmailRequest extends FormRequest
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
            'country' => ['required', 'string', 'min:3', Rule::unique('automated_country_emails')->ignore($this->response?->id)],
            'emails' => ['required', 'string',],
            'body.*'  => ['nullable', 'string'],
        ];
    }
}