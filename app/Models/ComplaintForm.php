<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ComplaintForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clinic_id',
        'team_member',
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
        'outcome',
        'completed_by',
        'date_completed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_incident' => 'datetime',
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
        $date = DateTime::createFromFormat('d/m/Y g:i A', $data['date_of_incident']);

        $data['date_of_incident'] = $date->format('Y-m-d H:i:s');

        if($data['date_of_client_complaint'] !== null)
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
        }

        if(!isset($data['outcome']))
        {
            $data['outcome'] = '';
        }

        return $data;
    }

    /**
     * Get the clinic associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
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
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id');
    }

    /**
     * Get the type associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id');
    }

    /**
     * Get the channel associated with the ComplaintForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(ComplaintChannel::class, 'complaint_channel_id');
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
            return $this->channel->level;
        }

        return $this->type->level;
    }


}
