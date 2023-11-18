<?php

namespace App\Controllers;

use App\Controllers\BuyCart;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentMethod extends BaseController
{

    public function viewPayment($id_detalhes_pedido, $id_carrinho) {
        $data = [
            'id_detalhes_pedido' => $id_detalhes_pedido,
            'id_carrinho' => $id_carrinho
        ];
        return view('comprando/payment', $data);
    }

    public function aguardandoPagamento($id_detalhes_pedido, $id_carrinho) {
        $buy_cart = new BuyCart();

        $valor_total = $buy_cart->getValorTotalCompra($id_carrinho);
        // $nome_usuario = session()->get('email');
        // $email_usuario = session()->get('email');

        if (!session()->has('id_transaction')) {
            $payment = $this->payment((double) $valor_total);

            session()->set([
                'id_transaction' => $payment['id_transaction'],
                'status' => $payment['status'],
                'qrcode' => $payment['qrcode'],
            ]); 

            $data = [
                'id_transaction' => session()->get('id_transaction'),
                'status' => session()->get('status'),
                'qrcode' => session()->get('qrcode'),
                'valor_total' => $valor_total,
            ];
        } else {
            $data = [
                'id_transaction' => session()->get('id_transaction'),
                'status' => session()->get('status'),
                'qrcode' => session()->get('qrcode'),
                'valor_total' => $valor_total,
            ];
        }

        return view('comprando/aguardando-pagamento', $data);
    }

    public function  loadSuccessPayment() {
        return view('success-pagamento');
    }

    public function payment($valor_total) {
        // Step 2: Set production or sandbox access token
        MercadoPagoConfig::setAccessToken(env('TOKEN_API_MERCADO_PAGO_PRODUCTION'));

        // Step 3: Initialize the API client
        $client = new PaymentClient();

        try {
            // Step 4: Create the request array
            $request = [
                "transaction_amount" => 0.01,
                "token" => env('TOKEN_API_MERCADO_PAGO_DEVELOPMENT'),
                "description" => "Compra na plataforma Planner By Marília!",
                "installments" => 1,
                "payment_method_id" => "pix",
                "payer" => [
                    "identification" => [
                        "type" => "CPF",
                        "number" => "49106275885"
                    ],
                    "first_name" => "Wesley",
                    "email" => "wesley@gmail.com",
                ]
            ];

            $payment = $client->create($request);
    
            $data = [
                'id_transaction' => $payment->id,
                'status' => $payment->status,
                'qrcode' => $payment->point_of_interaction->transaction_data->qr_code_base64,
            ];

            return $data;

        // Step 6: Handle exceptions
        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "<br>";
            echo "Content: " . $e->getApiResponse()->getContent() . "<br>";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatusPayment($id_payment) {
        $accessToken = env('TOKEN_API_MERCADO_PAGO_PRODUCTION'); 
        
        $url = "https://api.mercadopago.com/v1/payments/$id_payment";
        
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
            // echo "STATUS: " . $responseData['status'];
            // echo "<br><br>";
            // echo $response;
            echo $responseData['status'];

            if ($responseData['status'] == "approved") {
                $data = [
                    'id_transaction',
                    'status',
                    'qrcode'
                ];
                session()->remove($data);
            }
        }
        
      
    }

}