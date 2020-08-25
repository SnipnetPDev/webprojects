# qbills-php

# API Wrapper for Qbills Payment HTTP/1.1

APIs to accept payments on your website seamlessly, without compromise. Qbills was made for businesses like you to build amazing applications that accept online payments using a Nigerian Credit / Debit card.

To Learn more, visit [https://qbills.com.ng/docs/index](https://qbills.com.ng/docs/index).

## Getting Started
You need your x-api-key to authenticate against the API, use the following credentials below for a demo account.

x-api-key:
ZFozUHc5YWpKLzVGQkVNYjhoTGRyUT09OjrF1ps+uN7Er3HxusbYMkce

Endpoint:
https://demo.qbills.com.ng/API/v1/payment/

## Installation

simply run the command `composer require qbills/qbills` in your project.

## Example



Initiate Class:
```
$qb = new Qbills\Qbills("x-api-key", "https://demo.api.gladepay.com");

```

### For Card Payments:

```

$json_initiate = '
{
    "action": "InitiatePayment",
    "paymentType": "card",
    "user": {
        "mobile": "08023775657"
    },
	"amount": "2000",
	"memo": "food and drink",
    "is_recurring": "true"
}
';


$json_request = json_decode($json_initiate, true);

//Initiate a Card Payment Transaction
$qb->cardPayment($json_request['action'], $json_request['paymentType'], $json_request['user'], $json_request['amount'], $json_request['memo'], $json_request['is_recurring']);


## OTP or Qbills account PIN will be required, You can pass the OTP or PIN along with a transaction reference returned by the last call

## USING (OTP)
$json_initiate = '
{
  "action": "ApplyAuth",
  "AuthType": "OTP",
  "TxnRef": "404918898678",
	"AuthData": "206243"
}
';

## USING (PIN)
$json_initiate = '
{
  "action": "ApplyAuth",
  "AuthType": "PIN",
  "TxnRef": "404918898678",
	"AuthData": "2062"
}
';

$json_request = json_decode($json_initiate, true);

// Apply Authentication
$qb->ApplyAuth($json_request['action'], $json_request['AuthType'], $json_request['TxnRef'], $json_request['AuthData']);


## Finally, call the charge request URL with CardID and CardPin returned by the last call to complete the transaction.
$json_initiate = '
{
  "action": "ChargePayment",
  "paymentType": "card",
	"AuthType": "CardPin",
  "TxnRef": "404918898678",
	"CardID": "52",
	"CardPin": "5656",
	"is_recurring": "true"
}
';

$json_request = json_decode($json_initiate, true);

$qb->ChargePayment($json_request['action'], $json_request['paymentType'], $json_request['AuthType'], $json_request['TxnRef'], $json_request['CardID'], $json_request['CardPin'], $json_request['is_recurring']);


// After all is done, verify to confirm final status of the transaction.
$qb->verifyTransaction('197549845039');

```

If you will be charging with a previosly saved token:

```
$json_initiate = '
{
  "action": "InitiateTokenPayment",
  "paymentType": "card",
	"token": "Zxu45hDq0",
	"amount": "2000",
	"memo": "food and drink"
}
';

$json_request = json_decode($json_initiate, true);

$qb->InitiateTokenPayment($json_request['action'], $json_request['paymentType'], $json_request['token'], $json_request['amount'], $json_request['memo']);

```

## Return Values
All methods return an array.
