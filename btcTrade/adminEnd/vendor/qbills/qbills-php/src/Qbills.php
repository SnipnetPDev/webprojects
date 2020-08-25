<?php

namespace Qbills;

class Qbills{

    private $client;
    public function __construct($x_api_key){
        $headers = ['x-api-key' => $x_api_key, 'Accept' => 'application/json'];
        $this->client = new \GuzzleHttp\Client(['headers' => $headers]);
    }

    public function cardPayment($action, $paymentType, $user, $amount, $memo, $is_recurring){
		$request = [ 'action' => $action, 'paymentType' => $paymentType, 'user' => $user, 'amount' => $amount, 'memo' => $memo, 'is_recurring' => $is_recurring];
        $InitResponse = json_decode($this->InitiatePayment($request), true);
            if($InitResponse['Status'] == 202){
				
				if($InitResponse['Data']['TxnStatus'] == "OTP"){
                            return json_encode([
                                "status" => 202,
                                "txnRef" => $InitResponse['TxnRef'],
                                "message" => $InitResponse['Data']['Message'],
                                "auth" => "OTP"
                            ]);
			
				}elseif($InitResponse['Data']['TxnStatus'] == "PIN"){
					return json_encode([
                                "status" => 202,
                                "txnRef" => $InitResponse['TxnRef'],
								"message" => $InitResponse['Data']['Message'],
                                "auth" => "PIN"
                            ]);
				}

            }else{
                return json_encode([
                    "status" => 500,
                    "message" => $InitResponse['Message']
                ]);
            }
       
    
    }


    private function InitiatePayment($request)
    {
		$data = [
    "action" => $request['action'],
    "paymentType" => $request['paymentType'],
    "user" => $request['user'],
	"amount" => $request['amount'],
	"memo" => $request['memo'],
    "is_recurring" => $request['is_recurring']
        ];
        return $this->callAPI('PUT',  '/', $data);
    }

    public function ApplyAuth($action, $AuthType, $TxnRef, $AuthData)
    {
	$data = [
    "action" => $action,
    "AuthType" => $AuthType,
    "TxnRef" => $TxnRef,
	"AuthData" => $AuthData
        ];
        return $this->callAPI('PATCH',  '/', $data);
    }

    public function ChargePayment($action, $paymentType, $AuthType, $TxnRef, $CardID, $CardPin, $is_recurring)
    {
	$data = [
	"action" => $action,
    "paymentType" => $paymentType,
	"AuthType" => $AuthType,
    "TxnRef" => $TxnRef,
	"CardID" => $CardID,
	"CardPin" => $CardPin,
	"is_recurring" => $is_recurring
	];
        return $this->callAPI('PATCH',  '/', $data);
    }

    public function InitiateTokenPayment($action, $paymentType, $token, $amount, $memo)
	{
	$data = [
	"action" => $action,
    "paymentType" => $paymentType,
	"token" => $token,
	"amount" => $amount,
	"memo" => $memo
	];
        return $this->callAPI('PUT', '/', $data);
    }

    public function verifyTransaction($txnRef)
    {
	return $this->callAPI("GET",  "/VerifyPayment/$txnRef/", '');
    }

    private function callAPI($method, $api_method, $data){
		$base_url = 'https://qbills.com.ng/API/v1/payment';
		try {
        $response = $this->client->request($method, $base_url.$api_method, ['body' => json_encode($data)]);
        return $response->getBody()->getContents();
		} catch (\GuzzleHttp\Exception\ConnectException $e) {
   $errdata = json_encode([
                    "Status" => 500,
                    "Message" => "Service Not Avaliable."
                ]);
		return $errdata;
} catch (\GuzzleHttp\Exception\ClientException $e) {
	$response = $e->getResponse();
    $responseBodyAsString = $response->getBody()->getContents();
   return $responseBodyAsString;
}
    }
}
