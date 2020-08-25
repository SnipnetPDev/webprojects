<?php
require 'vendor/autoload.php';
require 'vendor/qbills/qbills/src/Qbills.php';


$qb = new Qbills\Qbills("x-api-key");

$json_initiate = '
{
    "action": "InitiateTokenPayment",
    "paymentType": "card",
	"token": "2zk9zyd",
	"amount": "20",
	"memo": "food and drink"
}
';
$json_request = json_decode($json_initiate, true);

// Initiate Card payment
//print_r($qb->cardPayment($json_request['action'], $json_request['paymentType'], $json_request['user'], $json_request['amount'], $json_request['memo'], $json_request['is_recurring']));

// Apply Auth
//print_r($qb->ApplyAuth($json_request['action'], $json_request['AuthType'], $json_request['TxnRef'], $json_request['AuthData']));

// Charge Payment
//print_r($qb->ChargePayment($json_request['action'], $json_request['paymentType'], $json_request['AuthType'], $json_request['TxnRef'], $json_request['CardID'], $json_request['CardPin'], $json_request['is_recurring']));

// Initiate Token Payment
//print_r($qb->InitiateTokenPayment($json_request['action'], $json_request['paymentType'], $json_request['token'], $json_request['amount'], $json_request['memo']));

//print_r($qb->verifyTransaction('197549845039'));
