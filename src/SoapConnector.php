<?php

namespace Ashrafi\PhpConnectors;

class SoapConnector extends AbstractConnectors{

	protected function _getConnectorInstance($url){
        $context = stream_context_create(array('ssl' => array('verify_peer' => false, 'allow_self_signed' => true)));

        return new \SoapClient($url, ['stream_context' => $context,'trace' => true, 'exceptions' => true]);
	}

	protected function _run($method=null,$params=[],$options=[]){
		return call_user_func_array([$this->getConnectorInstance(),$method],$params);
	}
}