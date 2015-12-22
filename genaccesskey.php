<?php
require_once 'app/init.php';

if (isset ( $_REQUEST ['email'] )) {
	$email = $_REQUEST ['email'];
	$db = DB::getInstance ();
	$db->get ( 'tbl_auth', 'where email like "' . $email . '"' );
	if ($db->count () > 0) {
		$data ['success'] = false;
		$data ['message'] = 'Erro: Este email já possui uma chave de acesso';
	} else {
		$key = hash ( 'sha256', $email . time () );
		if ($db->insert ( 'tbl_auth', array (
				'email' => $email,
				'accesskey' => $key,
				'criacao' => date('c',time ()) 
		) )) {
			$data ['success'] = true;
			$data ['message'] = 'Sua chave de acesso: <b>' . $key . '</b>';
		} else {
			$data ['success'] = false;
			$data ['message'] = 'Erro: Houve uma falha tente novamente mais tarde ';
		}
	}
} else {
	$data ['success'] = false;
	$data ['message'] = 'Erro: Informe um email';
}

echo json_encode ( $data );
