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
     * @param $connectorClass
     * @param $url
     * @param string $proxyDomain
     * @param string $proxyPort
     * @param string $proxyType
     * @return AbstractConnectors
     */
    public static function create($connectorClass,$url, $proxyDomain='', $proxyPort='', $proxyType=''){
        $connector = AbstractConnectors::getConnector($url, $proxyDomain, $proxyPort, $proxyType, $connectorClass);
        return $connector;
    }

    public static function run(AbstractConnectors $connector,$method=null,$params=[]){
        return $connector->run($method,$params);
    }
}