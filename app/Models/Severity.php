<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Severity extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'severities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    const SEVERITIES = [
        'none' => 'None',
        1      => 'no adverse effect',
        2      => 'minor adverse effect',
        3      => 'severe adverse effect',
        4      => 'not applicable',
    ];
}
