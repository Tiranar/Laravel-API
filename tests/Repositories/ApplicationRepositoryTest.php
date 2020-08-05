<?php namespace Tests\Repositories;

use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplicationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplicationRepository
     */
    protected $applicationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationRepo = \App::make(ApplicationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application()
    {
        $application = factory(Application::class)->make()->toArray();

        $createdApplication = $this->applicationRepo->create($application);

        $createdApplication = $createdApplication->toArray();
        $this->assertArrayHasKey('id', $createdApplication);
        $this->assertNotNull($createdApplication['id'], 'Created Application must have id specified');
        $this->assertNotNull(Application::find($createdApplication['id']), 'Application with given id must be in DB');
        $this->assertModelData($application, $createdApplication);
    }

    /**
     * @test read
     */
    public function test_read_application()
    {
        $application = factory(Application::class)->create();

        $dbApplication = $this->applicationRepo->find($application->id);

        $dbApplication = $dbApplication->toArray();
        $this->assertModelData($application->toArray(), $dbApplication);
    }

    /**
     * @test update
     */
    public function test_update_application()
    {
        $application = factory(Application::class)->create();
        $fakeApplication = factory(Application::class)->make()->toArray();

        $updatedApplication = $this->applicationRepo->update($fakeApplication, $application->id);

        $this->assertModelData($fakeApplication, $updatedApplication->toArray());
        $dbApplication = $this->applicationRepo->find($application->id);
        $this->assertModelData($fakeApplication, $dbApplication->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application()
    {
        $application = factory(Application::class)->create();

        $resp = $this->applicationRepo->delete($application->id);

        $this->assertTrue($resp);
        $this->assertNull(Application::find($application->id), 'Application should not exist in DB');
    }
}
