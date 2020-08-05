<?php

namespace App\Repositories;

use App\Models\Receipt;
use App\Repositories\BaseRepository;

/**
 * Class ReceiptRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:11 pm UTC
*/

class ReceiptRepository extends BaseRepository
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
        'duration',
        'userId',
        'env',
        'receipt',
        'createdAt',
        'updatedAt',
        'service',
        'meta'
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
        return Receipt::class;
    }
}
