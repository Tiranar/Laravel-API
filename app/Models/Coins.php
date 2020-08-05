<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use App\Models\User;

class Coins extends Model
{

    public $fillable = [
        'id',
        'userId',
        'addCoins',
        'removeCoins',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */


    protected $casts = [
        'userId' => 'string',
    ];



    public function user()
    {
        return $this->hasOne(User::class);
    }
}
