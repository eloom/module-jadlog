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

namespace Eloom\Jadlog\Lib\GetModal;

class Volume {

	public $sku;

	public $quantidade;

	public $valor;

	public $altura;

	public $comprimento;

	public $largura;

	public $peso;

	public $agrupar;

	public function __construct($sku, $quantidade, $valor, $altura, $comprimento, $largura, $peso, $agrupar) {
		$this->sku = $sku;
		$this->quantidade = $quantidade;
		$this->valor = $valor;
		$this->altura = $altura;
		$this->comprimento = $comprimento;
		$this->largura = $largura;
		$this->peso = $peso;
		$this->agrupar = $agrupar;
	}
}