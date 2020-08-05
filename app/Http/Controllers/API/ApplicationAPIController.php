<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApplicationAPIRequest;
use App\Http\Requests\API\UpdateApplicationAPIRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicationController
 * @package App\Http\Controllers\API
 */

class ApplicationAPIController extends AppBaseController
{
    /** @var  ApplicationRepository */
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * Display a listing of the Application.
     * GET|HEAD /applications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applications = $this->applicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($applications->toArray(), 'Applications retrieved successfully');
    }

    /**
     * Store a newly created Application in storage.
     * POST /applications
     *
     * @param CreateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationAPIRequest $request)
    {
        $input = $request->all();

        $application = $this->applicationRepository->create($input);

        return response()->success($application->toArray(), 'Application saved successfully');
    }

    /**
     * Display the specified Application.
     * GET|HEAD /applications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        return response()->success($application->toArray(), 'Application retrieved successfully');
    }

    /**
     * Update the specified Application in storage.
     * PUT/PATCH /applications/{id}
     *
     * @param int $id
     * @param UpdateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application = $this->applicationRepository->update($input, $id);

        return response()->success($application->toArray(), 'Application updated successfully');
    }

    /**
     * Remove the specified Application from storage.
     * DELETE /applications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application->delete();

        return $this->sendSuccess('Application deleted successfully');
    }
}
