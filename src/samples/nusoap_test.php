<?php
require_once __DIR__.'/../../vendor/autoload.php';
$wsdl_url='https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl';
$connector=\Ashrafi\PhpConnectors\ConnectorFactory::create(\Ashrafi\PhpConnectors\NusoapConnector::class
    ,$wsdl_url
    ,'http://ashrafimanesh.ir/proxy/nusoap.php'
    ,''
    ,\Ashrafi\PhpConnectors\AbstractConnectors::ProxyTypeUrl
);

$amount=1000;
$parameters = array(
    'terminalId' => '',
    'userName' => '',
    'userPassword' => '',
    'orderId' => 12,
    'amount' => $amount, // Price / Rial
    'localDate' => date('Ymd'),
    'localTime' => date('Gis'),
    'additionalData' => '',
    'callBackUrl' => 'http://google.com',
    'payerId' => 0);
$namespace = 'http://interfaces.core.sw.bps.com/';

echo '<pre>';
var_dump($connector->run('bpPayRequest',[$parameters,$namespace]));
