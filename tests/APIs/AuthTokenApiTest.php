<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AuthToken;

class AuthTokenApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_auth_token()
    {
        $authToken = factory(AuthToken::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/auth_tokens', $authToken
        );

        $this->assertApiResponse($authToken);
    }

    /**
     * @test
     */
    public function test_read_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/auth_tokens/'.$authToken->id
        );

        $this->assertApiResponse($authToken->toArray());
    }

    /**
     * @test
     */
    public function test_update_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();
        $editedAuthToken = factory(AuthToken::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/auth_tokens/'.$authToken->id,
            $editedAuthToken
        );

        $this->assertApiResponse($editedAuthToken);
    }

    /**
     * @test
     */
    public function test_delete_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/auth_tokens/'.$authToken->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/auth_tokens/'.$authToken->id
        );

        $this->response->assertStatus(404);
    }
}
