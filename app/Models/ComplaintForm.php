<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ComplaintForm extends Model
{
    use HasFactory;
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
        'description',
        'location_id',
        'complaint_category_id',
        'complaint_type_id',
        'complaint_channel_id',
        'severity',
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
        'date_of_incident'         => 'datetime',
        'date_of_client_complaint' => 'datetime',
        'date_completed'           => 'datetime',
        'outcome_options'          => 'json',
    ];

    /**
     * Formats data for save
     *
     * @param array $data
     * @param boolean $update
     *
     * @return array
     */
    public function format(array $data, bool $update = false) :array
    {
        if(isset($data['date_of_incident']))
        {
            $date = DateTime::createFromFormat('d/m/Y', $data['date_of_incident']);

            $data['date_of_incident'] = $date->format('Y-m-d H:i:s');
        }

        if(isset($data['date_of_client_complaint']) && $data['date_of_client_complaint'] !== null)
        {
            $dateOfClientComplaint            = DateTime::createFromFormat('d/m/Y', $data['date_of_client_complaint']);
            $data['date_of_client_complaint'] = $dateOfClientComplaint->format('Y-m-d');
        }

        if($update === true)
        {
            if($data['date_completed'] !== null)
            {
                $dateCompleted          = DateTime::createFromFormat('d/m/Y', $data['date_completed']);
                $data['date_completed'] = $dateCompleted->format('Y-m-d');
            }

            $outcomeOptions = [];

            foreach ($data['outcomeOptions'] as $key => $value )
            {
                $name = \str_replace('_', ' ', $key);

                $option = OutcomeOptionsCategories::where('name', '=', $name)->first();

                $outcomeOptions[] = [
                    'category_id' => $option->id,
                    'option_id'   => (int) $value,
                ];
            }

            $data['outcome_options'] = $outcomeOptions;
        }

        if(!isset($data['outcome']))
        {
            $data['outcome'] = '';
        }

        $data['severity'] = \filter_var( $data['severity'], \FILTER_SANITIZE_STRING);

        return $data;
    }

    /**
     * Get the clinic associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class)->withTrashed();
    }

    /**
     * Get the location associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the category associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id')->withTrashed();
    }

    /**
     * Get the type associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id')->withTrashed();
    }

    /**
     * Get the channel associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(ComplaintChannel::class, 'complaint_channel_id')->withTrashed();
    }

    /**
     * Return complaint level
     *
     * @return string
     */
    public function complaintLevel() :?string
    {
        if($this->channel !== null)
        {

            /**
             * If the complaint type is using default settings, return channel level for sending emails
             */
            if($this->type && $this->type->complaint_channels_settings === null)
            {
                return $this->channel->level;
            }

            if($this->type === null)
            {
                return null;
            }

            $severity = \strtolower(\str_replace(' ', '_', Severity::SEVERITIES[$this->severity ?? 'none']));

            return  optional($this->type)->complaint_channels_settings[$severity][$this->channel->id]['level'] ?? null;

        }

        return optional($this->type)->level ?? '/';
    }

    /**
     * Get all files for the complaint form
     *
     * @return string
     */
    public function getFilesAttribute()
    {
        $files     = [];
        $formFiles =  Storage::files('documents/complaint_form_' . $this->id);

        foreach($formFiles as $file)
        {
            $path    = \explode('/', $file);
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
    public function option($options) :string
    {
        if(!$this->outcome_options)
        {
            return '/';
        }

        $form = null;

        foreach($this->outcome_options as $item)
        {
            $form = $options->where('id', $item['option_id']);

            if($form->count())
            {
                break;
            }
        }

        return $form->first() ? $form->first()->name : '/';
    }

}
