<?php namespace Tests\Repositories;

use App\Models\OrganizationUser;
use App\Repositories\OrganizationUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrganizationUserRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrganizationUserRepository
     */
    protected $organizationUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->organizationUserRepo = \App::make(OrganizationUserRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->make()->toArray();

        $createdOrganizationUser = $this->organizationUserRepo->create($organizationUser);

        $createdOrganizationUser = $createdOrganizationUser->toArray();
        $this->assertArrayHasKey('id', $createdOrganizationUser);
        $this->assertNotNull($createdOrganizationUser['id'], 'Created OrganizationUser must have id specified');
        $this->assertNotNull(OrganizationUser::find($createdOrganizationUser['id']), 'OrganizationUser with given id must be in DB');
        $this->assertModelData($organizationUser, $createdOrganizationUser);
    }

    /**
     * @test read
     */
    public function test_read_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();

        $dbOrganizationUser = $this->organizationUserRepo->find($organizationUser->id);

        $dbOrganizationUser = $dbOrganizationUser->toArray();
        $this->assertModelData($organizationUser->toArray(), $dbOrganizationUser);
    }

    /**
     * @test update
     */
    public function test_update_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();
        $fakeOrganizationUser = factory(OrganizationUser::class)->make()->toArray();

        $updatedOrganizationUser = $this->organizationUserRepo->update($fakeOrganizationUser, $organizationUser->id);

        $this->assertModelData($fakeOrganizationUser, $updatedOrganizationUser->toArray());
        $dbOrganizationUser = $this->organizationUserRepo->find($organizationUser->id);
        $this->assertModelData($fakeOrganizationUser, $dbOrganizationUser->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();

        $resp = $this->organizationUserRepo->delete($organizationUser->id);

        $this->assertTrue($resp);
        $this->assertNull(OrganizationUser::find($organizationUser->id), 'OrganizationUser should not exist in DB');
    }
}
