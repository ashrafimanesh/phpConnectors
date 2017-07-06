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

	protected function _run($method=null,$params=[],$options=[]){
        if(sizeof($options)){
            foreach($options as $option=>$value){
                curl_setopt($this->getConnectorInstance(), $option, $value);
            }
        }
        else{
            curl_setopt($this->getConnectorInstance(), CURLOPT_POST, 1);
            curl_setopt($this->getConnectorInstance(), CURLOPT_POSTFIELDS, http_build_query($params));
        }
        $exec=curl_exec ($this->getConnectorInstance());
        curl_close ($this->getConnectorInstance());
        return $exec;
	}

}