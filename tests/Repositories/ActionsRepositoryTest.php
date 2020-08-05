<?php namespace Tests\Repositories;

use App\Models\Actions;
use App\Repositories\ActionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ActionsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActionsRepository
     */
    protected $actionsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->actionsRepo = \App::make(ActionsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_actions()
    {
        $actions = factory(Actions::class)->make()->toArray();

        $createdActions = $this->actionsRepo->create($actions);

        $createdActions = $createdActions->toArray();
        $this->assertArrayHasKey('id', $createdActions);
        $this->assertNotNull($createdActions['id'], 'Created Actions must have id specified');
        $this->assertNotNull(Actions::find($createdActions['id']), 'Actions with given id must be in DB');
        $this->assertModelData($actions, $createdActions);
    }

    /**
     * @test read
     */
    public function test_read_actions()
    {
        $actions = factory(Actions::class)->create();

        $dbActions = $this->actionsRepo->find($actions->id);

        $dbActions = $dbActions->toArray();
        $this->assertModelData($actions->toArray(), $dbActions);
    }

    /**
     * @test update
     */
    public function test_update_actions()
    {
        $actions = factory(Actions::class)->create();
        $fakeActions = factory(Actions::class)->make()->toArray();

        $updatedActions = $this->actionsRepo->update($fakeActions, $actions->id);

        $this->assertModelData($fakeActions, $updatedActions->toArray());
        $dbActions = $this->actionsRepo->find($actions->id);
        $this->assertModelData($fakeActions, $dbActions->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_actions()
    {
        $actions = factory(Actions::class)->create();

        $resp = $this->actionsRepo->delete($actions->id);

        $this->assertTrue($resp);
        $this->assertNull(Actions::find($actions->id), 'Actions should not exist in DB');
    }
}
