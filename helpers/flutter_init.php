<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//require("../vendor/flutterwavedev/flutterwave-v3/library/AccountPayment.php");
require("../vendor/flutterwavedev/flutterwave-v3/library/CardPayment.php");
use Flutterwave\Card;
    $array = array(
        "PBFPubKey" => "****YOUR**PUBLIC**KEY****",
        "cardno" =>"5438898014560229",
        "cvv" => "890",
        "expirymonth"=> "09",
        "expiryyear"=> "19",
        "currency"=> "NGN",
        "country"=> "NG",
        "amount"=> "2000",
        "pin"=>"3310",
        //"payment_plan"=> "980", //use this parameter only when the payment is a subscription, specify the payment plan id
        "email"=> "eze@gmail.com",
        "phonenumber"=> "0902620185",
        "firstname"=> "temi",
        "lastname"=> "desola",
        "IP"=> "355426087298442",
        "txRef"=>"MC-".time(),// your unique merchant reference
        "meta"=>["metaname"=> "flightID", "metavalue"=>"123949494DC"],
        "redirect_url"=>"https://rave-webhook.herokuapp.com/receivepayment",
        "device_fingerprint"=> "69e6b7f0b72037aa8428b70fbe03986c"
    );
$card = new Card();
$result = $card->cardCharge($array);
print_r($result);
?>