<?php

namespace App\Repositories;

use App\Models\OrganizationApplication;
use App\Repositories\BaseRepository;

/**
 * Class OrganizationApplicationRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:20 pm UTC
*/

class OrganizationApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'applicationId',
        'organizationId',
        '__state'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrganizationApplication::class;
    }
}
