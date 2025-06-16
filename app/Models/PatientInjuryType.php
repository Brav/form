<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientInjuryType extends Model
{
    protected $table = 'patient_injury_types';

    protected $fillable = [
        'name',
    ];

    public function forms(): HasMany
    {
        return $this->hasMany(ComplaintForm::class, 'patient_injury_type_id');
    }
}
