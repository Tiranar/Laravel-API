<?php namespace Tests\Repositories;

use App\Models\OrganizationGroup;
use App\Repositories\OrganizationGroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrganizationGroupRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrganizationGroupRepository
     */
    protected $organizationGroupRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->organizationGroupRepo = \App::make(OrganizationGroupRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->make()->toArray();

        $createdOrganizationGroup = $this->organizationGroupRepo->create($organizationGroup);

        $createdOrganizationGroup = $createdOrganizationGroup->toArray();
        $this->assertArrayHasKey('id', $createdOrganizationGroup);
        $this->assertNotNull($createdOrganizationGroup['id'], 'Created OrganizationGroup must have id specified');
        $this->assertNotNull(OrganizationGroup::find($createdOrganizationGroup['id']), 'OrganizationGroup with given id must be in DB');
        $this->assertModelData($organizationGroup, $createdOrganizationGroup);
    }

    /**
     * @test read
     */
    public function test_read_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();

        $dbOrganizationGroup = $this->organizationGroupRepo->find($organizationGroup->id);

        $dbOrganizationGroup = $dbOrganizationGroup->toArray();
        $this->assertModelData($organizationGroup->toArray(), $dbOrganizationGroup);
    }

    /**
     * @test update
     */
    public function test_update_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();
        $fakeOrganizationGroup = factory(OrganizationGroup::class)->make()->toArray();

        $updatedOrganizationGroup = $this->organizationGroupRepo->update($fakeOrganizationGroup, $organizationGroup->id);

        $this->assertModelData($fakeOrganizationGroup, $updatedOrganizationGroup->toArray());
        $dbOrganizationGroup = $this->organizationGroupRepo->find($organizationGroup->id);
        $this->assertModelData($fakeOrganizationGroup, $dbOrganizationGroup->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();

        $resp = $this->organizationGroupRepo->delete($organizationGroup->id);

        $this->assertTrue($resp);
        $this->assertNull(OrganizationGroup::find($organizationGroup->id), 'OrganizationGroup should not exist in DB');
    }
}
