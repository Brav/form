<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Severity extends Model
{
    const SEVERITIES = [
        1 => 'no adverse effect',
        2 => 'minor adverse effect',
        3 => 'severe adverse effect',
    ];
}
