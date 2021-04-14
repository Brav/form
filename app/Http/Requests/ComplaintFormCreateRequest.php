<?php

namespace App\Http\Requests;

use App\Models\Clinic;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\Location;
use App\Models\Severity;
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
            'team_member'              => ['required', 'string', 'min:2'],
            'team_member_position'     => ['required', 'string', 'min:2'],
            'client_name'              => ['required', 'string', 'min:2'],
            'patient_name'             => ['required', 'string', 'min:2'],
            'pms_code'                 => ['required', 'string', 'min:2'],
            'date_of_incident'         => ['required', 'date_format:d/m/Y g:i A'],
            'date_of_client_complaint' => ['nullable', 'date_format:d/m/Y'],
            'description'              => ['required', 'string', 'min:2'],
            'location_id'              => ['required',
                Rule::in(Location::all()->pluck('id')->toArray()),
            ],
            'complaint_category_id' => ['required',
                Rule::in(ComplaintCategory::all()->pluck('id')->toArray()),
            ],
            'complaint_type_id' => ['nullable',
                Rule::in(ComplaintType::all()->pluck('id')->toArray()),
            ],
            'complaint_channel_id' => ['nullable',
                Rule::in(ComplaintChannel::all()->pluck('id')->toArray()),
            ],
            'recaptcha_token' => ['required', new   \App\Rules\ReCaptchaRule($this->recaptcha_token)],
            'severity' => ['required', Rule::in(\array_keys(Severity::SEVERITIES))],

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
            'date_of_incident.date_format'           => 'Please use timepicker',
            'location_id.required'           => 'Location is required',
            'complaint_category_id.required' => 'Complaint category is required',
            'complaint_type_id.in'           => "Complaint type doesn't have valid value",
            'complaint_channel_id.in'        => "Complaint type doesn't have valid value",
        ];
    }
}
