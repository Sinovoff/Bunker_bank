<?class Evento extends ActiveRecord\Model {

	static $before_create = array('creado'); 
	static $before_save   = array('actualizado');

	public function creado(){		$this->fecha = date('Y-m-d H:i:s');	}		
	public function actualizado(){	$this->fechamodificado = date('Y-m-d H:i:s');	}
	
}?>