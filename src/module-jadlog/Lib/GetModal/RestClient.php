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

class RestClient {

	const API_BASE_URL = 'http://api.getmodal.com.br/v1/';

	public static function get($request) {
		$request["method"] = "GET";

		return self::exec($request);
	}

	private static function exec($request) {
		$connect = self::build_request($request);

		$api_result = curl_exec($connect);
		$api_http_code = curl_getinfo($connect, CURLINFO_HTTP_CODE);

		if ($api_result === FALSE) {
			throw new Exception(curl_error($connect));
		}

		$response = array(
			'status' => $api_http_code,
			'response' => json_decode($api_result, true)
		);

		if ($response['status'] >= 400) {
			$message = null;
			$code = $response['response']['code'];
			if (isset($response['response']['validation'])) {
				foreach ($response['response']['validation'] as $key => $value) {
					$response['errors'][] = sprintf("%s %s", ucfirst($key), $value);
				}
			}
		}
		curl_close($connect);

		return $response;
	}

	private static function build_request($request) {
		if (!extension_loaded("curl")) {
			throw new Exception("cURL extension not found. You need to enable cURL in your php.ini or another configuration you have.");
		}

		if (!isset($request["method"])) {
			throw new Exception("No HTTP METHOD specified");
		}

		if (!isset($request["uri"])) {
			throw new Exception("No URI specified");
		}

		$headers = array("accept: application/json");
		$json_content = true;
		$form_content = false;
		$default_content_type = true;

		if (isset($request["headers"]) && is_array($request["headers"])) {
			foreach ($request["headers"] as $h => $v) {
				$h = strtolower($h);
				$v = strtolower($v);

				if ($h == "content-type") {
					$default_content_type = false;
					$json_content = $v == "application/json";
					$form_content = $v == "application/x-www-form-urlencoded";
				}

				array_push($headers, $h . ": " . $v);
			}
		}
		if ($default_content_type) {
			array_push($headers, "content-type: application/json");
		}

		$connect = curl_init();
		curl_setopt($connect, CURLOPT_USERAGENT, "eloom.com.br v" . Api::VERSION);
		curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($connect, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($connect, CURLOPT_CUSTOMREQUEST, $request["method"]);
		curl_setopt($connect, CURLOPT_HTTPHEADER, $headers);

		if (isset($request["params"]) && is_array($request["params"]) && count($request["params"]) > 0) {
			$request["uri"] .= (strpos($request["uri"], "?") === false) ? "?" : "&";
			$request["uri"] .= self::build_query($request["params"]);
		}
		curl_setopt($connect, CURLOPT_URL, self::API_BASE_URL . $request["uri"]);

		if (isset($request["data"])) {
			if ($json_content) {
				if (gettype($request["data"]) == "string") {
					json_decode($request["data"], true);
				} else {
					$request["data"] = json_encode($request["data"]);
				}

				if (function_exists('json_last_error')) {
					$json_error = json_last_error();
					if ($json_error != JSON_ERROR_NONE) {
						throw new Exception("JSON Error [{$json_error}] - Data: " . $request["data"]);
					}
				}
			} else if ($form_content) {
				$request["data"] = self::build_query($request["data"]);
			}

			curl_setopt($connect, CURLOPT_POSTFIELDS, $request["data"]);
		}

		return $connect;
	}

	private static function build_query($params) {
		if (function_exists("http_build_query")) {
			return http_build_query($params, "", "&");
		} else {
			foreach ($params as $name => $value) {
				$elements[] = "{$name}=" . urlencode($value);
			}

			return implode("&", $elements);
		}
	}

	public static function post($request) {
		$request["method"] = "POST";

		return self::exec($request);
	}

	public static function put($request) {
		$request["method"] = "PUT";

		return self::exec($request);
	}

	public static function delete($request) {
		$request["method"] = "DELETE";

		return self::exec($request);
	}

}