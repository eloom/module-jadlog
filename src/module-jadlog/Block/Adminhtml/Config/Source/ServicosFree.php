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

namespace Eloom\Jadlog\Block\Adminhtml\Config\Source;

use Eloom\Jadlog\Model\Carrier;

class ServicosFree implements \Magento\Framework\Option\ArrayInterface {

	private $carrier;

	public function __construct(Carrier $carrier) {
		$this->carrier = $carrier;
	}

	/**
	 * {@inheritdoc}
	 */
	public function toOptionArray() {
		$options = [];
		$options[] = ['value' => 'N', 'label' => 'Nenhum'];

		foreach ($this->carrier->getCode('service') as $k => $v) {
			$options[] = ['value' => $k, 'label' => $v];
		}

		return $options;
	}
}