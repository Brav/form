<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicCreateRequest extends FormRequest
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
        // dd($this->request->all());
        return [
            'name'                     => ['required', 'min:3', 'string', 'unique:App\Models\Clinic,name'],
            'lead_vet'                 => ['required'],
            'lead_vet.*'               => ['numeric'],
            'practice_manager'         => ['required', 'numeric'],
            'veterinary_manager'       => ['required', 'numeric'],
            'gm_veterinary_operations' => ['required', 'numeric'],
            'general_manager'          => ['required', 'numeric'],
            'regional_manager'         => ['required', 'numeric'],
            'gm_vet_services'          => ['required', 'numeric'],
            'other'                    => ['nullable', 'numeric'],
        ];
    }
}
