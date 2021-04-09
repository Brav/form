<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Severity extends Model
{
    use HasFactory;

    const SEVERITIES = [
        1 => 'no adverse effect',
        2 => 'minor adverse effect',
        3 => 'severe adverse effect',
    ];
}
