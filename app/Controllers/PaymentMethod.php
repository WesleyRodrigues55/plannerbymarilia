<?php

namespace App\Controllers;

use App\Controllers\BuyCart;
use App\Controllers\User;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentMethod extends BaseController
{
    public function aguardandoPagamento($id_detalhes_pedido, $id_carrinho) {
        if (!session()->has('usuario')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $buy_cart = new BuyCart();
        $user = new User();

        $valor_total = $buy_cart->getValorTotalCompra($id_carrinho);
        $id_transaction = $buy_cart->getIdTransactionByIdDetahesPedido($id_detalhes_pedido);

        if (!$id_transaction) {
            $get_data_pessoa = $user->getPessoa($user->idUser());
            $payment = $this->payment((double) $valor_total, $get_data_pessoa[0]);
            $buy_cart->updatedDetalhesPedidoDadosPagamento($id_detalhes_pedido, $payment);
            $query = $buy_cart->getDetalhesPedidoById($id_detalhes_pedido);

            $data = [
                'id_transaction' => $query[0]['ID_TRANSACTION'],
                'status' => $query[0]['STATUS_PEDIDO'],
                'qrcode' => $query[0]['QRCODE'],
                'qrcode64' => $query[0]['QRCODE64'],
                'valor_total' => $valor_total,
                'id_detalhes_pedido' => $id_detalhes_pedido
            ];
        } else {
            $query = $buy_cart->getDetalhesPedidoById($id_detalhes_pedido);

            $data = [
                'id_transaction' => $query[0]['ID_TRANSACTION'],
                'status' => $query[0]['STATUS_PEDIDO'],
                'qrcode' => $query[0]['QRCODE'],
                'qrcode64' => $query[0]['QRCODE64'],
                'valor_total' => $valor_total,
                'id_detalhes_pedido' => $id_detalhes_pedido
            ];
        }

        return view('comprando/aguardando-pagamento', $data);
        
    }

    public function compraAprovada() {
        if (session()->has('usuario')) {
            return view('comprando/success-pagamento');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function payment($valor_total, $get_data_pessoa) {
        MercadoPagoConfig::setAccessToken(env('TOKEN_API_MERCADO_PAGO_PRODUCTION'));

        $client = new PaymentClient();

        try {
            if ($get_data_pessoa['TIPO_PESSOA'] == "FISICA") {
                $type_identificator = "CPF";
                $number_identificator = $get_data_pessoa['CPF'];
            } else {
                $type_identificator = "CNPJ";
                $number_identificator = $get_data_pessoa['CNPJ'];
            }

            $request = [
                "transaction_amount" => $valor_total,
                "token" => env('TOKEN_API_MERCADO_PAGO_DEVELOPMENT'),
                "description" => "Compra na plataforma Planner By Marília!",
                "installments" => 1,
                "payment_method_id" => "pix",
                "payer" => [
                    "identification" => [
                        "type" => $type_identificator,
                        "number" => $number_identificator
                    ],
                    "first_name" => $get_data_pessoa['NOME'],
                    "email" => $get_data_pessoa['EMAIL'],
                ]
            ];

            $payment = $client->create($request);
    
            $data = [
                'id_transaction' => $payment->id,
                'status' => $payment->status,
                'qrcode' => $payment->point_of_interaction->transaction_data->qr_code,
                'qrcode64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
            ];

            return $data;

        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "<br>";
            echo "Content: " . $e->getApiResponse()->getContent() . "<br>";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatusPayment($id_payment, $id_detalhes_pedido) {
        $buy_cart = new BuyCart();

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
            echo $responseData['status'];
            if ($responseData['status'] == "approved") {
                $buy_cart->alteraStatusDetalhePedido($id_detalhes_pedido);
                $buy_cart->alteraStatusCarrinho($id_detalhes_pedido);
            }
            // echo "<br><br>";
            // echo $response;
        }
    }

}