<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 3/26/17
 * Time: 10:31 AM
 */

namespace Ashrafi\PhpConnectors;


class ConnectorFactory
{
    /**
     * @param $connectorClass AbstractConnector class name
     * @param $url
     * @param $proxyDomain
     * @param $proxyPort
     * @param $proxyType
     * @return AbstractConnectors
     * @throws \Exception
     */
    public static function create($connectorClass,$url, $proxyDomain, $proxyPort, $proxyType){
        $connector = AbstractConnectors::getConnector($url, $proxyDomain, $proxyPort, $proxyType, $connectorClass);
        return $connector;
    }

    public static function run(AbstractConnectors $connector,$method=null,$params=[]){
        return $connector->run($method,$params);
    }
}