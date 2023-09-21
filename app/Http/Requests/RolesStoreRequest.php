<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Roles;
use Illuminate\Validation\Rule;

class RolesStoreRequest extends FormRequest
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
            'name'  =>['required'],
            'level' =>['nullable', 'array',
                // Rule::in(Roles::$levels),
            ],
            'read'  =>['nullable', Rule::in('r')],
            'write' =>['nullable', Rule::in('w')],
            'delete'=>['nullable', Rule::in('d')],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'level.required' => 'Select at least one level for notifications',
        ];
    }
}
