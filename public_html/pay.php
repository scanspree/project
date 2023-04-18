<?php

require('config.php');
require('razorpay/razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$totalamount=$_POST['totalamount'];
$orderData = [
    'amount'          => $totalamount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];


$_SESSION['razorpay_order_id'] = $razorpayOrderId;


$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Scan Spree",
    "description"       => "",
    "image"             => "Images/Logo2.svg",
    "prefill"           => [
    "id"                => $_POST['userid'],  
    "name"              => $_POST['username'],
    "email"             => $_POST['email'],
    "contact"           => $_POST['contact'],
    ],
    "theme"             => [
    "color"             => "#FFC220"
    ],
    "order_id"          => $razorpayOrderId,
    "tagid"             => $_POST['tagid'],
    "cartid"            => $_POST['cart_id'],
    "totamount"         =>$totalamount ,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("razorpay/checkout/{$checkout}.php");
?>
