<?php
/*
 *---------------------------------------------------------------
 * CONFIGURACIONES
 *---------------------------------------------------------------
 *
 * Se definen las variables globales de configuración del sistema.
 */

$_config = array(
	'base_url'				=>'localhost/tesis',
	'default_controller'	=>'Principal',
	'language'				=>'english',
	'charset'				=>'UTF-8',
//	'error_log'				=>TRUE,
//	'error_date_format'		=>'Y-m-d H:i:s',
	'error_404'				=>'',
	'db_autoconn'			=>TRUE
	);

$include_paths = [
	'libs',
	'controllers',
	'languages'
	];

$db_var = array(
	'hostname'				=>'localhost',
	'username'				=>'root',
	'password'				=>'',
	'database'				=>'test',
	'dbdriver'				=>'mysql',
	'dbport'				=>'3306',
	'dbprefix'				=>'',
	'dbdebug'				=>TRUE,
	'charset'				=>'UTF-8'
	);

define('BASEPATH',$_config['base_url']);

?>