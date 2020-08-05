<?php

namespace App\Repositories;

use App\Models\Application;
use App\Repositories\BaseRepository;

/**
 * Class ApplicationRepository
 * @package App\Repositories
 * @version May 1, 2020, 1:48 pm UTC
*/

class ApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__state',
        '__version',
        'title',
        'secret',
        'sid',
        'status',
        'hostnames',
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
        return Application::class;
    }
}
