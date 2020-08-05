<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\BaseRepository;

/**
 * Class OrganizationRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:08 pm UTC
*/

class OrganizationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        '__state',
        'title',
        'sid',
        'status',
        'createdAt',
        'updatedAt'
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
        return Organization::class;
    }
}
