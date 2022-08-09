<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiURL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $apiMethod,
    CURLOPT_SSL_VERIFYPEER => false, //Development
    CURLOPT_POSTFIELDS => $apiQuery,

    CURLOPT_HTTPHEADER => array(
        "Apikey: $apiKey",
        "Content-Type: application/json"
    ),
));

$output = curl_exec($curl);
$curlResp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//Check cURL response
if($curlResp != 201 && $curlResp != 409) {
    exit("XX008 (" .$requestID. ")");
    //XX008 (N) cURL error
}

/*
201 Created (X)
400 Bad Request
401 Unauthorized
403 Forbidden
408 Request Timeout
409 Conflict (X)
422 Unprocessable Entity
429 Too Many Requests
500 Internal Server Error
503 Service Unavailable
*/
?>