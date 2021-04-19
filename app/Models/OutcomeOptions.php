<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OutcomeOptions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
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
     * Get the category associated with the OutcomeOptions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(OutcomeOptionsCategories::class, 'id', 'category_id');
    }
}
