<?php
################################################################
# This class file was written by PEAK modified by Fresher      #
# for modification, correction, kindly study before editing.   #
# Phone: 09033024846                                           #
# fb.com/oluwatayo.adeyemi                                     #
# oluwatayoadeyemi@yahoo.com                                   #
################################################################
require_once "Api.php";

// class Monnify extends API {
    
//     private $endpointQuery = "https://api.monnify.com/api/v1/merchant/transactions/query";
//     private $authBase = "https://api.monnify.com/api/v1/auth/login";
//     private $reservedBase = "https://api.monnify.com/api/v2/bank-transfer/reserved-accounts";
//     #private $apiKey = "MK_TEST_GVL2AARSNN";
//     #private $secKey = "FSRZ78HUQFTR5CJ7KB7RSYL539MRBV8W";
    
//     public function __construct($db) {
//         $this->db = $db;
//     }

    
//     private function getMonifyKeys() {
//         $result = $this->db->getAllRecords($this->table, "*", " AND option_key = 'monify_settings'");

//         foreach ($result as $i) { 
//             $feedback[$i['option_key']] = $i['option_value'];
//         }
//         $this->responseBody = $this->arrayToObject($feedback);

//         return $this->responseBody;
//     }

//     private function sendRequest($authBase, $authorization) {
//         $curl = curl_init();

// 		curl_setopt_array($curl, 
//             array(
//                 CURLOPT_URL => $authBase,
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => "",
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
// 				CURLOPT_HTTPHEADER => array(
//                     "Content-Type: application/json", $authorization
//                 )
// 			),
// 		);

// 		$response = curl_exec($curl);
// 		return $response;
//     }
    
//     private function getAuth() {
//         $curl = curl_init();
//         $monifyKeys = $this->getMonifyKeys();

		

// 		$response = ;
// 		return $response;
//     }
    
//     public function reserveAccount($uname, $email, $reference) {
//         $body = json_encode([
//                     "accountReference"=>$reference,
//                     "accountName"=>$uname,
//                     "currencyCode"=>"NGN",
//                     "contractCode"=>$this->providusInfo()->contractCode,
//                     "customerEmail"=>$email,
//                     "customerName"=>$uname,
//                     "getAllAvailableBanks"=>232 //035 is for wema...
//                 ]);
                
//         $accessToken = json_decode($this->getAuth());
                
//         $accessToken = $accessToken->responseBody->accessToken;
        
//         $curl = curl_init();
// 		curl_setopt_array($curl, array(CURLOPT_URL => $this->reserve_base,
//         								CURLOPT_RETURNTRANSFER => true,
//         								CURLOPT_ENCODING => "",
//         								CURLOPT_MAXREDIRS => 10,
//         								CURLOPT_TIMEOUT => 0,
//         								CURLOPT_FOLLOWLOCATION => true,
//         								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         								CURLOPT_CUSTOMREQUEST => "POST",
//         								CURLOPT_POSTFIELDS => $body,
//         								CURLOPT_HTTPHEADER => array("Content-Type: application/json",
// 								                                    "Authorization:Bearer ".$accessToken  
// 										                           ),
// 						));
// 		$response = curl_exec($curl);
        		
//         //Get WEMA...
//         $response_item = json_decode($response);
//         $decode_response = $response_item->responseBody->accounts;
//         $wemaAcct = $decode_response["0"]->accountNumber;
        		
//         //Get Sterling...
//         $response_item = json_decode($response);
//         $decode_response = $response_item->responseBody->accounts;
//         $sterlAcct = $decode_response["1"]->accountNumber;
        
//         $result = ["wema" => $wemaAcct, "sterling" => $sterlAcct];
		
// 		return json_encode($result);
		
//     }
    
//     public function receivePay($info) {
//         session_start();
//         //receive the order...
//         print_r($this->creditMemb($info));
//     }
    
//     private function creditMemb($info) {
//         global $connect;
//         $result = json_decode($info, true);
        
//         $hash = hash("SHA512" ,$this->providusInfo()->secKey."|".$result['paymentReference']."|".$result['amountPaid']."|".$result['paidOn']."|".$result['transactionReference']);
        
//         $approvedBy = $result['accountPayments']['0']['accountName']; //to be used on payn
        
