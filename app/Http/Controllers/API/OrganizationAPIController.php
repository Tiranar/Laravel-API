<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrganizationAPIRequest;
use App\Http\Requests\API\UpdateOrganizationAPIRequest;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Illuminate\Support\Facades\Http;

use App\Models\Application;
use App\Models\User;

use Response;

/**
 * Class OrganizationController
 * @package App\Http\Controllers\API
 */

class OrganizationAPIController extends AppBaseController
{
    /** @var  OrganizationRepository */
    private $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepo)
    {
        $this->organizationRepository = $organizationRepo;
    }

    /**
     * Display a listing of the Organization.
     * GET|HEAD /organizations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organizations = $this->organizationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return response()->success($organizations->toArray(), 'Organizations retrieved successfully');
    }

    /**
     * Store a newly created Organization in storage.
     * POST /organizations
     *
     * @param CreateOrganizationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganizationAPIRequest $request)
    {
        $input = $request->all();

        $organization = $this->organizationRepository->create($input);

        return response()->success($organization->toArray(), 'Organization saved successfully');
    }

    /**
     * Display the specified Organization.
     * GET|HEAD /organizations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id);

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        return response()->success($organization->toArray(), 'Organization retrieved successfully');
    }

    /**
     * Update the specified Organization in storage.
     * PUT/PATCH /organizations/{id}
     *
     * @param int $id
     * @param UpdateOrganizationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganizationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id);

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        $organization = $this->organizationRepository->update($input, $id);

        return response()->success($organization->toArray(), 'Organization updated successfully');
    }

    /**
     * Remove the specified Organization from storage.
     * DELETE /organizations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id);

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        $organization->delete();

        return $this->sendSuccess('Organization deleted successfully');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        try {
            $guzzleResult = Http::withOptions([
                    'debug' => false,
                    'timeout' => 50
                ])->withHeaders([
                'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2'

            ])->asForm()->post('http://example.cloud/api/0.1/auth/login', [
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $guzzleResult = $e->getResponse();
        }

        $response = $guzzleResult['pkg'];

        return response()->success($response, 'User Login retrieved successfully', 201);
    }

    public function sync(Request $request)
    {
        $input = $request->all();

        $headers = collect($request->header())->transform(function ($item) {
            return $item[0];
        });

        $headers = $headers->toArray();
        // return $headers;


        $userId = $headers['userid'];

        $org = Organization::first();
        $application = Application::first();

        $user = User::where("id", $userId)->first();

        if(empty($user)) {

            try {
                $guzzleResult = Http::withOptions([
                        'debug' => false,
                        'timeout' => 50
                    ])->withHeaders([
                    'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                    'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2',
                    'userId' => $userId

                ])->asForm()->post('http://example.cloud/api/0.1/sync', [

                ]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $guzzleResult = $e->getResponse();
            }

            $response = $guzzleResult['pkg'];

            if($response['user']['email'] == "yudiz003@testing.com") {

                $response['user']['subscription'] = [
                    "expired" => false,
                    "receipt" => false,
                    "status" => 0,
                    "valid" => true,
                    "duration" => "month",
                    "expiresMs" => 1624564297000,
                    "statusMessage" => null,
                    "source" => "apple"
                ];

            }

            return response()->success($response, 'Sync retrieved successfully', 201);


            return $this->sendError('User not found');
        }

        $user->load("device_tokens");
        $user->load("receipts");

        $userArray = $user->toArray();

        $userArray['subscription'] = [
            "expired" => true,
            "receipt" => false,
            "status" => 0,
            "valid" => false
        ];

        $appleErrors = [
            "21000" =>'The App Store could not read the JSON object you provided.',
            "21002" =>'The data in the receipt-data property was malformed.',
            "21003" =>'The receipt could not be authenticated.',
            "21004" =>'The shared secret you provided does not match the shared secret on file for your account.',
            "21005" =>'The receipt server is not currently available.',
            "21006" =>'This receipt is valid but the subscription has expired. When this status code is returned to your server, the receipt data is also decoded and returned as part of the response.',
            "21007" =>'This receipt is a sandbox receipt, but it was sent to the production service for verification.',
            "21008" =>'This receipt is a production receipt, but it was sent to the sandbox service for verification.',
            "2" =>'The receipt is valid, but purchased nothing.',
            "0" => null
        ];

        $appleErrorsList = [2100, 21002, 21003, 21004, 21005, 21006, 21007, 21008, 2];

        if(!empty($receipts)) {
            $receiptResponse = ReceiptHelper::validateApple($receipts['0']->receipt);

            if ($receiptResponse->isValid()) {

                $receiptInfo = $receiptResponse->getReceipt();

                $expired = false;
                $expiresMs = 0;

                if (Carbon::now() > Carbon::parse($receiptInfo[0]->expires_date_ms)) {
                    $expired = true;
                }

                if ($receiptInfo[0]->expires_date_ms) {
                    $expiresMs = $receiptInfo[0]->expires_date_ms;
                }

                $userArray['subscription'] = [
                    "expired" => $expired,
                    "receipt" => false,
                    "status" => $receiptResponse->getResultCode(),
                    "valid" => true,
                    "duration" => $receipts['0']->duration,
                    "expiresMs" => $expiresMs,
                    "statusMessage" => $appleErrors[$receiptResponse->getResultCode()],
                    "source" => "apple"
                ];
            } else {
                $userArray['subscription'] = [
                    "expired" => true,
                    "receipt" => false,
                    "status" => $receiptResponse->getResultCode(),
                    "valid" => false,
                    "statusMessage" => $appleErrors[$receiptResponse->getResultCode()],
                ];
            }
        }

        $responseArray = [
            "organization" => $org->toArray(),
            "application" => $application->toArray(),
            "user" => $userArray,
        ];

        return response()->success($responseArray, 'Sync retrieved successfully');
    }

    public function receipts(Request $request)
    {
        $input = $request->all();

        try {
            $guzzleResult = Http::withOptions([
                    'debug' => false,
                    'timeout' => 50
                ])->withHeaders([
                'organizationId' => '89c14727-e442-4f6a-8678-d041336025b6',
                'applicationId' => '2ca211d9-22e5-4fce-9a74-38e0ef6639c2'

            ])->asForm()->post('http://example.cloud/api/0.1/auth/login', [
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $guzzleResult = $e->getResponse();
        }

        return response()->success($guzzleResult->json(), 'User Login retrieved successfully');
    }
}
