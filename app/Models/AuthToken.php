<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AuthToken
 * @package App\Models
 * @version May 1, 2020, 1:50 pm UTC
 *
 * @property string $__version
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $__state
 */
class AuthToken extends Model
{
    use SoftDeletes;

    public $table = 'auth_tokens';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'organizationId',
        'sid',
        'status',
        'createdAt',
        'updatedAt',
        '__state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'organizationId' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        '__state' => 'string'
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
