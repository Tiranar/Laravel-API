<?php namespace Tests\Repositories;

use App\Models\GroupUser;
use App\Repositories\GroupUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GroupUserRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GroupUserRepository
     */
    protected $groupUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->groupUserRepo = \App::make(GroupUserRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_group_user()
    {
        $groupUser = factory(GroupUser::class)->make()->toArray();

        $createdGroupUser = $this->groupUserRepo->create($groupUser);

        $createdGroupUser = $createdGroupUser->toArray();
        $this->assertArrayHasKey('id', $createdGroupUser);
        $this->assertNotNull($createdGroupUser['id'], 'Created GroupUser must have id specified');
        $this->assertNotNull(GroupUser::find($createdGroupUser['id']), 'GroupUser with given id must be in DB');
        $this->assertModelData($groupUser, $createdGroupUser);
    }

    /**
     * @test read
     */
    public function test_read_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();

        $dbGroupUser = $this->groupUserRepo->find($groupUser->id);

        $dbGroupUser = $dbGroupUser->toArray();
        $this->assertModelData($groupUser->toArray(), $dbGroupUser);
    }

    /**
     * @test update
     */
    public function test_update_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();
        $fakeGroupUser = factory(GroupUser::class)->make()->toArray();

        $updatedGroupUser = $this->groupUserRepo->update($fakeGroupUser, $groupUser->id);

        $this->assertModelData($fakeGroupUser, $updatedGroupUser->toArray());
        $dbGroupUser = $this->groupUserRepo->find($groupUser->id);
        $this->assertModelData($fakeGroupUser, $dbGroupUser->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_group_user()
    {
        $groupUser = factory(GroupUser::class)->create();

        $resp = $this->groupUserRepo->delete($groupUser->id);

        $this->assertTrue($resp);
        $this->assertNull(GroupUser::find($groupUser->id), 'GroupUser should not exist in DB');
    }
}
