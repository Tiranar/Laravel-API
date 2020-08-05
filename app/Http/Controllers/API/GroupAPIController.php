<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGroupAPIRequest;
use App\Http\Requests\API\UpdateGroupAPIRequest;
use App\Models\Group;
use App\Models\GroupUser;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

/**
 * Class GroupController
 * @package App\Http\Controllers\API
 */

class GroupAPIController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Group.
     * GET|HEAD /groups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $groups = $this->groupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($groups->toArray(), 'Groups retrieved successfully');
    }

    /**
     * Display a listing of the Group.
     * GET|HEAD /groups
     *
     * @param Request $request
     * @return Response
     */
    public function leaders($group, Request $request)
    {

        $groupId = $group;
        $group = Group::where("id", $groupId)->first();

        if(empty($group)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                ])->asForm()->get('http://example'.$groupId.'/leaders', [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            return response()->success($response, 'User Groups retrieved successfully', 200);
        }

        $group->load("leaders");

        return response()->success($group->toArray(), 'Group Leaders retrieved successfully');
    }

    /**
     * Display a listing of the Group.
     * GET|HEAD /groups
     *
     * @param Request $request
     * @return Response
     */
    public function members($group, Request $request)
    {
        $groupId = $group;
        $group = Group::where("id", $groupId)->first();

        if(empty($group)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                ])->asForm()->get('http://example.cloud/api/0.1/groups/'.$groupId.'/members', [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            return response()->success($response, 'User Groups retrieved successfully', 200);
        }

        $group->load("members");

        return response()->success($group->toArray(), 'Group Members retrieved successfully');
    }

    /**
     * Display a listing of the Group.
     * GET|HEAD /groups
     *
     * @param Request $request
     * @return Response
     */
    public function users($group, Request $request)
    {
        $groupId = $group;
        $group = Group::where("id", $groupId)->first();

        if(empty($group)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                ])->asForm()->get('http://axample.cloud/api/0.1/groups/'.$groupId.'/users', [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            return response()->success($response, 'User Groups retrieved successfully', 200);
        }

        $group->load("users");

        return response()->success($group->toArray(), 'Group Users retrieved successfully');
    }

    /**
     * Store a newly created Group in storage.
     * POST /groups
     *
     * @param CreateGroupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupAPIRequest $request)
    {
        $input = $request->all();

        $input['organizationId'] = '89c14727-e442-4f6a-8678-d041336025b6';
        $input['status'] = 'active';

        $group = $this->groupRepository->create($input);

        return response()->success($group->toArray(), 'Group saved successfully');
    }

    /**
     * Display the specified Group.
     * GET|HEAD /groups/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        // $responseArray = [
        //     "pkg" => $group->toArray(),
        // ];

        return response()->success($group->toArray(), 'Group retrieved successfully');
    }

    /**
     * Update the specified Group in storage.
     * PUT/PATCH /groups/{id}
     *
     * @param int $id
     * @param UpdateGroupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        $group = $this->groupRepository->update($input, $id);

        return response()->success($group->toArray(), 'Group updated successfully');
    }

    /**
     * Remove the specified Group from storage.
     * DELETE /groups/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        $group->delete();

        return $this->sendSuccess('Group deleted successfully');
    }

    public function addUserToGroup($groupId, $userId)
    {
        // $user = User::find($userId);

        // if (empty($user)) {
        //     return $this->sendError('User not found', 500);
        // }

        $input['groupId'] = $groupId;
        $input['userId'] = $userId;
        $input['status'] = 'active';

        if(!empty($input['leader']) && $input['leader'] == 'true') {
            $input['leader'] = true;
        }

        GroupUser::create($input);

        $group = Group::with("users")->find($groupId);

        return response()->success($group, 'User added to Group');
    }

    public function removeUserFromGroup($groupId, $userId)
    {

        $input['groupId'] = $groupId;
        $input['userId'] = $userId;
        $groupUser = GroupUser::where("groupId",$groupId)->where("userId",$userId)->first();

        if (empty($groupUser)) {
            return $this->sendError('User Group Association not found');
        }

        $groupUser->delete();

        return $this->sendSuccess('User removed from group successfully');
    }
}
