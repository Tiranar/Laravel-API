<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Eloquent as Model;

use Illuminate\Support\Str;

/**
 * Class Actions
 * @package App\Models
 * @version May 1, 2020, 1:46 pm UTC
 *
 * @property string $__version
 * @property boolean $authenticated
 * @property string $email
 * @property string $__state
 * @property string|\Carbon\Carbon $createdAt
 * @property string $organizationId
 * @property string $sid
 * @property string $status
 * @property string|\Carbon\Carbon $updatedAt
 * @property string $username
 */
class AppBaseModel extends Model
{

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

}
