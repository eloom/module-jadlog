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

class Calculo {

	private $codigo;

	private $nome;

	private $alerta;

	private $localidade;

	private $tarifa;

	private $prazo;

	private $valor;

	public function __construct($codigo, $nome, $alerta, $localidade, $tarifa, $prazo, $valor) {
		$this->codigo = $codigo;
		$this->nome = $nome;
		$this->alerta = $alerta;
		$this->localidade = $localidade;
		$this->tarifa = $tarifa;
		$this->prazo = $prazo;
		$this->valor = floatval(str_replace(',', '.', (string)$valor));
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getAlerta() {
		return $this->alerta;
	}

	public function getLocalidade() {
		return $this->localidade;
	}

	public function getTarifa() {
		return $this->tarifa;
	}

	public function canShow() {
		if ($this->getPrazo() != null && $this->getValor() > 0) {
			return true;
		}

		return false;
	}

	public function getPrazo() {
		return $this->prazo;
	}

	public function getValor() {
		return $this->valor;
	}
}