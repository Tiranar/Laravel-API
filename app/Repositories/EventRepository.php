<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:00 pm UTC
*/

class EventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'applicationId',
        'childFirstName',
        'childId',
        'ip',
        'label',
        'origin',
        'parentEmail',
        'parentFirstName',
        'parentId',
        'sid',
        'status',
        'time',
        'useragent',
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
        return Event::class;
    }
}
