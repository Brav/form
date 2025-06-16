<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComplaintForm extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clinic_id',
        'team_member',
        'team_member_email',
        'team_member_position',
        'client_name',
        'patient_name',
        'pms_code',
        'date_of_incident',
        'date_of_client_complaint',
        'date_to_respond_to_the_client',
        'description',
        'aggression',
        'location_id',
        'complaint_category_id',
        'complaint_type_id',
        'other_type_of_complaint',
        'near_miss_description',
        'complaint_channel_id',
        'severity_id',
        'patient_injury_type_id',
        'animal_id',
        'formal_complaint_lodged',
        'level',
        'outcome',
        'outcome_options',
        'completed_by',
        'date_completed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_incident'              => 'datetime',
        'date_of_client_complaint'      => 'datetime',
        'date_to_respond_to_the_client' => 'datetime',
        'date_completed'                => 'datetime',
        'outcome_options'               => 'json',
    ];

    /**
     * Formats data for save
     *
     * @param array $data
     * @param boolean $update
     * @param boolean $updateOutcome
     *
     * @return array
     */
    public function format(array $data, bool $update = false, bool $updateOutcome = false): array
    {
        if (isset($data['date_of_incident'])) {
            $date = DateTime::createFromFormat('d/m/Y', $data['date_of_incident']);

            $data['date_of_incident'] = $date->format('Y-m-d H:i:s');
        }

        if ($data['date_of_client_complaint'] ?? null) {
            $dateOfClientComplaint = DateTime::createFromFormat('d/m/Y', $data['date_of_client_complaint']);
            $data['date_of_client_complaint'] = $dateOfClientComplaint->format('Y-m-d');
        }

        if ($data['date_to_respond_to_the_client'] ?? null) {
            $dateOfClientComplaint = DateTime::createFromFormat('d/m/Y', $data['date_to_respond_to_the_client']);
            $data['date_to_respond_to_the_client'] = $dateOfClientComplaint->format('Y-m-d');
        }

        if ($update === true) {
            if (($data['date_completed'] ?? null) && $updateOutcome === true) {
                $dateCompleted = DateTime::createFromFormat('d/m/Y', $data['date_completed']);
                $data['date_completed'] = $dateCompleted->format('Y-m-d');
            }

            if($updateOutcome === true){
                $outcomeOptions = [];
                foreach ($data['outcomeOptions'] as $key => $value) {
                    $name = \str_replace('_', ' ', $key);

                    $option = OutcomeOptionsCategories::where('name', '=', $name)->first();

                    $outcomeOptions[] = [
                        'category_id' => $option->id,
                        'option_id'   => (int)$value,
                    ];
                }
                $data['outcome_options'] = $outcomeOptions;
            }

        }

        if (!isset($data['animal_id']) || $data['animal_id'] === 'other') {
            $data['animal_id'] = null;
        }


        if (!isset($data['outcome']) || $updateOutcome === false) {
            $data['outcome'] = $data['outcome'] ?? '';
        }

        if ($updateOutcome === false) {
            $data['completed_by'] = $data['completed_by']?? null;
        }

        $data['aggression'] = $data['aggression_choice'] === 'yes' ? $data['aggression'] : null;

        $data['formal_complaint_lodged'] = $data['formal_complaint_lodged'] === 'yes';

        $complaintTypes = ComplaintType::getAll();
        $selectedComplaintType = $complaintTypes->where('id', '=', $data['complaint_type_id'])->first();

        if($selectedComplaintType->name !== 'Other'){
            $data['other_type_of_complaint'] = null;
        }

        $complaintCategories = ComplaintCategory::getAll();
        $selectedComplaintCategory = $complaintCategories->where('id', '=', $data['complaint_category_id'])->first();

        if($selectedComplaintCategory->name !== 'Near Miss'){
            $data['near_miss_description'] = null;
        }

        return $data;
    }

    /**
     * Get the clinic associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class)->withTrashed();
    }

    /**
     * Get the location associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the category associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id')->withTrashed();
    }

    /**
     * Get the type associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id')->withTrashed();
    }

    /**
     * Get the channel associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(ComplaintChannel::class, 'complaint_channel_id')->withTrashed();
    }

    /**
     * Get the severity associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function severity(): BelongsTo
    {
        return $this->belongsTo(Severity::class)->withTrashed();
    }

    /**
     * Get the animal associated with the ComplaintForm
     *
     * @return BelongsTo
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function patientInjuryType(): BelongsTo
    {
        return $this->belongsTo(PatientInjuryType::class);
    }

    protected function automatedResponse(): Attribute
    {
        return Attribute::make(
            get: static function (?string $value, array $attributes) {

                $autoResponse = AutomatedResponse::whereJsonContains('scenario->categories', (string)$attributes['complaint_category_id'])
                    ->whereJsonContains('scenario->types', (string)$attributes['complaint_type_id'])
                    ->whereJsonContains('scenario->channels', (string)$attributes['complaint_channel_id'])
                    ->whereJsonContains('scenario->severity', (string)$attributes['severity_id'])
                    ->first();

                return $autoResponse->name ?? 'N/A';
            },
        );
    }

    /**
     * Return complaint level
     *
     * @return string|null
     */
    public function complaintLevel(): ?string
    {
        return '/';
    }

    /**
     * Get all files for the complaint form
     *
     * @return string
     */
    public function getFilesAttribute()
    {
        $files = [];
        $formFiles = Storage::files('documents/complaint_form_' . $this->id);

        foreach ($formFiles as $file) {
            $path = \explode('/', $file);
            $files[] = end($path);
        }

        return $files;
    }

    /**
     * Get option name for the category
     *
     * @param array $item
     * @return string
     */
    public function option($options): string
    {
        if (!$this->outcome_options) {
            return '/';
        }

        $form = null;

        foreach ($this->outcome_options as $item) {
            $form = $options->where('id', $item['option_id']);

            if ($form->count()) {
                break;
            }
        }

        return $form->first() ? $form->first()->name : '/';
    }

    static public function clientAggressionValues()
    {
        return [
            'verbal'   => 'Verbal abuse (yelling, screaming)',
            'physical' => 'Physical abuse (pushing, shoving, physical injury)',
            'damage'   => 'Damage to the property',
            'threats'  => 'Threats (verbal or physical)'
        ];
    }

}
