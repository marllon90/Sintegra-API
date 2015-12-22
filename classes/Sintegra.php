<?php
class Sintegra {
	function getSintegraContent($cnpj) {
		$cnpj = preg_replace ( '/[^0-9\_]/', '', $cnpj );
		$post = array (
				'num_cnpj' => $cnpj,
				'botao' => 'Consultar' 
		);
		$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		$h = curl_init ( 'http://www.sintegra.es.gov.br/resultado.php' );
		curl_setopt ( $h, CURLOPT_USERAGENT, $userAgent );
		curl_setopt ( $h, CURLOPT_POST, true );
		curl_setopt ( $h, CURLOPT_POSTFIELDS, (is_array ( $post ) ? http_build_query ( $post, '', '&' ) : $post) );
		curl_setopt ( $h, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_HEADER, 1 );
		$result = curl_exec ( $h );
		if (strlen ( $result ) > 0) {
			$data ['Sucesss'] = true;
		} else {
			$data ['Success'] = false;
		}
		return $result;
	}
}