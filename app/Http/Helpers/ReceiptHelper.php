<?php

namespace App\Http\Helpers;

use App\Models\Receipt;
use ReceiptValidator\iTunes\Validator as iTunesValidator;

class ReceiptHelper
{
    public static function validateApple($receiptBase64Data)
    {
        // if (config('app.env') === 'production' || config('app.env') === 'staging') {
            $validatorEndpoint = iTunesValidator::ENDPOINT_PRODUCTION;
        // } else {
        //     $validatorEndpoint = iTunesValidator::ENDPOINT_SANDBOX;
        // }

        $validator = new iTunesValidator($validatorEndpoint);

        try {
            // $response = $validator->setReceiptData($receiptBase64Data)->validate();
            $sharedSecret = config('services.itunes.shared_secret'); // Generated in iTunes Connect's In-App Purchase menu
            $response = $validator->setSharedSecret($sharedSecret)->setReceiptData($receiptBase64Data)->validate(); // use setSharedSecret() if for recurring subscriptions
        } catch (Exception $e) {
            echo 'got error = ' . $e->getMessage() . PHP_EOL;
        }

        return $response;
    }
}
