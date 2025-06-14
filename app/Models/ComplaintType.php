<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintType extends Model
{
    use SoftDeletes;


    protected static $types;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'complaint_category_id',
    ];

    /**
     * Get all the channels for the ComplaintType
     *
     * @return HasMany
     */
    public function channels(): HasMany
    {
        return $this->hasMany(ComplaintChannel::class, 'complaint_channel_id');
    }

    /**
     * Get the category that owns the ComplaintType
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id');
    }

    public static function getAll(): Collection
    {
        return self::$types ??= self::all();
    }
}
