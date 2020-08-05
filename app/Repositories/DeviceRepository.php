<?php

namespace App\Repositories;

use App\Models\Device;
use App\Repositories\BaseRepository;

/**
 * Class DeviceRepository
 * @package App\Repositories
 * @version May 1, 2020, 1:55 pm UTC
*/

class DeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'applicationId',
        'organizationId',
        'sid',
        'status',
        'token',
        'userId',
        'env',
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
        return Device::class;
    }
}
