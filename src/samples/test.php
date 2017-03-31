<?php

require_once __DIR__.'/../../vendor/autoload.php';
$wsdl_url='https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL';
$connector=\Ashrafi\PhpConnectors\ConnectorFactory::create(\Ashrafi\PhpConnectors\SoapConnector::class
    ,$wsdl_url
    ,'http://ashrafimanesh.ir/proxy/soap.php'
    ,''
    ,\Ashrafi\PhpConnectors\AbstractConnectors::ProxyTypeUrl);
$amount=1000;
$request = [
    'TermID' => '12344',
    'TotalAmount' => ($amount),
    'ResNum' => 'a'.uniqid(),
];

var_dump($connector->run('RequestToken',[$request['TermID'], $request['ResNum'], $request['TotalAmount']]));