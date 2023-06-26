<?php

namespace App\Models;

use App\Http\Requests\AutomatedEmailContactsRequest;
use Illuminate\Database\Eloquent\Model;

class AutomatedEmailContacts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contacts',
        'scenario',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'automated_email_contacts';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'contacts' => 'array',
        'scenario'   => 'array',
    ];

    /**
     * Format the scenario
     * @return array
     */
    public static function scenario(AutomatedEmailContactsRequest $request) :array
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

        if(is_array($request->post('aggression')))
        {
            $scenario['aggression'] = $request->post('aggression');
        }

        return $scenario;
    }

    /**
     * Set the additional emails
     *
     * @param  string  $value
     * @return array
     */
    public static function contacts($value) :string
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
