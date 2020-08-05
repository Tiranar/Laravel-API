<?php

namespace App\Models;

use App\Models\AppBaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrganizationApplication
 * @package App\Models
 * @version May 1, 2020, 2:20 pm UTC
 *
 * @property string $applicationId
 * @property string $organizationId
 * @property string $__state
 */
class OrganizationApplication extends Model
{
    use SoftDeletes;

    public $table = 'link_organizations_applications';
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'applicationId',
        'organizationId',
        '__state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'applicationId' => 'string',
        'organizationId' => 'string',
        '__state' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

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
