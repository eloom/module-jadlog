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

class ConsultarResponse {

	public $consultarReturn = null;
	public $tracking = null;
	private $error = null;

	public function __construct($consultarReturn) {
		$this->consultarReturn = $consultarReturn;
	}

	public function xmlToObject() {
		$xml = simplexml_load_string($this->consultarReturn);
		$this->tracking = $xml->Jadlog_Tracking_Consultar;

		if (isset($this->tracking->Retorno) && $this->tracking->Retorno == '-1') {
			$this->error = $this->tracking->Mensagem->__toString();
		}
		$this->consultarReturn = null;

		return $this;
	}

	public function hasError() {
		if (!is_null($this->error)) {
			return true;
		}

		return false;
	}

	public function getError() {
		return $this->error;
	}
}
