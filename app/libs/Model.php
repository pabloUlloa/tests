<?php
/*
 *---------------------------------------------------------------
 * CLASE DE MODELOS GENÉRICOS
 *---------------------------------------------------------------
 */


/**
 * Clase Model
 *
 * Es la base de los Modelos MVC.
 *
 * @author		Pablo Ulloa
 */
class Model{

	function __construct(){
		global $app;
		foreach ($app as $obj) {
			if(is_object($obj)){
				if(get_class($obj)!="Controller" && 
					get_parent_class($obj)!="Controller" && 
					get_class($obj)!="Model" && 
					get_parent_class($obj)!="Model"){
					$objName=get_class($obj);
					$this->$objName=$obj;
				}
			}
		}
	}

	function load($c){
		$c='app/'.$c.'.php';
		$newClass=App::load($c);
		if($newClass!=FALSE)$this->$newClass = new $newClass;
	}
}

?>