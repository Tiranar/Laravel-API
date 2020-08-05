<?php

namespace App\Repositories;

use App\Models\Actions;
use App\Repositories\BaseRepository;

/**
 * Class ActionsRepository
 * @package App\Repositories
 * @version May 1, 2020, 1:46 pm UTC
*/

class ActionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'authenticated',
        'email',
        '__state',
        'createdAt',
        'organizationId',
        'sid',
        'status',
        'updatedAt',
        'username'
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
        return Actions::class;
    }
}
