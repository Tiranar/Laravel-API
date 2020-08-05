<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrganizationApplicationAPIRequest;
use App\Http\Requests\API\UpdateOrganizationApplicationAPIRequest;
use App\Models\OrganizationApplication;
use App\Repositories\OrganizationApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrganizationApplicationController
 * @package App\Http\Controllers\API
 */

class OrganizationApplicationAPIController extends AppBaseController
{
    /** @var  OrganizationApplicationRepository */
    private $organizationApplicationRepository;

    public function __construct(OrganizationApplicationRepository $organizationApplicationRepo)
    {
        $this->organizationApplicationRepository = $organizationApplicationRepo;
    }

    /**
     * Display a listing of the OrganizationApplication.
     * GET|HEAD /organizationApplications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organizationApplications = $this->organizationApplicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($organizationApplications->toArray(), 'Organization Applications retrieved successfully');
    }

    /**
     * Store a newly created OrganizationApplication in storage.
     * POST /organizationApplications
     *
     * @param CreateOrganizationApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganizationApplicationAPIRequest $request)
    {
        $input = $request->all();

        $organizationApplication = $this->organizationApplicationRepository->create($input);

        return response()->success($organizationApplication->toArray(), 'Organization Application saved successfully');
    }

    /**
     * Display the specified OrganizationApplication.
     * GET|HEAD /organizationApplications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrganizationApplication $organizationApplication */
        $organizationApplication = $this->organizationApplicationRepository->find($id);

        if (empty($organizationApplication)) {
            return $this->sendError('Organization Application not found');
        }

        return response()->success($organizationApplication->toArray(), 'Organization Application retrieved successfully');
    }

    /**
     * Update the specified OrganizationApplication in storage.
     * PUT/PATCH /organizationApplications/{id}
     *
     * @param int $id
     * @param UpdateOrganizationApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganizationApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrganizationApplication $organizationApplication */
        $organizationApplication = $this->organizationApplicationRepository->find($id);

        if (empty($organizationApplication)) {
            return $this->sendError('Organization Application not found');
        }

        $organizationApplication = $this->organizationApplicationRepository->update($input, $id);

        return response()->success($organizationApplication->toArray(), 'OrganizationApplication updated successfully');
    }

    /**
     * Remove the specified OrganizationApplication from storage.
     * DELETE /organizationApplications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrganizationApplication $organizationApplication */
        $organizationApplication = $this->organizationApplicationRepository->find($id);

        if (empty($organizationApplication)) {
            return $this->sendError('Organization Application not found');
        }

        $organizationApplication->delete();

        return $this->sendSuccess('Organization Application deleted successfully');
    }
}