//         $loadPay = $connect->dbarray("select * from payn where reference='".$result["paymentReference"]."'");
        
//         if(count($loadPay) > 0) {
//             $response = json_encode(['message' => 'Payment already approved', 'status' => '200']);
//         } else {
//             $data = http_build_query([ "paymentReference" =>$result["paymentReference"] ]);
            
//            $curl = curl_init();

//             curl_setopt_array($curl, array(
//                 CURLOPT_URL => $this->endpointQuery."?".$data,
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => "",
//                 CURLOPT_SSL_VERIFYPEER=> false,
//                 CURLOPT_SSL_VERIFYHOST=> false,
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 60,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "GET",
//                 CURLOPT_POSTFIELDS =>'',
//                 CURLOPT_HTTPHEADER => array(
//                     "Cache-Control: no-cache",
//                     "Content-Type: application/json",
//                     "Authorization:  Basic ".base64_encode($this->providusInfo()->apiKey.':'.$this->providusInfo()->secKey)
//                 ),
//             ));
    
//             $response = curl_exec($curl);
//             $err = curl_error($curl);
//             curl_close($curl);
    
//             if ($err){ return false; }  else { 
//                 //Let's check the response we got from Monnify, needs to be decode...
                
//                 $resp = json_decode($response);
                
//                 if($hash==$result["transactionHash"] && $resp->responseBody->paymentStatus=="PAID") {
//                     #$response = json_encode(['message' => 'Payment was received', 'status' => '100']);
                    
//                     if($result["product"]["type"] == "RESERVED_ACCOUNT") { //if reserved/mapped account
                        
//                         $reference = $result["product"]["reference"]; // Providus account reference
                        
//                         //Search account reference number...
//                         $srchClnt = $connect->dbrow("select * from members where providus_reference='$reference'");
                        
//                         //what's the current balance of the member making payment...
//                         $currBlc = $srchClnt["bal"];
                        
//                         //what's the minimum balance of this user making payment...
//                         $minBal = $srchClnt["minBal"];
                        
//                         $amountPaid = $result["amountPaid"]; // how much was paid to monnify without settlement amount....
//                         #$amountPaid = $result["settlementAmount"]; // how much is monnify releasing to us....
                        
//                         $amount_crdt = $amountPaid-$this->providusInfo()->charge;
                        
//                         $newBlc = $currBlc + $amount_crdt;
//                         $mytime = date("D j F, Y; h:i a");
//                         if($amount_crdt < $minBal) {
//                             $resp = json_encode(["txref"=>$result["paymentReference"], "apprBy"=>"Monnify System", "descr"=>"Minimum wallet funding issue"]);
//                             $connect->dbcountchanges("insert into payn (email, telno, amount, bfrAmnt, aftAmnt, timed, status, memo, method, reference) values ('".$srchClnt["email"]."', '".$srchClnt["phoneno"]."', '$amount_crdt', '0','0', '$mytime', '0', '$resp', '$approvedBy', '".$result["paymentReference"]."')");
//                             $response = json_encode(['message' => 'Payment queued for admin approval', 'status' => '200']);
//                         } else {
//                             $resp = json_encode(["txref"=>$result["paymentReference"], "apprBy"=>"Monnify System"]);
//                             $approvedBy = 'Providus Bank';
//                             if(updatebal($newBlc, $srchClnt['id'])) {
//                                 $connect->dbcountchanges("insert into payn (email, telno, amount, bfrAmnt, aftAmnt, timed, status, memo, method, reference) values ('".$srchClnt["email"]."', '".$srchClnt["phoneno"]."', '$amount_crdt', '$currBlc','$newBlc', '$mytime', '1', '$resp', '$approvedBy', '".$result["paymentReference"]."')");
//                                 $response = json_encode(['message' => 'Payment approved successfully', 'status' => '200']);
//                             }
//                         }
//                     }
//                 } elseif ($resp->responseBody->paymentStatus =='PENDING') { //pending transaction
//                     $response = json_encode(['message' => 'Pending payment', 'status' => '100']);
//                 } else {
//                     $response = json_encode(['message' => 'Unknown error.', 'status' => '300']);
//                 }
//             }
//         }
           
//         return $response;
        
//     }
    
// }

// $test = new monnify();
