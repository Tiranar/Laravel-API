<?php

namespace App\Repositories;

use App\Models\AuthToken;
use App\Repositories\BaseRepository;

/**
 * Class AuthTokenRepository
 * @package App\Repositories
 * @version May 1, 2020, 1:50 pm UTC
*/

class AuthTokenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '__version',
        'organizationId',
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
        return AuthToken::class;
    }
}
