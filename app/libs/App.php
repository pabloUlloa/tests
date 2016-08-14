<?php require_once 'app/config.php';
/*
 *---------------------------------------------------------------
 * CLASE PRINCIPAL DEL SISTEMA
 *---------------------------------------------------------------
 */


/**
 * Clase App
 *
 * Carga y controla funciones y variables globales.
 *
 * @author		Pablo Ulloa
 */
class App{

	var $classes = array();
	/**
	 * Construct
	 *
	 * El constructor crea el atributo config donde se cargan los parametros del archivo config.
	 * @return	void
	 */
    function __construct(){
    	global $include_paths;
    	global $db_var;
    	global $_config;
    	$this->config=$_config;
    	$this->config['include_paths']=$include_paths;
    	$this->config['db_var']=$db_var;
    }

	/**
	 * Run
	 *
	 * Esta función carga todos los archivos del sistema y conecta a la base de datos.
	 * @return	void
	 */
	function run(){
		foreach ($this->config['include_paths'] as $inc) {
			$this->preload("app/".$inc,true);
		}
		if($this->config['db_autoconn'])$this->DB->connect($this->config['db_var']);
		$this->init();
	}

	/**
	 * Load
	 *
	 * Esta función carga archivos .php al sistema.
	 * Si $is_dir es verdadero, se considera directorio y se cargan los archivos .php dentro de este.
	 * En caso de que una clase que tenga la propiedad "AUTOLOAD", se instancia automaticamente un objeto de esta clase
	 * @param	path
	 * @param	boolean
	 * @return	Object
	 */
	function preload($f, $is_dir = FALSE){
		if($is_dir){
			$files = scandir($f);
			foreach ($files as $file) {
				$file_=explode(".",$file);
				$ext=$file_[count($file_)-1];
				if($ext=="php")$this->preload($f."/".$file);
			}
		}else{
			$file_ex=pathinfo($f);
			if(array_key_exists('extension', $file_ex)){
				if($file_ex['extension']!="php") return;
			}
			if(file_exists($f) && $file_ex['filename']!="App"){
				$newClass=$this->load($f);
				$this->$newClass= new $newClass;
				array_push($this->classes, $newClass);
			}
		}
	}

	static function load($f){
		require_once $f;
		$fName=pathinfo($f)['filename'];
		if(class_exists($fName))return $fName;
		return FALSE;
	}

	/**
	 * Init
	 *
	 * Esta función llama e inicializa al controlador principal.
	 * @return	void
	 */
	function init(){
		$x=$this->config['default_controller'];
		$this->$x->main();
	}

}

?>