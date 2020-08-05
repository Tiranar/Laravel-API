<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReceiptAPIRequest;
use App\Http\Requests\API\UpdateReceiptAPIRequest;
use App\Models\Receipt;
use App\Repositories\ReceiptRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Http\Helpers\ReceiptHelper;

/**
 * Class ReceiptController
 * @package App\Http\Controllers\API
 */

class ReceiptAPIController extends AppBaseController
{
    /** @var  ReceiptRepository */
    private $receiptRepository;

    public function __construct(ReceiptRepository $receiptRepo)
    {
        $this->receiptRepository = $receiptRepo;
    }

    /**
     * Display a listing of the Receipt.
     * GET|HEAD /receipts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $receipts = $this->receiptRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($receipts->toArray(), 'Receipts retrieved successfully');
    }

    /**
     * Store a newly created Receipt in storage.
     * POST /receipts
     *
     * @param CreateReceiptAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReceiptAPIRequest $request)
    {
        $input = $request->all();

        $receipt = $this->receiptRepository->create($input);

        return response()->success($receipt->toArray(), 'Receipt saved successfully');
    }

    /**
     * Display the specified Receipt.
     * GET|HEAD /receipts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Receipt $receipt */
        $receipt = $this->receiptRepository->find($id);

        if (empty($receipt)) {
            return $this->sendError('Receipt not found');
        }

        return response()->success($receipt->toArray(), 'Receipt retrieved successfully');
    }

    /**
     * Update the specified Receipt in storage.
     * PUT/PATCH /receipts/{id}
     *
     * @param int $id
     * @param UpdateReceiptAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReceiptAPIRequest $request)
    {
        $input = $request->all();

        /** @var Receipt $receipt */
        $receipt = $this->receiptRepository->find($id);

        if (empty($receipt)) {
            return $this->sendError('Receipt not found');
        }

        $receipt = $this->receiptRepository->update($input, $id);

        return response()->success($receipt->toArray(), 'Receipt updated successfully');
    }

    /**
     * Remove the specified Receipt from storage.
     * DELETE /receipts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Receipt $receipt */
        $receipt = $this->receiptRepository->find($id);

        if (empty($receipt)) {
            return $this->sendError('Receipt not found');
        }

        $receipt->delete();

        return $this->sendSuccess('Receipt deleted successfully');
    }


    public function validateApple(Request $request) {
        $input = $request->all();
        
        $receiptResponse = ReceiptHelper::validateApple($input['receipt']);

        if ($receiptResponse->isValid()) {
            // echo 'Receipt is valid.' . PHP_EOL;
            // echo 'Receipt data = ' . print_r($response->getReceipt()) . PHP_EOL;
            
            $validationResponse = $receiptResponse->getReceipt();

            // foreach ($response->getPurchases() as $purchase) {
            //     echo 'getProductId: ' . $purchase->getProductId() . PHP_EOL;
            //     echo 'getTransactionId: ' . $purchase->getTransactionId() . PHP_EOL;

            //     if ($purchase->getPurchaseDate() != null) {
            //     echo 'getPurchaseDate: ' . $purchase->getPurchaseDate()->toIso8601String() . PHP_EOL;
            //     }
            // }
        } else {
            // echo 'Receipt is not valid.' . PHP_EOL;
            // echo 'Receipt result code = ' . $response->getResultCode() . PHP_EOL;


            $validationResponse = [
                "status" => "invalid",
                "response_code" => $receiptResponse->getResultCode()
            ];
        }

        return response()->success($validationResponse, 'Receipt updated successfully');
    }
}
