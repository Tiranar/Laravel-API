<?php

namespace App\Repositories;

use App\Models\OrganizationUser;
use App\Repositories\BaseRepository;

/**
 * Class OrganizationUserRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:17 pm UTC
*/

class OrganizationUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'userId',
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
        return OrganizationUser::class;
    }
}
