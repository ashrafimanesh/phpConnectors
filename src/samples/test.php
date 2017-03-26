<?php

require_once __DIR__.'/../../vendor/autoload.php';

$connector=\Ashrafi\PhpConnectors\SoapConnector::getInstance(
    'https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL'
    ,'http://ashrafimanesh.ir/proxy/soap.php'
    ,''
    ,\Ashrafi\PhpConnectors\AbstractConnectors::ProxyTypeUrl
);
$amount=1000;
$request = [
    'TermID' => '10560528',
    'TotalAmount' => ($amount),
    'ResNum' => 'a'.uniqid(),
];

var_dump($connector->run('RequestToken',[$request['TermID'], $request['ResNum'], $request['TotalAmount']]));