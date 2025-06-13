<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomatedDateCompletedEmail extends Model
{
    protected $table = 'automated_date_completed_email_contacts';

    protected $fillable = ['emails'];

    protected $casts = [
        'emails' => 'json',
    ];
}
