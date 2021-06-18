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

class Errors {

	private static $errors = [
		'999' => 'Erro inesperado.',
		'001' => 'Falha na conexão com a Jadlog. Por favor, tente mais tarde.',
		'002' => 'País de origem/destino deve ser Brasil.',
		'003' => 'Código Postal da Loja está incorreto.',
		'004' => 'Dimensões não encontradas para o produto %s.'
	];

	public static function getMessage($code) {
		if (array_key_exists($code, self::$errors)) {
			return self::$errors[$code];
		} else {
			return self::$errors['999'];
		}
	}

}
