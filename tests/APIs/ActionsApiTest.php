<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Actions;

class ActionsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_actions()
    {
        $actions = factory(Actions::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/actions', $actions
        );

        $this->assertApiResponse($actions);
    }

    /**
     * @test
     */
    public function test_read_actions()
    {
        $actions = factory(Actions::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/actions/'.$actions->id
        );

        $this->assertApiResponse($actions->toArray());
    }

    /**
     * @test
     */
    public function test_update_actions()
    {
        $actions = factory(Actions::class)->create();
        $editedActions = factory(Actions::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/actions/'.$actions->id,
            $editedActions
        );

        $this->assertApiResponse($editedActions);
    }

    /**
     * @test
     */
    public function test_delete_actions()
    {
        $actions = factory(Actions::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/actions/'.$actions->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/actions/'.$actions->id
        );

        $this->response->assertStatus(404);
    }
}
