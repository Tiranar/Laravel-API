<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrganizationApplication;

class OrganizationApplicationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/organization_applications', $organizationApplication
        );

        $this->assertApiResponse($organizationApplication);
    }

    /**
     * @test
     */
    public function test_read_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/organization_applications/'.$organizationApplication->id
        );

        $this->assertApiResponse($organizationApplication->toArray());
    }

    /**
     * @test
     */
    public function test_update_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();
        $editedOrganizationApplication = factory(OrganizationApplication::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/organization_applications/'.$organizationApplication->id,
            $editedOrganizationApplication
        );

        $this->assertApiResponse($editedOrganizationApplication);
    }

    /**
     * @test
     */
    public function test_delete_organization_application()
    {
        $organizationApplication = factory(OrganizationApplication::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/organization_applications/'.$organizationApplication->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/organization_applications/'.$organizationApplication->id
        );

        $this->response->assertStatus(404);
    }
}
