<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** @package Roles */
class Roles extends Model
{
    use HasFactory;

    static $levels = [
        1,
        2,
        3,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'level' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'level', 'permissions'];

    /**
     * Return formated permission
     *
     * @return string
    */
    public function permissions() :string
    {
        $permissions = [];

        if( \is_integer(\strpos($this->permissions, 'r')) )
        {
            $permissions[] = 'read';
        }

        if( \is_integer(\strpos($this->permissions, 'w')) )
        {
            $permissions[] = 'write';
        }

        if( \is_integer(\strpos($this->permissions, 'd')) )
        {
            $permissions[] = 'delete';
        }

        $permissions = \implode(', ', $permissions);

        return empty($permissions) ? 'None' : \ucwords($permissions);
    }

    /**
     * Return permission value
     *
     * @param string $permission
     *
     * @return string|null
     */
    public function hasPermission(string $permission) :?string
    {
        return \is_integer(\strpos($this->permissions, $permission)) ? $permission : null;
    }
}
