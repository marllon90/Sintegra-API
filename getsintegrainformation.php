<?php
require_once 'app/init.php';
if (isset ( $_REQUEST ['cnpj'] )) {
	$validator = new Validator ();
	$cnpj = $_REQUEST ['cnpj'];
	$accesskey = $_REQUEST ['key'];
	$cnpj = preg_replace ( '/[^0-9\_]/', '', $cnpj );
	if ($validator->cnpj ( $cnpj )) {
		$db = DB::getInstance ();
		$db->get ( 'tbl_auth', 'where accesskey like "' . $accesskey . '"' );
		if ($db->count () == 1) {
			$db->get ( 'tbl_empresa', 'WHERE cnpj like "%' . $cnpj . '%"' );
			if ($db->count () > 0) {
				$data ['success'] = true;
				$data ['message'] = 'Sucesso: Localizado na base de dados';
				$db->get ( 'tbl_empresa', 'WHERE cnpj like "%' . $cnpj . '%"' );
				foreach ( $db->results () as $key ) {
					$data ['cnpj'] = $key->cnpj;
					$data ['ie'] = $key->ie;
					$data ['cnpj'] = $key->cnpj;
					$data ['razao_social'] = $key->razao;
					$data ['logradouro'] = $key->logradouro;
					$data ['numero'] = $key->numero;
					$data ['complemento'] = $key->complemento;
					$data ['bairro'] = $key->bairro;
					$data ['municipio'] = $key->municipio;
					$data ['estado'] = $key->estado;
					$data ['cep'] = $key->cep;
					$data ['telefone'] = $key->telefone;
					$data ['atividade'] = $key->atividade;
					$data ['inicio'] = date ( 'd/m/Y', strtotime ( $key->inicio ) );
					$data ['situacao'] = $key->situacao;
					$data ['data_situacao'] = date ( 'd/m/Y', strtotime ( $key->data_situacao ) );
					$data ['regime'] = $key->regime;
					$data ['nfe'] = date ( 'd/m/Y', strtotime ( $key->nfe ) );
				}
			} else {
				$sintegra = new Sintegra ();
				$parser = new Parser ();
				if (strlen ( $sintegra->getSintegraContent ( $cnpj ) ) > 0) {
					if ($parser->getSintegraES ( $sintegra->getSintegraContent ( $cnpj ), 'td', 'valor' )) {
						$data ['success'] = true;
						$data ['message'] = 'Sucesso: Localizado na base de dados';
						$db->get ( 'tbl_empresa', 'WHERE cnpj like "%' . $cnpj . '%"' );
						foreach ( $db->results () as $key ) {
							$data ['cnpj'] = $key->cnpj;
							$data ['ie'] = $key->ie;
							$data ['cnpj'] = $key->cnpj;
							$data ['razao_social'] = $key->razao;
							$data ['logradouro'] = $key->logradouro;
							$data ['numero'] = $key->numero;
							$data ['complemento'] = $key->complemento;
							$data ['bairro'] = $key->bairro;
							$data ['municipio'] = $key->municipio;
							$data ['estado'] = $key->estado;
							$data ['cep'] = $key->cep;
							$data ['telefone'] = $key->telefone;
							$data ['atividade'] = $key->atividade;
							$data ['inicio'] = $key->inicio;
							$data ['situacao'] = $key->situacao;
							$data ['data_situacao'] = $key->data_situacao;
							$data ['regime'] = $key->regime;
							$data ['nfe'] = $key->nfe;
						}
					}
				} else {
					$data ['success'] = false;
					$data ['message'] = 'Erro: Ocorreu uma falha desconhecida';
				}
			}
		} else {
			$data ['success'] = false;
			$data ['message'] = 'Erro: Chave de acesso inválida';
		}
	} else {
		$data ['success'] = false;
		$data ['message'] = 'Erro: CNPJ inválido';
	}
} else {
	
	$data ['success'] = false;
	$data ['message'] = 'Erro: Informe o CNPJ';
}
echo json_encode ( $data );
?>