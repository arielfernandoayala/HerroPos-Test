<?php

require_once "../controladores/publicidad.controlador.php";
require_once "../modelos/publicidad.modelo.php";

class AjaxPublicidades{

	/*=============================================
	EDITAR CUENTA
	=============================================*/	

	public $idPublicidad;



	public function ajaxEditarPublicidad(){

		$item = "id";
		$valor = $this->idPublicidad;
		$respuesta = ControladorPublicidades::ctrMostrarPublicidades($item, $valor);

	

		

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CUENTA 
=============================================*/	
if(isset($_POST["idPublicidad"])){

	$publicacion = new AjaxPublicidades();
	$publicacion -> idPublicidad = $_POST["idPublicidad"];
	$publicacion -> ajaxEditarPublicidad();
}