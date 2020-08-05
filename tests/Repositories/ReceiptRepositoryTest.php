<?php namespace Tests\Repositories;

use App\Models\Receipt;
use App\Repositories\ReceiptRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ReceiptRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReceiptRepository
     */
    protected $receiptRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->receiptRepo = \App::make(ReceiptRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_receipt()
    {
        $receipt = factory(Receipt::class)->make()->toArray();

        $createdReceipt = $this->receiptRepo->create($receipt);

        $createdReceipt = $createdReceipt->toArray();
        $this->assertArrayHasKey('id', $createdReceipt);
        $this->assertNotNull($createdReceipt['id'], 'Created Receipt must have id specified');
        $this->assertNotNull(Receipt::find($createdReceipt['id']), 'Receipt with given id must be in DB');
        $this->assertModelData($receipt, $createdReceipt);
    }

    /**
     * @test read
     */
    public function test_read_receipt()
    {
        $receipt = factory(Receipt::class)->create();

        $dbReceipt = $this->receiptRepo->find($receipt->id);

        $dbReceipt = $dbReceipt->toArray();
        $this->assertModelData($receipt->toArray(), $dbReceipt);
    }

    /**
     * @test update
     */
    public function test_update_receipt()
    {
        $receipt = factory(Receipt::class)->create();
        $fakeReceipt = factory(Receipt::class)->make()->toArray();

        $updatedReceipt = $this->receiptRepo->update($fakeReceipt, $receipt->id);

        $this->assertModelData($fakeReceipt, $updatedReceipt->toArray());
        $dbReceipt = $this->receiptRepo->find($receipt->id);
        $this->assertModelData($fakeReceipt, $dbReceipt->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_receipt()
    {
        $receipt = factory(Receipt::class)->create();

        $resp = $this->receiptRepo->delete($receipt->id);

        $this->assertTrue($resp);
        $this->assertNull(Receipt::find($receipt->id), 'Receipt should not exist in DB');
    }
}
