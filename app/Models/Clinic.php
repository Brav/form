<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clinic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lead_vet',
        'practise_manager',
        'vet_manager',
        'gm_veterinary_options',
        'gm_region',
        'regional_manager',
        'owner_id'
    ];

    /**
     * The users associated with the clinic.
     *
     * @var array
     */
    public static $userFields = [
        'lead_vet',
        'practise_manager',
        'vet_manager',
        'gm_veterinary_options',
        'gm_region',
        'regional_manager',
    ];

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->when(request()->route()->getName() === 'clinics.index', function($query){
            return $query->with([
                'leadVet',
                'practiseManager',
                'vetManager',
                'gmVeterinaryOptions',
                'gmRegion',
                'regionalManager',
            ]);
        })->firstOrFail();
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leadVet(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_vet', 'id');
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practiseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'practise_manager', 'id');
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vetManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vet_manager', 'id');
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gmVeterinaryOptions(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gm_veterinary_options', 'id');
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gmRegion(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gm_region', 'id');
    }

    /**
     * Get the leadVet associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regionalManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'regional_manager', 'id');
    }

    /**
     * Get the owner associated with the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
