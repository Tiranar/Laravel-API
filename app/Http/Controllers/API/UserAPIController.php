<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Http;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $input['status'] = 'active';

        if(empty($input['password'])) {
            $input['hash'] = null;
            $input['password'] = null;
        } else {
            $input['hash'] = bcrypt($input['password']);
            $input['password'] = bcrypt($input['password']);
        }



        $user = $this->userRepository->create($input);

        return response()->success($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        // $user = $this->userRepository->find($id);

        $userId = $id;
        $user = User::where("id", $userId)->first();

        if(empty($user)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                ])->asForm()->get('http://example.cloud/api/0.1/users/'.$userId, [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            return response()->success($response, 'User retrieved successfully', 200);
        }

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return response()->success($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return response()->success($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }



    /**
     * Display a listing of the Group.
     * GET|HEAD /groups
     *
     * @param Request $request
     * @return Response
     */
    public function groups($user, Request $request)
    {
        $userId = $user;
        $user = User::where("id", $userId)->first();

        if(empty($user)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                ])->asForm()->get('http://example.cloud/api/0.1/groups/of/users/'.$userId, [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            return response()->success($response, 'User Groups retrieved successfully', 200);
        }


        $user->load("groups");

        return response()->success($user->groups->toArray(), 'User Groups retrieved successfully');
    }
}
