<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActionsAPIRequest;
use App\Http\Requests\API\UpdateActionsAPIRequest;
use App\Models\Actions;
use App\Repositories\ActionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActionsController
 * @package App\Http\Controllers\API
 */

class ActionsAPIController extends AppBaseController
{
    /** @var  ActionsRepository */
    private $actionsRepository;

    public function __construct(ActionsRepository $actionsRepo)
    {
        $this->actionsRepository = $actionsRepo;
    }

    /**
     * Display a listing of the Actions.
     * GET|HEAD /actions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $actions = $this->actionsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($actions->toArray(), 'Actions retrieved successfully');
    }

    /**
     * Store a newly created Actions in storage.
     * POST /actions
     *
     * @param CreateActionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActionsAPIRequest $request)
    {
        $input = $request->all();

        $actions = $this->actionsRepository->create($input);

        return response()->success($actions->toArray(), 'Actions saved successfully');
    }

    /**
     * Display the specified Actions.
     * GET|HEAD /actions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Actions $actions */
        $actions = $this->actionsRepository->find($id);

        if (empty($actions)) {
            return $this->sendError('Actions not found');
        }

        return response()->success($actions->toArray(), 'Actions retrieved successfully');
    }

    /**
     * Update the specified Actions in storage.
     * PUT/PATCH /actions/{id}
     *
     * @param int $id
     * @param UpdateActionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Actions $actions */
        $actions = $this->actionsRepository->find($id);

        if (empty($actions)) {
            return $this->sendError('Actions not found');
        }

        $actions = $this->actionsRepository->update($input, $id);

        return response()->success($actions->toArray(), 'Actions updated successfully');
    }

    /**
     * Remove the specified Actions from storage.
     * DELETE /actions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Actions $actions */
        $actions = $this->actionsRepository->find($id);

        if (empty($actions)) {
            return $this->sendError('Actions not found');
        }

        $actions->delete();

        return $this->sendSuccess('Actions deleted successfully');
    }
}
