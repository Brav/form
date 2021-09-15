<?php

namespace App\Models;

use App\Http\Requests\AutomatedResponseRequest;
use Illuminate\Database\Eloquent\Model;

class AutomatedResponse extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'response',
        'scenario',
        'default',
        'additional_contacts',
        'additional_emails',
        'level',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'automated_response';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'scenario'            => 'array',
        'additional_contacts' => 'array',
        'additional_emails'   => 'array',
        'default'             => 'boolean',
    ];

    public function getScenarioCaseAttribute()
    {
        if($this->default)
        {
            return "Default";
        }

        return 'test';
    }

    /**
     * Format the scenario
     *
     * @param App\Models\AutomatedResponseRequest $request
     * @return array
     */
    public static function scenario(AutomatedResponseRequest $request) :array
    {
        $scenario = [];

        if($request->default)
        {
            return [];
        }

        if(is_array($request->post('category')))
        {
            $scenario['categories'] = $request->post('category');
        }

        if(is_array($request->post('type')))
        {
            $scenario['types'] = $request->post('type');
        }

        if(is_array($request->post('channel')))
        {
            $scenario['channels'] = $request->post('channel');
        }

        if(is_array($request->post('severity')))
        {
            $scenario['severity'] = $request->post('severity');
        }

        return $scenario;
    }

     /**
     * Set the additional emails
     *
     * @param  string  $value
     * @return array
     */
    public function setAdditionalEmailsAttribute($value) :array
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

        return $return;
    }
}
