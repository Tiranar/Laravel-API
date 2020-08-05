<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\GroupUser;

class GroupUserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_group_user()
    {
        $groupUser = factory(GroupUser::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/group_users', $groupUser
        );

        $this->assertApiResponse($groupUser);
    }

    /**
     * @test
     */
    public function test_read_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/group_users/'.$groupUser->id
        );

        $this->assertApiResponse($groupUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();
        $editedGroupUser = factory(GroupUser::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/group_users/'.$groupUser->id,
            $editedGroupUser
        );

        $this->assertApiResponse($editedGroupUser);
    }

    /**
     * @test
     */
    public function test_delete_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/group_users/'.$groupUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/group_users/'.$groupUser->id
        );

        $this->response->assertStatus(404);
    }
}
