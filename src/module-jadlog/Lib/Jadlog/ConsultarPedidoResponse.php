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

namespace Eloom\Jadlog\Lib\Jadlog;

class ConsultarPedidoResponse {

	private $consultarPedidoReturn = null;

	private $error = null;

	private $events = null;

	private $status;

	private $dataHoraEntrega;

	private $statusList = ['TRANSFERENCIA' => 'Sua encomenda foi transferida para outra unidade Jadlog.',
		'ENTRADA' => 'Sua encomenda deu entrada em uma unidade Jadlog.',
		'EM ROTA' => 'Fique atento(a)! Estamos a caminho para entregar sua encomenda.',
		'EMISSAO' => 'Uma solicitação de emissão foi gerada na unidade Jadlog.',
		'ENTREGUE' => 'Sua encomenda foi entregue.',
		'ANALISE' => 'Ops...! Sua encomenda está em análise com nossa equipe. Em breve você receberá mais detalhes.'
	];

	public function __construct($consultarPedidoReturn) {
		$this->consultarPedidoReturn = $consultarPedidoReturn;
	}

	public function xmlToObject() {
		$xml = simplexml_load_string($this->consultarPedidoReturn);
		$tracking = $xml->Jadlog_Tracking_Consultar;

		if (count($tracking->children()) == 0) {
			$this->error = 'Ainda não constam informações sobre seu localizador. Tente novamente mais tarde.';
		}

		if (isset($tracking->Retorno) && $tracking->Retorno == '-1') {
			$this->error = $tracking->Mensagem->__toString();
		}

		// events
		if (isset($tracking->ND) && count($tracking->ND->Evento)) {
			$this->status = $tracking->ND->Status->__toString();
			$this->dataHoraEntrega = $tracking->ND->DataHoraEntrega->__toString();

			foreach ($tracking->ND->Evento as $e) {
				$this->events[] = new \Eloom\Jadlog\Lib\Jadlog\Evento($e->Codigo->__toString(), $e->DataHoraEvento->__toString(), $e->Descricao->__toString(), $e->Observacao->__toString());
			}
		}

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

	public function hasEvents() {
		if (!is_null($this->events)) {
			return true;
		}

		return false;
	}

	public function listEvents() {
		return $this->events;
	}

	public function toString() {
		return $this->consultarPedidoReturn;
	}

	public function getStatus() {
		if (array_key_exists($this->status, $this->statusList)) {
			return $this->statusList[$this->status];
		}

		return $this->status;
	}

	public function getDataHoraEntrega() {
		return $this->dataHoraEntrega;
	}

	public function isEntregue() {
		return 'ENTREGUE' == $this->getStatusCode();
	}

	public function getStatusCode() {
		return $this->status;
	}
}
