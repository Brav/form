<?php

namespace App\Http\Requests;

use App\Models\Animal;
use App\Models\Clinic;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Location;
use App\Models\Severity;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ComplaintFormUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        $complaintTypes = ComplaintType::getAll();
        $complaintTypeOther = $complaintTypes->where('name', '=', 'Other')->first();

        return [
            'clinic_id'                     => [
                'required',
                Rule::in(Clinic::all()->pluck('id')->toArray()),
            ],
            'team_member'                   => ['required', 'string', 'min:2'],
            'team_member_email'             => ['required', 'email'],
            'team_member_position'          => ['required', 'string', 'min:2'],
            'client_name'                   => ['required', 'string', 'min:2'],
            'patient_name'                  => ['required', 'string', 'min:2'],
            'pms_code'                      => ['required', 'string', 'min:2'],
            'date_of_incident'              => ['nullable', 'date_format:d/m/Y'],
            'date_of_client_complaint'      => ['nullable', 'date_format:d/m/Y'],
            'date_to_respond_to_the_client' => ['nullable', 'date_format:d/m/Y'],
            'description'                   => ['required', 'string', 'min:2',],
            'aggression_choice'             => ['required', Rule::in(['no', 'yes'])],
            'aggression'                    => ['required_if:aggression_choice,yes', Rule::in(array_keys(ComplaintForm::clientAggressionValues()))],
            'location_id'                   => [
                'nullable',
                Rule::in(Location::all()->pluck('id')->toArray()),
            ],
            'complaint_category_id'         => [
                'required',
                Rule::in(ComplaintCategory::all()->pluck('id')->toArray()),
            ],
            'complaint_type_id'             => [
                'required',
                Rule::in($complaintTypes->pluck('id')->toArray()),
            ],
            'complaint_channel_id'          => [
                'required',
                Rule::in(ComplaintChannel::all()->pluck('id')->toArray()),
            ],
            'severity_id'                   => [
                'required',
                Rule::in(Severity::get()->pluck('id')->toArray())
            ],
            'animal_id'                     => [
                'required',
                Rule::in(\array_merge(Animal::all()->pluck('id')->toArray(), ['other'])),
            ],
            'formal_complaint_lodged'       => [
                'required', Rule::in(['yes', 'no']),
            ],
            'other_type_of_complaint' => ['required_if:complaint_type_id,' . $complaintTypeOther->id, 'min:2', 'max:250' ],
            'documents'                     => 'nullable',
            'documents.*'                   => 'max:20000',
            'outcome'                       => ['nullable', 'string', 'min:2'],
            'completed_by'                  => ['nullable', 'string', 'min:2'],
            'date_completed'                => ['nullable', 'date_format:d/m/Y'],
            'outcome_options'               => ['nullable'],
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
            'animal_id.required'               => 'Please select animal, or if not on the list select other',
            'severity_id.required'             => 'Please select severity',
            'complaint_type_id.required'       => 'Please select complaint type',
            'complaint_channel_id.required'    => 'Please select channel',
            'date_of_incident.date_format'     => 'Please use timepicker',
            'date_completed.date_format'       => 'Please use timepicker',
            'location_id.required'             => 'Location is required',
            'complaint_category_id.required'   => 'Complaint category is required',
            'complaint_type_id.in'             => "Complaint type doesn't have valid value",
            'complaint_channel_id.in'          => "Complaint type doesn't have valid value",
            'documents.max'                    => "Please note that maximum file upload size needs to be less than 20MB",
            'formal_complaint_lodged.in'       => "Please select yes or no",
            'formal_complaint_lodged.required' => "Please select yes or no",
        ];
    }
}
