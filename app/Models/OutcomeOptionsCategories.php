<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OutcomeOptionsCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the name formated for select
     *
     * @return string
     */
    public function getSelectNameAttribute() :string
    {
        return \str_replace(' ', '_', \strtolower($this->name));
    }

    /**
     * Get all of the options for the OutcomeOptionsCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(OutcomeOptions::class, 'category_id');
    }
}
