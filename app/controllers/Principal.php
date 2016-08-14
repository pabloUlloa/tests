<?php

class Principal extends Controller{

	function main(){
		$this->load('views/index');
		$this->load('models/Persona');
		var_dump($this);
	}

}


?>