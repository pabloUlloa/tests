<?php
/*
 *---------------------------------------------------------------
 * CLASE DE BASES DE DATOS
 *---------------------------------------------------------------
 */


/**
 * Clase DB
 *
 * Carga el driver y controla las conexiones y consultas a bases de datos.
 *
 * @author		Pablo Ulloa
 */
class DB{

	/*
	 * Esta propiedad permite que la clase se cargue automaticamente en el sistema.
	 */
	function setDriver($params = NULL){
		$this->config=$params;
		$DB_Driver=$params['dbdriver'].'_driver';
		require_once 'app/libs/DB_Drivers/'.$DB_Driver.'.php';
		$this->DB_Driver=new $DB_Driver($params);
	}

	function connect(){
		$this->DB_Driver->db_connect();
	}

	function close(){
		$this->DB_Driver->db_close();
	}

	function select($cols){
		$this->DB_Driver->select($cols);
	}

	function from($tables){
		$this->DB_Driver->from($tables);		
	}

	function join($tables, $on){
		$this->DB_Driver->join($tables, $on);
	}

	function where($args){
		$this->DB_Driver->where($args);
	}

	function like($args){
		$this->DB_Driver->like($args);
	}

	function raw($query){
		$this->DB_Driver->raw($query);
	}

	function sort($col, $asc = TRUE){
		$this->DB_Driver->sort($col, $asc);
	}

	function new_conn($hostname, $username, $password, $database, $port = ''){
		$this->DB_Driver->db($database);
	}

	function get($format = 'array'){
		switch ($format) {
			case 'array':
				$this->DB_Driver->get_array();
				break;
			case 'json':
				# code...
				break;
			case 'xml':
				# code
				break;
			default:
				# code...
				break;
		}
	}

	function procedure($procedure){
		$this->DB_Driver->preocedure($procedure);
	}
}

?>