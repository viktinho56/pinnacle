<?php 
if(isset($_POST['pay']))
{
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $fullname = $_POST['fullname'];
    $title = $_POST['title'];
    $order_id = $_POST['order_id'];
    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => '1',
        'currency' => 'NGN',
        'payment_options' => 'card',
        'redirect_url' => 'http://localhost:8080/pinnacle-erp/views/business/verify-transaction.php?order_id='.$order_id,
        'customer' => [
            'email' => $email,
            'name' => $fullname
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => $title,
            'description' => 'sample'
        ]
    ];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK-cd532c6067fb0aeb3e2869093462bb1a-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data=array();
    $res = json_decode($response);
    if($res->status == 'success')
    {
        $data["message"]= 'success';
        $data["code"]= 1;
        
        $link = $res->data->link;
        $data["link"]= $link;
        
        //header('Location: '.$link);
    }
    else
    {
        $data["message"]= 'We can not process your payment';
        $data["code"]= 0;
       // echo 'We can not process your payment';
    }

    echo  json_encode($data);
}

?>