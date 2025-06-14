<?php

namespace App\Models;

use App\Http\Requests\ClinicCreateRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Clinic;

class ClinicManagers extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'clinic_id',
        'manager_type_id',
    ];

    /**
     * The users associated with the clinic.
     *
     * @var array
     */
    public static array $managerTypes = [
        1 => 'lead_vet',
        2 => 'practice_manager',
        3 => 'veterinary_manager',
        4 => 'gm_veterinary_operations',
        5 => 'general_manager',
        6 => 'regional_manager',
        7 => 'gm_vet_services',
        8 => 'other',
    ];

    /**
     * Manager Label
     *
     * @var string[]
     */
    public static array $managersLabel = [
        1 => 'Lead Vet',
        2 => 'Practise Manager',
        3 => 'Veterinary Manager',
        4 => 'GM Veterinary Operation',
        5 => 'General Manager',
        6 => 'Regional Manager',
        7 => 'GM Vets Services',
        8 => 'Other',
    ];

    /**
     *
     * @param \App\Models\Clinic $clinic
     * @param  ClinicCreateRequest  $request
     * @return void
     */
    public static function saveManagers($clinic, $request): void
    {
        $managers = [];

        self::where('clinic_id', '=', $clinic->id)->delete();

        foreach (self::$managerTypes as $key => $type)
        {
            if($request->post($type))
            {
                switch ($type) {
                    case 'lead_vet':
                    case 'veterinary_manager':
                    case 'other':
                        foreach ($request->post($type) as $user)
                        {
                            $managers[] = [
                                'clinic_id'       => $clinic->id,
                                'user_id'         => $user,
                                'manager_type_id' => $key,
                            ];
                        }
                        break;

                    default:
                        $managers[] = [
                            'clinic_id'       => $clinic->id,
                            'user_id'         => $request->post($type),
                            'manager_type_id' => $key,
                        ];
                        break;
                }
            }
        }

        self::insert($managers);

    }

    /**
     * Get the clinic that owns the ClinicManagers
     *
     * @return BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Get the user that owns the ClinicManagers
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Find manager ID
     *
     * @param mixed $name
     * @return int|string|false
     */
    static public function managerID($name): bool|int|string
    {
        return \array_search($name, self::$managerTypes, true);
    }
}
