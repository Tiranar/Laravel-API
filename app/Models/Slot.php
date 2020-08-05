<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    use SoftDeletes;

    public $table = 'slots';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'itemType',
        'description',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'id' => 'string',
        'itemType' => 'string',
        'description' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];
    public function items()
    {
        return $this->hasMany(Items::class);

    }
}
