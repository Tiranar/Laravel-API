<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrganizationUserAPIRequest;
use App\Http\Requests\API\UpdateOrganizationUserAPIRequest;
use App\Models\OrganizationUser;
use App\Repositories\OrganizationUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrganizationUserController
 * @package App\Http\Controllers\API
 */

class OrganizationUserAPIController extends AppBaseController
{
    /** @var  OrganizationUserRepository */
    private $organizationUserRepository;

    public function __construct(OrganizationUserRepository $organizationUserRepo)
    {
        $this->organizationUserRepository = $organizationUserRepo;
    }

    /**
     * Display a listing of the OrganizationUser.
     * GET|HEAD /organizationUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organizationUsers = $this->organizationUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($organizationUsers->toArray(), 'Organization Users retrieved successfully');
    }

    /**
     * Store a newly created OrganizationUser in storage.
     * POST /organizationUsers
     *
     * @param CreateOrganizationUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganizationUserAPIRequest $request)
    {
        $input = $request->all();

        $organizationUser = $this->organizationUserRepository->create($input);

        return response()->success($organizationUser->toArray(), 'Organization User saved successfully');
    }

    /**
     * Display the specified OrganizationUser.
     * GET|HEAD /organizationUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrganizationUser $organizationUser */
        $organizationUser = $this->organizationUserRepository->find($id);

        if (empty($organizationUser)) {
            return $this->sendError('Organization User not found');
        }

        return response()->success($organizationUser->toArray(), 'Organization User retrieved successfully');
    }

    /**
     * Update the specified OrganizationUser in storage.
     * PUT/PATCH /organizationUsers/{id}
     *
     * @param int $id
     * @param UpdateOrganizationUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganizationUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrganizationUser $organizationUser */
        $organizationUser = $this->organizationUserRepository->find($id);

        if (empty($organizationUser)) {
            return $this->sendError('Organization User not found');
        }

        $organizationUser = $this->organizationUserRepository->update($input, $id);

        return response()->success($organizationUser->toArray(), 'OrganizationUser updated successfully');
    }

    /**
     * Remove the specified OrganizationUser from storage.
     * DELETE /organizationUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrganizationUser $organizationUser */
        $organizationUser = $this->organizationUserRepository->find($id);

        if (empty($organizationUser)) {
            return $this->sendError('Organization User not found');
        }

        $organizationUser->delete();

        return $this->sendSuccess('Organization User deleted successfully');
    }
}
