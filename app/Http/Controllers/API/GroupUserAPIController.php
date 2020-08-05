<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGroupUserAPIRequest;
use App\Http\Requests\API\UpdateGroupUserAPIRequest;
use App\Models\GroupUser;
use App\Repositories\GroupUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GroupUserController
 * @package App\Http\Controllers\API
 */

class GroupUserAPIController extends AppBaseController
{
    /** @var  GroupUserRepository */
    private $groupUserRepository;

    public function __construct(GroupUserRepository $groupUserRepo)
    {
        $this->groupUserRepository = $groupUserRepo;
    }

    /**
     * Display a listing of the GroupUser.
     * GET|HEAD /groupUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $groupUsers = $this->groupUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($groupUsers->toArray(), 'Group Users retrieved successfully');
    }

    /**
     * Store a newly created GroupUser in storage.
     * POST /groupUsers
     *
     * @param CreateGroupUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupUserAPIRequest $request)
    {
        $input = $request->all();

        $groupUser = $this->groupUserRepository->create($input);

        return response()->success($groupUser->toArray(), 'Group User saved successfully');
    }

    /**
     * Display the specified GroupUser.
     * GET|HEAD /groupUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var GroupUser $groupUser */
        $groupUser = $this->groupUserRepository->find($id);

        if (empty($groupUser)) {
            return $this->sendError('Group User not found');
        }

        return response()->success($groupUser->toArray(), 'Group User retrieved successfully');
    }

    /**
     * Update the specified GroupUser in storage.
     * PUT/PATCH /groupUsers/{id}
     *
     * @param int $id
     * @param UpdateGroupUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var GroupUser $groupUser */
        $groupUser = $this->groupUserRepository->find($id);

        if (empty($groupUser)) {
            return $this->sendError('Group User not found');
        }

        $groupUser = $this->groupUserRepository->update($input, $id);

        return response()->success($groupUser->toArray(), 'GroupUser updated successfully');
    }

    /**
     * Remove the specified GroupUser from storage.
     * DELETE /groupUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var GroupUser $groupUser */
        $groupUser = $this->groupUserRepository->find($id);

        if (empty($groupUser)) {
            return $this->sendError('Group User not found');
        }

        $groupUser->delete();

        return $this->sendSuccess('Group User deleted successfully');
    }
}
