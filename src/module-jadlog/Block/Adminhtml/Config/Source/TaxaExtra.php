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

namespace Eloom\Jadlog\Block\Adminhtml\Config\Source;

class TaxaExtra implements \Magento\Framework\Option\ArrayInterface {

	public function toOptionArray() {
		return [
			['value' => '0', 'label' => __('Não')],
			['value' => '1', 'label' => __('Em percentual')],
			['value' => '2', 'label' => __('Em valor')]
		];
	}
}