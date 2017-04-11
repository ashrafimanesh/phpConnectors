<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 3/31/17
 * Time: 11:09 AM
 */

namespace Ashrafi\PhpConnectors;

require_once __DIR__.'/Libs/nusoap.php';

class NusoapConnector extends AbstractConnectors
{
    protected function _getConnectorInstance($url)
    {

        return new \nusoap_client($url);
    }

    protected function _run($method = null, $params = [])
    {
        return call_user_func_array([$this->getConnectorInstance(),'call'],array_merge([$method],$params));
    }

}