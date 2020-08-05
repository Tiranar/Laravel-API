<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organization
 * @package App\Models
 * @version May 1, 2020, 2:08 pm UTC
 *
 * @property string $__version
 * @property string $__state
 * @property string $title
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 */
class Organization extends Model
{
    use SoftDeletes;

    public $table = 'organizations';
    
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
        '__state',
        'title',
        'sid',
        'status',
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
        '__state' => 'string',
        'title' => 'string',
        'sid' => 'string',
        'status' => 'string',
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

    
}
