<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomatedCountryEmail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country',
        'emails',
        'body',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'automated_country_emails';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'emails' => 'array',
        'body'   => 'array',
    ];

    /**
     * Set the additional emails
     *
     * @param  string  $value
     * @return array
     */
    public static function emails($value) :string
    {
        $return = [];

        $emails = \explode(',', $value);

        if(!empty($emails))
        {
            foreach ($emails as $email)
            {
                $data = \filter_var(\trim($email), \FILTER_SANITIZE_EMAIL);

                if($data)
                {
                    $return[] = $data;
                }
            }
        }

        return \implode(',', $return);
    }
}
