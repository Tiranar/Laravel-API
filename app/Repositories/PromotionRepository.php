<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\BaseRepository;

/**
 * Class PromotionRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:10 pm UTC
*/

class PromotionRepository extends BaseRepository
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
        'expiration',
        'userId',
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
        return Promotion::class;
    }
}
