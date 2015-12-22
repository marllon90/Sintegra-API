<?php
$ini_array = parse_ini_file ( 'config.ini' );
$GLOBALS ['config'] = array (
		'mysql' => array (
				'host' => $ini_array [host],
				'username' => $ini_array [username],
				'password' => $ini_array [password],
				'db' => $ini_array [db] 
		) 
);
spl_autoload_register ( function ($class) {
	require_once 'classes/' . $class . '.php';
} );
