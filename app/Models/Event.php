<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 * @version May 1, 2020, 2:00 pm UTC
 *
 * @property string $__version
 * @property string $applicationId
 * @property string $childFirstName
 * @property string $childId
 * @property string $ip
 * @property string $label
 * @property string $origin
 * @property string $parentEmail
 * @property string $parentFirstName
 * @property string $parentId
 * @property string $sid
 * @property string $status
 * @property string $time
 * @property string $useragent
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 */
class Event extends Model
{
    use SoftDeletes;

    public $table = 'events';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'applicationId',
        'childFirstName',
        'childId',
        'ip',
        'label',
        'origin',
        'parentEmail',
        'parentFirstName',
        'parentId',
        'sid',
        'status',
        'time',
        'useragent',
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
        'childFirstName' => 'string',
        'childId' => 'string',
        'ip' => 'string',
        'label' => 'string',
        'origin' => 'string',
        'parentEmail' => 'string',
        'parentFirstName' => 'string',
        'parentId' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'time' => 'string',
        'useragent' => 'string',
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
    public function child()
    {
        return $this->hasOne('App\Models\User', 'id', 'childId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne('App\Models\User', 'id', 'parentId');
    }
    
}
