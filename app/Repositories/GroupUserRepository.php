<?php

namespace App\Repositories;

use App\Models\GroupUser;
use App\Repositories\BaseRepository;

/**
 * Class GroupUserRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:16 pm UTC
*/

class GroupUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'groupId',
        'userId',
        'leader',
        'sid',
        'status',
        'createdAt',
        'updatedAt',
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
        return GroupUser::class;
    }
}
