<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplaintType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'complaint_category_id',
        'level',
        'severity',
    ];

    /**
     * Get all of the channels for the ComplaintType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channels(): HasMany
    {
        return $this->hasMany(ComplaintChannel::class, 'complaint_channel_id');
    }

    /**
     * Get the category that owns the ComplaintType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id');
    }
}
