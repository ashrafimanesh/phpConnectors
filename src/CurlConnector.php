<?php

namespace Ashrafi\PhpConnectors;

class CurlConnector extends AbstractConnectors
{
	protected function _getConnectorInstance($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
	}

	public function run($method=null,$params=[]){
        curl_setopt($this->getConnectorInstance(), CURLOPT_POST, 1);
        curl_setopt($this->getConnectorInstance(), CURLOPT_POSTFIELDS, $params);
        $exec=curl_exec ($this->getConnectorInstance());
        curl_close ($this->getConnectorInstance());
        return $exec;
	}

}