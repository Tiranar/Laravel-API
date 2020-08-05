<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrganizationUser;

class OrganizationUserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/organization_users', $organizationUser
        );

        $this->assertApiResponse($organizationUser);
    }

    /**
     * @test
     */
    public function test_read_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/organization_users/'.$organizationUser->id
        );

        $this->assertApiResponse($organizationUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();
        $editedOrganizationUser = factory(OrganizationUser::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/organization_users/'.$organizationUser->id,
            $editedOrganizationUser
        );

        $this->assertApiResponse($editedOrganizationUser);
    }

    /**
     * @test
     */
    public function test_delete_organization_user()
    {
        $organizationUser = factory(OrganizationUser::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/organization_users/'.$organizationUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/organization_users/'.$organizationUser->id
        );

        $this->response->assertStatus(404);
    }
}
