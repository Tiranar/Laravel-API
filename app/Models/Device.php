<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Device
 * @package App\Models
 * @version May 1, 2020, 1:55 pm UTC
 *
 * @property string $__version
 * @property string $applicationId
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string $token
 * @property string $userId
 * @property string $env
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 */
class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'applicationId',
        'organizationId',
        'sid',
        'status',
        'token',
        'userId',
        'env',
        'createdAt',
        'updatedAt'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'applicationId' => 'string',
        'organizationId' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'token' => 'string',
        'userId' => 'string',
        'env' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
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
    public function application()
    {
        return $this->hasOne('App\Models\Application', 'id', 'applicationId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organizationId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }
    
}
