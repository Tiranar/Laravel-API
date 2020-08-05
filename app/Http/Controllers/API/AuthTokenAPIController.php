<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAuthTokenAPIRequest;
use App\Http\Requests\API\UpdateAuthTokenAPIRequest;
use App\Models\AuthToken;
use App\Repositories\AuthTokenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AuthTokenController
 * @package App\Http\Controllers\API
 */

class AuthTokenAPIController extends AppBaseController
{
    /** @var  AuthTokenRepository */
    private $authTokenRepository;

    public function __construct(AuthTokenRepository $authTokenRepo)
    {
        $this->authTokenRepository = $authTokenRepo;
    }

    /**
     * Display a listing of the AuthToken.
     * GET|HEAD /authTokens
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $authTokens = $this->authTokenRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($authTokens->toArray(), 'Auth Tokens retrieved successfully');
    }

    /**
     * Store a newly created AuthToken in storage.
     * POST /authTokens
     *
     * @param CreateAuthTokenAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAuthTokenAPIRequest $request)
    {
        $input = $request->all();

        $authToken = $this->authTokenRepository->create($input);

        return response()->success($authToken->toArray(), 'Auth Token saved successfully');
    }

    /**
     * Display the specified AuthToken.
     * GET|HEAD /authTokens/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AuthToken $authToken */
        $authToken = $this->authTokenRepository->find($id);

        if (empty($authToken)) {
            return $this->sendError('Auth Token not found');
        }

        return response()->success($authToken->toArray(), 'Auth Token retrieved successfully');
    }

    /**
     * Update the specified AuthToken in storage.
     * PUT/PATCH /authTokens/{id}
     *
     * @param int $id
     * @param UpdateAuthTokenAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuthTokenAPIRequest $request)
    {
        $input = $request->all();

        /** @var AuthToken $authToken */
        $authToken = $this->authTokenRepository->find($id);

        if (empty($authToken)) {
            return $this->sendError('Auth Token not found');
        }

        $authToken = $this->authTokenRepository->update($input, $id);

        return response()->success($authToken->toArray(), 'AuthToken updated successfully');
    }

    /**
     * Remove the specified AuthToken from storage.
     * DELETE /authTokens/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AuthToken $authToken */
        $authToken = $this->authTokenRepository->find($id);

        if (empty($authToken)) {
            return $this->sendError('Auth Token not found');
        }

        $authToken->delete();

        return $this->sendSuccess('Auth Token deleted successfully');
    }
}
