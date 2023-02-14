<?php

require __DIR__ . '/../api/vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_bde2b9d17081775522d8814b3b0d48bd271fdeff';
$clientSecret = 'Client_Secret_debbf44b9bfa64b5cfa19a263a5d8fb3347dffb1';

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => true
];

if (isset($_POST)) {

    $item_1 = [
        'name' => $_POST["descricao"],
        'amount' => (int) $_POST["quantidade"],
        'value' => (int) $_POST["valor"]
    ];

    $items = [
        $item_1
    ];

    $body = ['items' => $items];

    try {
        $api = new Gerencianet($options);
        $charge = $api->createCharge([], $body);
        if ($charge["code"] == 200) {

            $params = ['id' => $charge["data"]["charge_id"]];
            $customer = [
                'name' => $_POST["nome_cliente"],
                'cpf' => $_POST["cpf"],
                'phone_number' => $_POST["telefone"]
            ];

            //Formatando a data, convertendo do estino brasileiro para americano.
            $data_brasil = DateTime::createFromFormat('d/m/Y', $_POST["vencimento"]);
            
            $bankingBillet = [
                'expire_at' => $data_brasil->format('Y-m-d'),
                'customer' => $customer
            ];
            $payment = ['banking_billet' => $bankingBillet];
            $body = ['payment' => $payment];

            $api = new Gerencianet($options);
            $pay_charge = $api->payCharge($params, $body);
            echo json_encode($pay_charge);
        } else {
            
        }
    } catch (GerencianetException $e) {
        print_r($e->code);
        print_r($e->error);
        print_r($e->errorDescription);
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
} 