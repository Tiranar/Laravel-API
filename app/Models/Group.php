<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Group
 * @package App\Models
 * @version May 1, 2020, 2:01 pm UTC
 *
 * @property string $__version
 * @property string $title
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $__state
 * @property string $applicationId
 * @property string $applicationSecret
 */
class Group extends Model
{
    use SoftDeletes;

    public $table = 'groups';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];

    // /**
    //  *  Setup model event hooks
    //  */
    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->id = Str::uuid();
    //     });
    // }


    public $fillable = [
        '__version',
        'title',
        'organizationId',
        'sid',
        'status',
        'createdAt',
        'updatedAt',
        '__state',
        'applicationId',
        'applicationSecret'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'title' => 'string',
        'organizationId' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        '__state' => 'string',
        'applicationId' => 'string',
        'applicationSecret' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function leaders()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\GroupUser',
            'groupId',
            'id',
            'id',
            'userId'
        )->where("leader", 1);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function members()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\GroupUser',
            'groupId',
            'id',
            'id',
            'userId'
        )->where("leader", 0);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\GroupUser',
            'groupId',
            'id',
            'id',
            'userId'
        );

    }

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

}
