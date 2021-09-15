<?php

namespace App\Http\Requests;

use App\Models\ClinicManagers;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\Severity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AutomatedResponseRequest extends FormRequest
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
            'name'                 => 'required|string|min:3|max:255',
            'response'             => 'required|string|min:3',
            'default'              => 'nullable',
            'category'             => 'nullable',
            'category.*'           => [Rule::in(ComplaintCategory::all()->pluck('id')->toArray())],
            'type'                 => 'nullable',
            'type.*'               => [Rule::in(ComplaintType::all()->pluck('id')->toArray())],
            'channel'              => 'nullable',
            'channel.*'            => [Rule::in(ComplaintChannel::all()->pluck('id')->toArray())],
            'severity'             => 'nullable',
            'severity.*'           => [Rule::in(Severity::all()->pluck('id')->toArray())],
            'additinal_contacts'   => 'nullable',
            'additinal_contacts.*' => [Rule::in(\array_keys(ClinicManagers::$managersLabel))],
            'additional_emails'    => 'nullable|string',
            'level'                => ["required", Rule::in([1, 2, 3])],
        ];
    }
}
