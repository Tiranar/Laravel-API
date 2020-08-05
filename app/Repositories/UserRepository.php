<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version May 1, 2020, 2:13 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        '__version',
        'avatar',
        'character',
        'sid',
        'status',
        'firstName',
        'furthestFloor',
        'furthestInteraction',
        'furthestLesson',
        'name',
        'email',
        'trigger_elevator_first',
        'trigger_fp_room_first',
        'trigger_lobby_first',
        'trigger_mf_first',
        'trigger_trophy_room_first',
        'deviceGeneration',
        'hash',
        'osVersion',
        'createdAt',
        'updatedAt',
        'lastDiskSpaceWarning',
        'passwordResetToken',
        '__state',
        'applicationId',
        'applicationSecret',
        'receipt',
        'organizationId'
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
        return User::class;
    }
}
