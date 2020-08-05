<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    public $table = 'inventories';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'userId',
        'itemId',
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
