<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Severity;
use Illuminate\Validation\Rule;

class AutomatedEmailContactsRequest extends FormRequest
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
            'name'       => 'required|string|min:3|max:255',
            'contacts'   => 'required',
            'category'   => 'nullable',
            'category.*' => [Rule::in(ComplaintCategory::all()->pluck('id')->toArray())],
            'type'       => 'nullable',
            'type.*'     => [Rule::in(ComplaintType::all()->pluck('id')->toArray())],
            'channel'    => 'nullable',
            'channel.*'  => [Rule::in(ComplaintChannel::all()->pluck('id')->toArray())],
            'severity'   => 'nullable',
            'severity.*' => [Rule::in(Severity::all()->pluck('id')->toArray())],
            'aggression' => 'nullable',
            'severity.*' => [ \array_keys(ComplaintForm::clientAggressionValues()) ],
        ];
    }
}
