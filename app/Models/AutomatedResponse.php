<?php

namespace App\Models;

use App\Http\Requests\AutomatedResponseRequest;
use Illuminate\Database\Eloquent\Model;
use JsonException;

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

    /**
     * @throws JsonException
     */
    public function getScenarioCaseAttribute(): array
    {

        $returnInfo = [];

        $scenario = json_decode($this->attributes['scenario'], false, 512, JSON_THROW_ON_ERROR);

        if(isset($scenario->categories))
        {
            $data = $this->formatScenarioText('categories', $scenario->categories);

            if($data){
                $returnInfo[] = "Categories used for this response: " . implode(', ', $data);
            }
        }

        if(isset($scenario->types))
        {

            $data = $this->formatScenarioText('types', $scenario->types);

            if($data){
                $returnInfo[] = "Types used for this response: " . implode(', ', $data);
            }
        }

        if(isset($scenario->channels))
        {
            $data = $this->formatScenarioText('channels', $scenario->channels);

            if($data){
                $returnInfo[] = "Channels used for this response: " . implode(', ', $data);
            }
        }

        if(isset($scenario->severity))
        {
            $data = $this->formatScenarioText('severity', $scenario->severity);

            if($data){
                $returnInfo[] = "Severities used for this response: " . implode(', ', $data);
            }
        }

        return  $returnInfo;
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
    public static function additionalEmails($value) :array
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

    protected function formatScenarioText($scenario, $scenarioIDs): array
    {
        static $scenarioData;

        if(!$scenarioData)
        {
            $scenarioData = [
                'categories' => ComplaintCategory::all(),
                'types' => ComplaintType::all(),
                'channels' => ComplaintChannel::all(),
                'severity' => Severity::all(),
            ];
        }

        $returnData = [];

        $data = $scenarioData[$scenario]
            ->filter(function ($value) use ($scenarioIDs) {
                return in_array($value->id, $scenarioIDs, false);
            });

        foreach ($data as $datum)
        {
            $returnData[] = $datum->name;
        }

        return $returnData;
    }
}
