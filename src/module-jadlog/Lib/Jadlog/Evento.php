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

class Evento {

	private $codigo;

	private $dataHoraEvento;

	private $descricao;

	private $observacao;

	private $statusList = ['TRANSFERENCIA' => 'Sua encomenda foi transferida para outra unidade Jadlog.',
		'ENTRADA' => 'Sua encomenda deu entrada em uma unidade Jadlog.',
		'EM ROTA' => 'Fique atento(a)! Estamos a caminho para entregar sua encomenda.',
		'EMISSAO' => 'Uma solicitação de emissão foi gerada na unidade Jadlog.',
		'ENTREGUE' => 'Sua encomenda foi entregue.',
		'ANALISE' => 'Ops...! Sua encomenda está em análise com nossa equipe. Em breve você receberá mais detalhes.'
	];

	public function __construct($codigo, $dataHoraEvento, $descricao, $observacao) {
		$this->codigo = trim($codigo);
		$this->dataHoraEvento = trim($dataHoraEvento);
		$this->descricao = trim($descricao);
		$this->observacao = trim($observacao);
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function getDataHoraEvento() {
		return $this->dataHoraEvento;
	}

	public function getDescricao() {
		if (array_key_exists($this->descricao, $this->statusList)) {
			return $this->statusList[$this->descricao];
		}
		return $this->descricao;
	}

	public function getObservacao() {
		return $this->observacao;
	}

}
