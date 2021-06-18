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

class ConsultarPedido {

	public $CodCliente = null;

	public $Password = null;

	public $NDs = null;

	public function __construct($CodCliente, $Password, $NDs) {
		$this->CodCliente = $CodCliente;
		$this->Password = $Password;
		$this->NDs = $NDs;
	}

}
