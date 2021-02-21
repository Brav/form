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
            'level' =>['required',
                Rule::in(Roles::$levels),
            ],
            'read'  =>['nullable', Rule::in('r')],
            'write' =>['nullable', Rule::in('w')],
            'delete'=>['nullable', Rule::in('d')],
        ];
    }
}
