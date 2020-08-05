<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Receipt
 * @package App\Models
 * @version May 1, 2020, 2:11 pm UTC
 *
 * @property string $__version
 * @property string $applicationId
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string $duration
 * @property string $userId
 * @property string $env
 * @property string $receipt
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $service
 * @property string $meta
 */
class Receipt extends Model
{
    use SoftDeletes;

    public $table = 'receipts';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'applicationId',
        'organizationId',
        'sid',
        'status',
        'duration',
        'userId',
        'env',
        'receipt',
        'createdAt',
        'updatedAt',
        'service',
        'meta'
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
        'duration' => 'string',
        'userId' => 'string',
        'env' => 'string',
        'receipt' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        'service' => 'string',
        'meta' => 'string'
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
