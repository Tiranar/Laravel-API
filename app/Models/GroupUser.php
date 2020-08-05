<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupUser
 * @package App\Models
 * @version May 1, 2020, 2:16 pm UTC
 *
 * @property string $__version
 * @property string $groupId
 * @property string $userId
 * @property boolean $leader
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $__state
 */
class GroupUser extends Model
{
    use SoftDeletes;

    public $table = 'link_groups_users';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__version',
        'groupId',
        'userId',
        'leader',
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
        'groupId' => 'string',
        'userId' => 'string',
        'leader' => 'boolean',
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
    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'groupId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }
}
