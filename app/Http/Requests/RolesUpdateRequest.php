<?php

namespace App\Http\Requests;

use App\Models\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RolesUpdateRequest extends FormRequest
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
            'name'  =>['required',
                Rule::unique('roles')->ignore($this->roles->id)
            ],
            'level' =>['required', 'array',
                function ($attribute, $value, $fail) {
                    if(max($value) > max(Roles::$levels) ||
                        min($value) < min(Roles::$levels)
                    )
                    {
                        $fail('Level is outside the range');
                    }
                },
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
