<?php
class Parser {
	function nodeContent($n, $outer = false) {
		$d = new DOMDocument ( '1.0' );
		$b = $d->importNode ( $n->cloneNode ( true ), true );
		$d->appendChild ( $b );
		$h = $d->saveHTML ();
		if (! $outer)
			$h = substr ( $h, strpos ( $h, '>' ) + 1, - (strlen ( $n->nodeName ) + 4) );
		return $h;
	}
	function getSintegraES($html, $element, $class) {
		$db = DB::getInstance ();
		$results = array ();
		$query = "//$element" . "[@class='" . $class . "']";
		$dom = new DOMDocument ();
		@$dom->loadHTML ( $html );
		$xpath = new DOMXPath ( $dom );
		$result = $xpath->query ( $query );
		$cnpj = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 0 ) ) );
		$ie = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 1 ) ) );
		
		$razao = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 2 ) ) );
		$logradouro = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 3 ) ) );
		$numero = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 4 ) ) );
		$complemento = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 5 ) ) );
		$bairro = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 6 ) ) );
		$municipio = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 7 ) ) );
		$estado = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 8 ) ) );
		$cep = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 9 ) ) );
		$telefone = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-',
				' ' 
		), '', $this->nodeContent ( $result->item ( 10 ) ) );
		$atividade = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 11 ) ) );
		$inicio = str_replace ( array (
				'&nbsp;',
				'.',
				'-' 
		), '', $this->nodeContent ( $result->item ( 12 ) ) );
		$inicio = explode ( '/', $inicio );
		$inicio = $inicio [2] . '-' . $inicio [1] . '-' . $inicio [0];
		$situacao = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 13 ) ) );
		$data_situacao = str_replace ( array (
				'&nbsp;',
				'.',
				'-' 
		), '', $this->nodeContent ( $result->item ( 14 ) ) );
		$data_situacao = explode ( '/', $data_situacao );
		$data_situacao = $data_situacao [2] . '-' . $data_situacao [1] . '-' . $data_situacao [0];
		$regime = str_replace ( array (
				'&nbsp;',
				'.',
				'/',
				'-' 
		), '', $this->nodeContent ( $result->item ( 15 ) ) );
		$nfe = str_replace ( array (
				'&nbsp;',
				'.',
				'-' 
		), '', $this->nodeContent ( $result->item ( 16 ) ) );
		$nfe = explode ( '/', $nfe );
		$nfe = $nfe [2] . '-' . $nfe [1] . '-' . $nfe [0];
		$db->get ( 'tbl_empresa', 'WHERE cnpj=' . $cnpj );
		if ($db->count () > 0) {
			return false;
		} else {
			if ($db->insert ( 'tbl_empresa', array (
					'cnpj' => $cnpj,
					'ie' => $ie,
					'razao' => $razao,
					'logradouro' => $logradouro,
					'numero' => $numero,
					'complemento' => $complemento,
					'bairro' => $bairro,
					'municipio' => $municipio,
					'estado' => $estado,
					'cep' => $cep,
					'telefone' => $telefone,
					'atividade' => $atividade,
					'inicio' => date ( 'c', strtotime ( $inicio ) ),
					'situacao' => $situacao,
					'data_situacao' => date ( 'c', strtotime ( $data_situacao ) ),
					'regime' => $regime,
					'nfe' => date ( 'c', strtotime ( $nfe ) ) 
			) )) {
				return true;
			} else {
				return false;
			}
		}
	}
}