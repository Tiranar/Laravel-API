<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version May 1, 2020, 2:01 pm UTC
 *
 * @property string $__version
 * @property string $type
 * @property string $name
 * @property string $shortDescription
 * @property string $description
 * @property integer $cost
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string|\Carbon\Carbon $deleted_at
 */
class Items extends Model
{
    use SoftDeletes;

    public $table = 'items';

    public $incrementing = false;

    protected $dates = ['deleted_at'];

    public $fillable = [
        '__version',
        'type',
        'name',
        'shortDescription',
        'description',
        'cost',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        '__version' => 'string',
        'type' => 'string',
        'name' => 'string',
        'shortDescription' => 'string',
        'description' => 'string',
        'cost' => 'integer',
        'created_at' => 'string',
        'updated_at' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public $with = [
        'file'
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
    public function file()
    {
        return $this->hasOne('App\Models\Files', 'id', 'fileId');
    }
}
