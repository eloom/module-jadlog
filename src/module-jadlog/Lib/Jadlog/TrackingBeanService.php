<?php
/**
* 
* Frete com Jadlog para Magento 2
* 
* @category     Ã©loom
* @package      Modulo Frete com Jadlog
* @copyright    Copyright (c) 2021 eloom (https://eloom.tech)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\Jadlog\Lib\Jadlog;

class TrackingBeanService extends \SoapClient {

	private static $classmap = array(
		'consultar' => '\Eloom\Jadlog\Lib\Jadlog\Consultar',
		'consultarResponse' => '\Eloom\Jadlog\Lib\Jadlog\ConsultarResponse',
		'consultarPedido' => '\Eloom\Jadlog\Lib\Jadlog\ConsultarPedido',
		'consultarPedidoResponse' => '\Eloom\Jadlog\Lib\Jadlog\ConsultarPedidoResponse');

	public function __construct(array $options = array(), $wsdl = 'http://www.jadlog.com.br:8080/JadlogEdiWs/services/TrackingBean?wsdl') {
		foreach (self::$classmap as $key => $value) {
			if (!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}

		parent::__construct($wsdl, $options);
	}

	public function consultar(\Eloom\Jadlog\Lib\Jadlog\Consultar $parameters) {
		return $this->__soapCall('consultar', array($parameters));
	}

	public function consultarPedido(\Eloom\Jadlog\Lib\Jadlog\ConsultarPedido $parameters) {
		return $this->__soapCall('consultarPedido', array($parameters));
	}

}