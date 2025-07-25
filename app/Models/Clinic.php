<?php

namespace App\Models;

use App\Models\ClinicManagers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'owner_id',
        'country',
    ];

    public static array $countries = [
        'australia'   => 'au',
        'new zealand' => 'nz',
    ];

    /**
     * The users associated with the clinic.
     *
     * @var array
     */
    public static array $userFields = [
        'lead_vet',
        'practice_manager',
        'veterinary_manager',
        'gm_veterinary_operations',
        'general_manager',
        'regional_manager',
    ];

    /**
     * Get all the managers for the Clinic
     *
     * @return HasMany
     */
    public function managers(): HasMany
    {
        return $this->hasMany(ClinicManagers::class);
    }

    /**
     * Get the owner associated with the Clinic
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the let vet(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getLeadVetAttribute()
    {
        if ($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('lead_vet');
        });
    }

    /**
     * Get the Practice Manager(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getPractiseManagerAttribute()
    {
        if ($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('practice_manager');
        });
    }

    /**
     * Get the Vet Manager(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getVetManagerAttribute()
    {
        if ($this->managers->count() === 0) {
            return null;
        }

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('veterinary_manager');
        });
    }

    /**
     * Get the GM Veterinary Operation(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getGmVeterinaryOperationAttribute()
    {
        if ($this->managers->count() === 0) {
            return null;
        }

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('gm_veterinary_operations');
        });
    }

    /**
     * Get the General Manager(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getGeneralManagerAttribute()
    {
        if ($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function ($item) {

            return $item->manager_type_id == ClinicManagers::managerID('general_manager');
        });
    }

    /**
     * Get the Regional Manager(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getRegionalManagerAttribute()
    {
        if ($this->managers->count() === 0 || !$this->managers)
            return null;

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('regional_manager');
        });
    }

    /**
     * Get the GM Vet Services
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getGmVetsServicesAttribute()
    {
        if ($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('gm_vet_services');
        });
    }

    /**
     * Get the Other users
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getOtherAttribute()
    {
        if ($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function ($item) {
            return $item->manager_type_id == ClinicManagers::managerID('other');
        });
    }

    /**
     * Get the Other users
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getFirstManager(string $managerType)
    {
        if ($this->managers->count() === 0)
            return null;

        $managers = $this->managers->filter(function ($item) use ($managerType) {
            return $item->manager_type_id == ClinicManagers::managerID($managerType);
        });

        return $managers->first()->user ?? null;
    }

    /**
     * Print comma separated users
     *
     * @param object $users
     * @param string $field
     *
     * @return string
     */
    public static function printUsers(object $users, string $field): string
    {
        $data = [];

        foreach ($users as $user) {
            if (isset($user->user))
                $data[] = $user->user->$field;
        }

        return implode(',', $data);
    }
}
