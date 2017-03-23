<?php

namespace Ashrafi\PhpConnectors;

class SoapConnector extends AbstractConnectors{

	protected function _getConnectorInstance($url){
        $context = stream_context_create(array('ssl' => array('verify_peer' => false, 'allow_self_signed' => true)));

        return new \SoapClient($url, ['stream_context' => $context,'trace' => true, 'exceptions' => true]);
	}

	public function run($method=null,$params=[]){

	}
}