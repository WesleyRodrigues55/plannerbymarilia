<?php

namespace App\Controllers;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentMethod extends BaseController
{

    public function payment() {
        // Step 2: Set production or sandbox access token
        MercadoPagoConfig::setAccessToken(env('TOKEN_API_MERCADO_PAGO_PRODUCTION'));

        // Step 3: Initialize the API client
        $client = new PaymentClient();

        try {
            // Step 4: Create the request array
            $request = [
                "transaction_amount" => 0.02,
                // "token" => env('TOKEN_API_MERCADO_PAGO_DEVELOPMENT'),
                "description" => "description",
                "installments" => 1,
                "payment_method_id" => "pix",
                "payer" => [
                    "identification" => [
                        "type" => "CPF",
                        "number" => "49106275885"
                    ],
                    "last_name" => "Rodrigues",
                    "first_name" => "Wesley",
                    "email" => "user@test.com",
                ]
            ];

            // Step 5: Make the request
            $payment = $client->create($request);
            echo "Transaction Amount: " . $payment->transaction_amount . "<br>";
            echo "QR Code: <br><img src='data:image/jpeg;base64,". $payment->point_of_interaction->transaction_data->qr_code_base64 ."' style='width: 200px'/><br>";
            echo "Link Transation: <a href='" . $payment->point_of_interaction->transaction_data->ticket_url . "' target='blank'>Pagar com Pix</a><br>";
            echo "Method: " . $payment->payment_method_id . "<br>";
            echo "ID: " . $payment->id . "<br>";
            echo "Status: " . $payment->status . "<br>";
            echo "Email: " . $payment->payer->email . "<br>";
            echo "First Name: " . $payment->payer->first_name . "<br>";
            echo "Last Name: " . $payment->payer->last_name . "<br>";
            echo "Identification Type: " . $payment->payer->identification->type . "<br>";
            echo "Number Identification: " . $payment->payer->identification->number . "<br>";
            echo "<pre>";
            var_dump($payment);
            // echo $payment->id;

        // Step 6: Handle exceptions
        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "<br>";
            echo "Content: " . $e->getApiResponse()->getContent() . "<br>";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatusPayment() {
        $accessToken = env('TOKEN_API_MERCADO_PAGO_PRODUCTION'); 
        
        $url = "https://api.mercadopago.com/v1/payments/66665690953";
        
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer $accessToken\r\n",
            ],
        ];
        
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        
        if ($response === false) {
            echo 'Erro na solicitação.';
        } else {
            $responseData = json_decode($response, true);
            echo "Satus: " . $responseData['status'];
            echo "<br><br>";
            echo $response;
        }
        
      
    }

}