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
        'scenario' => 'array',
    ];

    public function getScenarioCaseAttribute()
    {
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

        return $scenario;
    }
}
