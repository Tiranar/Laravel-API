<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrganizationGroup;

class OrganizationGroupApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/organization_groups', $organizationGroup
        );

        $this->assertApiResponse($organizationGroup);
    }

    /**
     * @test
     */
    public function test_read_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/organization_groups/'.$organizationGroup->id
        );

        $this->assertApiResponse($organizationGroup->toArray());
    }

    /**
     * @test
     */
    public function test_update_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();
        $editedOrganizationGroup = factory(OrganizationGroup::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/organization_groups/'.$organizationGroup->id,
            $editedOrganizationGroup
        );

        $this->assertApiResponse($editedOrganizationGroup);
    }

    /**
     * @test
     */
    public function test_delete_organization_group()
    {
        $organizationGroup = factory(OrganizationGroup::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/organization_groups/'.$organizationGroup->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/organization_groups/'.$organizationGroup->id
        );

        $this->response->assertStatus(404);
    }
}
