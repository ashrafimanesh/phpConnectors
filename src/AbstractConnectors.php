<?php

namespace Ashrafi\PhpConnectors;

abstract class AbstractConnectors{
	const CurlConnector="Curl";
	const SoapConnector="Soap";

	protected $url,$connectorInstance,$type,$proxyDomain="",$proxyPort=3280,$params=[];

	protected abstract function _getConnectorInstance($url);

	public abstract function run($method=null,$params=[]);

	public static function getInstance($url,$proxyDomain=null,$proxyPort=null){
		$connectorClass=get_called_class();
		if(!class_exists($connectorClass)){
			throw new \Exception("method does not exist related run method", 1);
		}
		$connector=new $connectorClass($url,$proxyDomain,$proxyPort);
		$connector->setConnectorInstance($connector->_getConnectorInstance($url));
		return $connector;
	}

	protected final function __construct($url,$proxyDomain=null,$proxyPort=3280){

		$this->setProxyDomain($proxyDomain);
		$this->setProxyPort($proxyPort);
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProxyDomain()
	{
		return $this->proxyDomain;
	}

	/**
	 * @param string $proxyDomain
	 */
	public function setProxyDomain($proxyDomain)
	{
		$this->proxyDomain = $proxyDomain;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getProxyPort()
	{
		return $this->proxyPort;
	}

	/**
	 * @param int $proxyPort
	 */
	public function setProxyPort($proxyPort)
	{
		$this->proxyPort = $proxyPort;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * @param array $params
	 */
	public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}


	/**
	 * @param mixed $connectorInstance
	 */
	public function setConnectorInstance($connectorInstance)
	{
		$this->connectorInstance = $connectorInstance;
		return $this;
	}

	public function getConnectorInstance(){
		return $this->connectorInstance;
	}

}