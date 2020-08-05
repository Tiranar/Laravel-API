<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version May 1, 2020, 2:01 pm UTC
 *
 * @property string $userId
 * @property string $src
 * @property string $thumbnail
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string|\Carbon\Carbon $deleted_at
 */
class Files extends Model
{
    use SoftDeletes;

    public $table = 'files';

    public $incrementing = false;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'userId',
        'src',
        'thumbnail',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'userId' => 'string',
        'src' => 'string',
        'thumbnail' => 'string',
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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
}
