<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Application
 * @package App\Models
 * @version May 1, 2020, 1:48 pm UTC
 *
 * @property string $__state
 * @property string $__version
 * @property string $title
 * @property string $secret
 * @property string $sid
 * @property string $status
 * @property string $hostnames
 * @property string|\Carbon\Carbon $createdAt
 * @property string|\Carbon\Carbon $updatedAt
 */
class Application extends Model
{
    use SoftDeletes;

    public $table = 'applications';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '__state',
        '__version',
        'title',
        'secret',
        'sid',
        'status',
        'hostnames',
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
        '__state' => 'string',
        '__version' => 'string',
        'title' => 'string',
        'secret' => 'string',
        'sid' => 'string',
        'status' => 'string',
        'hostnames' => 'string',
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
