<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;

    public $table = 'equipments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'userId',
        'itemId',
        'slotId',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'id' => 'string',
        'userId' => 'string',
        'itemId' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];
    public function items()
    {
        return $this->hasMany(Items::class);

    }
}
