<?php namespace Tests\Repositories;

use App\Models\AuthToken;
use App\Repositories\AuthTokenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AuthTokenRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AuthTokenRepository
     */
    protected $authTokenRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->authTokenRepo = \App::make(AuthTokenRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_auth_token()
    {
        $authToken = factory(AuthToken::class)->make()->toArray();

        $createdAuthToken = $this->authTokenRepo->create($authToken);

        $createdAuthToken = $createdAuthToken->toArray();
        $this->assertArrayHasKey('id', $createdAuthToken);
        $this->assertNotNull($createdAuthToken['id'], 'Created AuthToken must have id specified');
        $this->assertNotNull(AuthToken::find($createdAuthToken['id']), 'AuthToken with given id must be in DB');
        $this->assertModelData($authToken, $createdAuthToken);
    }

    /**
     * @test read
     */
    public function test_read_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();

        $dbAuthToken = $this->authTokenRepo->find($authToken->id);

        $dbAuthToken = $dbAuthToken->toArray();
        $this->assertModelData($authToken->toArray(), $dbAuthToken);
    }

    /**
     * @test update
     */
    public function test_update_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();
        $fakeAuthToken = factory(AuthToken::class)->make()->toArray();

        $updatedAuthToken = $this->authTokenRepo->update($fakeAuthToken, $authToken->id);

        $this->assertModelData($fakeAuthToken, $updatedAuthToken->toArray());
        $dbAuthToken = $this->authTokenRepo->find($authToken->id);
        $this->assertModelData($fakeAuthToken, $dbAuthToken->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_auth_token()
    {
        $authToken = factory(AuthToken::class)->create();

        $resp = $this->authTokenRepo->delete($authToken->id);

        $this->assertTrue($resp);
        $this->assertNull(AuthToken::find($authToken->id), 'AuthToken should not exist in DB');
    }
}
