<?php

namespace App\Http\Requests;

use App\Models\Clinic;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ComplaintFormCreateRequest extends FormRequest
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
            'clinic_id' => ['required',
                Rule::in(Clinic::all()->pluck('id')->toArray()),
            ],
            'team_member'          => ['required', 'string', 'min:2'],
            'team_member_position' => ['required', 'string', 'min:2'],
            'client_name' => ['required', 'string', 'min:2'],

        ];
    }
}
