<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version May 1, 2020, 2:13 pm UTC
 *
 * @property string $id
 * @property string $__version
 * @property string $avatar
 * @property string $character
 * @property string $sid
 * @property string $status
 * @property string $firstName
 * @property string $furthestFloor
 * @property string $furthestInteraction
 * @property string $furthestLesson
 * @property string $name
 * @property string $email
 * @property string $trigger_elevator_first
 * @property string $trigger_fp_room_first
 * @property string $trigger_lobby_first
 * @property string $trigger_mf_first
 * @property string $trigger_trophy_room_first
 * @property string $deviceGeneration
 * @property string $hash
 * @property string $osVersion
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 * @property string|\Carbon\Carbon $lastDiskSpaceWarning
 * @property string $passwordResetToken
 * @property string $__state
 * @property string $applicationId
 * @property string $applicationSecret
 * @property string $receipt
 * @property string $organizationId
 */
class User extends Model
{
    // use SoftDeletes;

    public $table = 'users';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];

    public $hidden = [
        "hash",
        "password",
        "password_token"
    ];

    public $fillable = [
        'id',
        '__version',
        'avatar',
        'character',
        'sid',
        'status',
        'firstName',
        'furthestFloor',
        'furthestInteraction',
        'furthestLesson',
        'name',
        'email',
        'trigger_elevator_first',
        'trigger_fp_room_first',
        'trigger_lobby_first',
        'trigger_mf_first',
        'trigger_trophy_room_first',
        'deviceGeneration',
        'hash',
        'osVersion',
        'createdAt',
        'updatedAt',
        'lastDiskSpaceWarning',
        'passwordResetToken',
        '__state',
        'applicationId',
        'applicationSecret',
        'receipt',
        'organizationId',
        'password',
        'password_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'avatar' => 'string',
        'character' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'firstName' => 'string',
        'furthestFloor' => 'string',
        'furthestInteraction' => 'string',
        'furthestLesson' => 'string',
        'name' => 'string',
        'email' => 'string',
        'trigger_elevator_first' => 'string',
        'trigger_fp_room_first' => 'string',
        'trigger_lobby_first' => 'string',
        'trigger_mf_first' => 'string',
        'trigger_trophy_room_first' => 'string',
        'deviceGeneration' => 'string',
        'hash' => 'string',
        'osVersion' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        'lastDiskSpaceWarning' => 'datetime',
        'passwordResetToken' => 'string',
        '__state' => 'string',
        'applicationId' => 'string',
        'applicationSecret' => 'string',
        'receipt' => 'string',
        'organizationId' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function groups()
    {
        return $this->hasManyThrough(
            'App\Models\Group',
            'App\Models\GroupUser',
            'userId',
            'id',
            'id',
            'groupId'
        );

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function application()
    {
        return $this->hasOne('App\Models\Application', 'id', 'applicationId');
    }

    public function device_tokens()
    {
        return $this->hasMany(
            'App\Models\Device',
            'id',
            'userId'
        );

    }

    public function receipts()
    {
        return $this->hasMany(
            'App\Models\Receipt',
            'id',
            'userId'
        );

    }

}
