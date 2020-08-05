<?php namespace Tests\Repositories;

use App\Models\OrganizationApplication;
use App\Repositories\OrganizationApplicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrganizationApplicationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrganizationApplicationRepository
     */
    protected $organizationApplicationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->organizationApplicationRepo = \App::make(OrganizationApplicationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->make()->toArray();

        $createdOrganizationApplication = $this->organizationApplicationRepo->create($organizationApplication);

        $createdOrganizationApplication = $createdOrganizationApplication->toArray();
        $this->assertArrayHasKey('id', $createdOrganizationApplication);
        $this->assertNotNull($createdOrganizationApplication['id'], 'Created OrganizationApplication must have id specified');
        $this->assertNotNull(OrganizationApplication::find($createdOrganizationApplication['id']), 'OrganizationApplication with given id must be in DB');
        $this->assertModelData($organizationApplication, $createdOrganizationApplication);
    }

    /**
     * @test read
     */
    public function test_read_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();

        $dbOrganizationApplication = $this->organizationApplicationRepo->find($organizationApplication->id);

        $dbOrganizationApplication = $dbOrganizationApplication->toArray();
        $this->assertModelData($organizationApplication->toArray(), $dbOrganizationApplication);
    }

    /**
     * @test update
     */
    public function test_update_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();
        $fakeOrganizationApplication = factory(OrganizationApplication::class)->make()->toArray();

        $updatedOrganizationApplication = $this->organizationApplicationRepo->update($fakeOrganizationApplication, $organizationApplication->id);

        $this->assertModelData($fakeOrganizationApplication, $updatedOrganizationApplication->toArray());
        $dbOrganizationApplication = $this->organizationApplicationRepo->find($organizationApplication->id);
        $this->assertModelData($fakeOrganizationApplication, $dbOrganizationApplication->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();

        $resp = $this->organizationApplicationRepo->delete($organizationApplication->id);

        $this->assertTrue($resp);
        $this->assertNull(OrganizationApplication::find($organizationApplication->id), 'OrganizationApplication should not exist in DB');
    }
}
