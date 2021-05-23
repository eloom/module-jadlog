<?php
/**
* 
* Frete com Jadlog para Magento 2
* 
* @category     Eloom
* @package      Modulo Frete com Jadlog
* @copyright    Copyright (c) 2020 eloom (https://www.eloom.com.br)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\Jadlog\Lib\GetModal;

class Api {

	const VERSION = '1.0.0';

	private $clientKey;
	private $clientToken;

	function __construct() {
		$i = func_num_args();

		if ($i != 2) {
			throw new Exception("Invalid arguments. Use GMKEY and GMTOKEN.");
		}

		$this->clientKey = func_get_arg(0);
		$this->clientToken = func_get_arg(1);
	}

	public function get($request, $params = null, $authenticate = true) {
		if (is_string($request)) {
			$request = array(
				'uri' => $request,
				'params' => $params,
				'authenticate' => $authenticate
			);
		}
		$request['params'] = isset($request['params']) && is_array($request['params']) ? $request['params'] : [];

		if (!isset($request['headers'])) {
			$request['headers'] = $this->getHeaders();
		}

		return \Eloom\Jadlog\Lib\GetModal\RestClient::get($request);
	}

	private function getHeaders() {
		return ['GMKEY' => $this->clientKey, 'GMTOKEN' => $this->clientToken];
	}

	public function post($request, $data = null, $params = null) {
		if (is_string($request)) {
			$request = [
				"uri" => $request,
				"data" => $data,
				"params" => $params
			];
		}
		$request["params"] = isset($request["params"]) && is_array($request["params"]) ? $request["params"] : [];
		if (!isset($request['headers'])) {
			$request['headers'] = $this->getHeaders();
		}

		return \Eloom\Jadlog\Lib\GetModal\RestClient::post($request);
	}

	public function put($request, $data = null, $params = null) {
		if (is_string($request)) {
			$request = [
				"uri" => $request,
				"data" => $data,
				"params" => $params
			];
		}

		$request["params"] = isset($request["params"]) && is_array($request["params"]) ? $request["params"] : [];

		if (!isset($request['headers'])) {
			$request['headers'] = $this->getHeaders();
		}

		return \Eloom\Jadlog\Lib\GetModal\RestClient::put($request);
	}
}