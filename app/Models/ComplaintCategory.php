<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'values_used',
    ];

    protected static $types;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'values_used' => 'json',
    ];

    /**
     * Format data for save
     *
     * @param array $data
     *
     * @return array
     */
    public static function formatData(array $data) :array
    {
        $format = [];

        $format['name'] = \filter_var( $data['name'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $format['values_used'] = [
            'channels'   => [],
            'severities' => [],
        ];

        if(count($data['channels'] ?? []))
        {
            $format['values_used']['channels'] = \array_filter($data['channels'], 'is_numeric');
        }

        if(count($data['severities'] ?? []))
        {
            $format['values_used']['severities'] = \array_filter($data['severities'], 'is_numeric');
        }

        return $format;
    }

    /**
     * Get all of the types for the ComplaintCategory
     *
     * @return HasMany
     */
    public function types(): HasMany
    {
        return $this->hasMany(ComplaintType::class);
    }

    public static function getAll(): Collection
    {
        return self::$types ??= self::all();
    }
}
