<?php

namespace Ashrafi\PhpConnectors;

abstract class AbstractConnectors{
	const CurlConnector="Curl";
	const SoapConnector="Soap";
	const ProxyTypeUrl='urlProxy';
	const ProxyTypeHttp='proxy';

	protected $url,$connectorInstance,$type,$proxyDomain="",$proxyPort=3128,$proxyType=self::ProxyTypeHttp,$params=[];

	protected $real_url=null;

	/**
	 * @param $url
	 * @param $proxyDomain
	 * @param $proxyPort
	 * @param $proxyType
	 * @param $connectorClass
	 * @return AbstractConnectors
	 * @throws \Exception
	 */
	public static function getConnector($url, $proxyDomain, $proxyPort, $proxyType, $connectorClass)
	{
		if (!class_exists($connectorClass)) {
			throw new \Exception("method does not exist related run method", 1);
		}
		$real_url = $url;

		if ($proxyDomain && $proxyType == self::ProxyTypeUrl) {
			$url = $proxyDomain . ($proxyPort ? $proxyPort : '');
			$connectorClass = CurlConnector::class;
		}

		$connector = new $connectorClass($url, $proxyDomain, $proxyPort, $proxyType);
		$connector->setRealUrl($real_url);

		$connector->setConnectorInstance($connector->_getConnectorInstance($url));
		return $connector;
	}

	protected abstract function _getConnectorInstance($url);

	protected abstract function _run($method=null,$params=[]);

	/**
	 * @param $url
	 * @param null $proxyDomain
	 * @param null $proxyPort
	 * @param string $proxyType
	 * @return AbstractConnectors
	 * @throws \Exception
	 */
	public final static function getInstance($url,$proxyDomain=null,$proxyPort=null,$proxyType=self::ProxyTypeHttp){
		$connectorClass=get_called_class();
		$connector = self::getConnector($url, $proxyDomain, $proxyPort, $proxyType, $connectorClass);
		return $connector;
	}

	/**
	 * @param null $method
	 * @param array $params
	 * @return mixed
     */
	public function run($method=null,$params=[]){
		$proxyDomain=$this->getProxyDomain();
		$proxyType=$this->getProxyType();

		if($proxyDomain && $proxyType==self::ProxyTypeUrl){
			$_params['real_url']=$this->real_url;
			$_params['request']=$params;
			$_params['method']=$method;
			$params=$_params;
		}

		$result=$this->_run($method,$params);
		if($proxyDomain && $proxyType==self::ProxyTypeUrl){
			$result=json_decode($result);
		}
		return $result;
	}

	protected final function __construct($url,$proxyDomain=null,$proxyPort=3128,$proxyType=self::ProxyTypeHttp){

		$this->setUrl($url)->setProxyDomain($proxyDomain)->setProxyPort($proxyPort)->setProxyType($proxyType);
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
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 * @return AbstractConnectors
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProxyType()
	{
		return $this->proxyType;
	}

	/**
	 * @param string $proxyType
	 * @return AbstractConnectors
	 */
	public function setProxyType($proxyType)
	{
		$this->proxyType = $proxyType;
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

	/**
	 * @return null
	 */
	public function getRealUrl()
	{
		return $this->real_url;
	}

	/**
	 * @param null $real_url
	 * @return AbstractConnectors
	 */
	public function setRealUrl($real_url)
	{
		$this->real_url = $real_url;
		return $this;
	}


}