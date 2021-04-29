<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ClinicManagers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The users associated with the clinic.
     *
     * @var array
     */
    public static $userFields = [
        'lead_vet',
        'practice_manager',
        'veterinary_manager',
        'gm_veterinary_operations',
        'general_manager',
        'regional_manager',
    ];

    /**
     * Get all of the managers for the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managers(): HasMany
    {
        return $this->hasMany(ClinicManagers::class);
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

    /**
     * Get the let vet(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getLeadVetAttribute()
    {
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
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
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
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
        if($this->managers->count() === 0)
            return null;

        $data = $this->managers->filter(function($item){
            return $item->manager_type_id == ClinicManagers::managerID('veterinary_manager');
        });

        if($data->count() === 0)
            return null;

        return $data;
    }

    /**
     * Get the GM Veterinary Operation(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getGmVeterinaryOperationAttribute()
    {
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
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
        if($this->managers->count() === 0)
            return null;

        $data = $this->managers->filter(function($item){
            return $item->manager_type_id == ClinicManagers::managerID('general_manager');
        });

        if($data->count() === 0)
            return null;

        return $data;
    }

    /**
     * Get the Regional Manager(s)
     *
     * @return Illuminate\Database\Eloquent\Collection[]
     */
    public function getRegionalManagerAttribute()
    {
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
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
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
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
        if($this->managers->count() === 0)
            return null;

        return $this->managers->filter(function($item){
            return $item->manager_type_id == ClinicManagers::managerID('other');
        });
    }
}
