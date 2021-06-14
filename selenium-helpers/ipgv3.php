<?php

// session_start();
// $_SESSION['checkout_url'] = getPaymentUrl();

if(isset($_GET['status'])) {
    echo $_GET['status'];
}

function getPaymentUrl() {

    $hmacSecret = "fe42a0be5a64180502c4314e34c95402f51b27405bf0a472f4d3dfd13c14d3e9";
    
    $requestData = [
        "merchant_id" => "FF04808",
        "amount" => $_GET['status'] == 'SUCCESS' ? "102.00" : "99999999999.00",
        "source" => "Selenium-test",
        "type" => "ONE_TIME",
        "order_id" => "sel-" . date("ymdHis"),
        "currency" => "LKR",
        "response_url" => "http://localhost/res",
        "return_url" => "http://localhost/res",
        "first_name" => "first",
        "last_name" => "last",
        "email" => "a@a.com",
        "phone" => "713100317",
        "logo" => '',
        "description" => "description selenium test",
    ];

    $dataString = base64_encode(json_encode($requestData));
    $signature = 'hmac ' . hash_hmac('sha256', $dataString, $hmacSecret);
    
    // Call API and get payment session URL
    $ch = curl_init();
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://test-gateway.directpay.lk/api/v3/create-session",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => base64_encode(json_encode($requestData)),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: $signature",
        ],
    ));
    
    $response = curl_exec($ch);
    if (curl_error($ch)) {
//             printToLog('Unable to fetch payment link: ' . curl_errno($ch) . ' - ' . curl_error($ch));
    }
    curl_close($ch);
    
    $getSession = json_decode($response);
    
    // echo json_encode($getSession);
    
    $paymentRedirect = "http://localhost:4444/wd/hub";
    
    if ($getSession) {
        $paymentRedirect = $getSession->data->link;
    }
    
    return $paymentRedirect;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script>
        window.location.href = "<?php echo isset($_GET['status']) ? getPaymentUrl() : ''; ?>";
    </script>

</body>

</html>