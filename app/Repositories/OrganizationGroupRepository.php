<?php

namespace App\Repositories;

use App\Models\OrganizationGroup;
use App\Repositories\BaseRepository;

/**
 * Class OrganizationGroupRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:23 pm UTC
*/

class OrganizationGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'groupId',
        'organizationId'
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
        return OrganizationGroup::class;
    }
}
