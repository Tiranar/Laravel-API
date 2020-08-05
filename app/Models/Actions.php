<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Actions
 * @package App\Models
 * @version May 1, 2020, 1:46 pm UTC
 *
 * @property string $__version
 * @property boolean $authenticated
 * @property string $email
 * @property string $__state
 * @property string|\Carbon\Carbon $createdAt
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $username
 */
class Actions extends Model
{
    use SoftDeletes;

    public $table = 'actions';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'authenticated',
        'email',
        '__state',
        'createdAt',
        'organizationId',
        'sid',
        'status',
        'updatedAt',
        'username'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'authenticated' => 'boolean',
        'email' => 'string',
        '__state' => 'string',
        'createdAt' => 'datetime',
        'organizationId' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'updatedAt' => 'datetime',
        'username' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organizationId');
    }
    
}
