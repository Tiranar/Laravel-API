<?php

namespace App\Repositories;

use App\Models\Items;
use App\Repositories\BaseRepository;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:01 pm UTC
 */

class ItemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'type',
        'name',
        'createdAt',
        'updatedAt',
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
        return Items::class;
    }
}
