<?php

require __DIR__ . '/vendor/autoload.php';

use IZaL\Knet\KnetBilling;

$responseURL = 'http://localhost/knet/response.php';
$successURL = 'http://localhost/knet/success.php';
$errorURL = 'http://localhost/knet/error.php';
$knetAlias = 'dac';
$resourcePath = dirname(__FILE__) . "/resource/";
$amount = 150;
$trackID = 'UNIQUETRACKID';

try {

    $knetGateway = new KnetBilling([
        'alias'        => $knetAlias,
        'resourcePath' => $resourcePath
    ]);

    $knetGateway->setResponseURL($successURL);
    $knetGateway->setErrorURL($errorURL);
    $knetGateway->setAmt($amount);
    $knetGateway->setTrackId($trackID);

    $knetGateway->requestPayment();
    $paymentURL = $knetGateway->getPaymentURL();

    // helper function to redirect
    return header('Location: '.$paymentURL);

} catch (\Exception $e) {

    // to debug error message
     die(var_dump($e->getMessage()));

//    return header('Location: '.$errorURL);
}

