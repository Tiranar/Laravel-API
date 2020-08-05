<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Promotion
 * @package App\Models
 * @version May 1, 2020, 2:10 pm UTC
 *
 * @property string $__version
 * @property string $applicationId
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $expiration
 * @property string $userId
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 */
class Promotion extends Model
{
    use SoftDeletes;

    public $table = 'promotions';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'applicationId',
        'organizationId',
        'sid',
        'status',
        'expiration',
        'userId',
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
        'expiration' => 'datetime',
        'userId' => 'string',
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
