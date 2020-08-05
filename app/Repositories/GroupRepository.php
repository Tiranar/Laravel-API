<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\BaseRepository;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:01 pm UTC
*/

class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'title',
        'organizationId',
        'sid',
        'status',
        'createdAt',
        'updatedAt',
        '__state',
        'applicationId',
        'applicationSecret'
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
        return Group::class;
    }
}
