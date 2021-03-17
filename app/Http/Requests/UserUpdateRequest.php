<?php

namespace App\Http\Requests;

use App\Models\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $createdBy = auth()->user()->admin ? 'required' : 'nullable';

        return [
            'name'       =>['required', 'string', 'min:2'],
            'email'      =>['required', 'email',
                                Rule::unique('users')->ignore($this->user->id)
                            ],
            'password'   =>['nullable', 'min:10', 'string'],
            'role_id'    =>['exclude_if:admin,1', Rule::in(
                    Roles::all()->pluck('id')->toArray()
                )],
            'can_login' => ['nullable', Rule::in([1])],
            'admin'      => ['nullable', Rule::in([1])],
            'created_by' => [$createdBy, function ($attribute, $value, $fail) {
                                if( is_numeric( $value ) || 'none' === $value ) {
                                    return true;
                                } else {
                                    $fail($attribute.' is invalid.');
                                }
                            }],
        ];
    }
}
