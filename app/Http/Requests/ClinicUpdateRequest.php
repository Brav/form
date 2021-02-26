<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClinicUpdateRequest extends FormRequest
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
            'name'                 => ['required', 'min:3', 'string',
                Rule::unique('clinics')->ignore($this->clinic->id)
            ],
            'lead_vet'              => ['required', 'numeric'],
            'practise_manager'      => ['required', 'numeric'],
            'vet_manager'           => ['required', 'numeric'],
            'gm_veterinary_options' => ['required', 'numeric'],
            'gm_region'             => ['required', 'numeric'],
            'regional_manager'      => ['required', 'numeric'],
        ];
    }
}
