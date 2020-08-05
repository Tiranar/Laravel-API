<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrganizationGroupAPIRequest;
use App\Http\Requests\API\UpdateOrganizationGroupAPIRequest;
use App\Models\OrganizationGroup;
use App\Repositories\OrganizationGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrganizationGroupController
 * @package App\Http\Controllers\API
 */

class OrganizationGroupAPIController extends AppBaseController
{
    /** @var  OrganizationGroupRepository */
    private $organizationGroupRepository;

    public function __construct(OrganizationGroupRepository $organizationGroupRepo)
    {
        $this->organizationGroupRepository = $organizationGroupRepo;
    }

    /**
     * Display a listing of the OrganizationGroup.
     * GET|HEAD /organizationGroups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organizationGroups = $this->organizationGroupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($organizationGroups->toArray(), 'Organization Groups retrieved successfully');
    }

    /**
     * Store a newly created OrganizationGroup in storage.
     * POST /organizationGroups
     *
     * @param CreateOrganizationGroupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganizationGroupAPIRequest $request)
    {
        $input = $request->all();

        $organizationGroup = $this->organizationGroupRepository->create($input);

        return response()->success($organizationGroup->toArray(), 'Organization Group saved successfully');
    }

    /**
     * Display the specified OrganizationGroup.
     * GET|HEAD /organizationGroups/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrganizationGroup $organizationGroup */
        $organizationGroup = $this->organizationGroupRepository->find($id);

        if (empty($organizationGroup)) {
            return $this->sendError('Organization Group not found');
        }

        return response()->success($organizationGroup->toArray(), 'Organization Group retrieved successfully');
    }

    /**
     * Update the specified OrganizationGroup in storage.
     * PUT/PATCH /organizationGroups/{id}
     *
     * @param int $id
     * @param UpdateOrganizationGroupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganizationGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrganizationGroup $organizationGroup */
        $organizationGroup = $this->organizationGroupRepository->find($id);

        if (empty($organizationGroup)) {
            return $this->sendError('Organization Group not found');
        }

        $organizationGroup = $this->organizationGroupRepository->update($input, $id);

        return response()->success($organizationGroup->toArray(), 'OrganizationGroup updated successfully');
    }

    /**
     * Remove the specified OrganizationGroup from storage.
     * DELETE /organizationGroups/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrganizationGroup $organizationGroup */
        $organizationGroup = $this->organizationGroupRepository->find($id);

        if (empty($organizationGroup)) {
            return $this->sendError('Organization Group not found');
        }

        $organizationGroup->delete();

        return $this->sendSuccess('Organization Group deleted successfully');
    }
}
