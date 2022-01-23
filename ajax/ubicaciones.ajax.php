<?php

require_once "../controladores/ubicaciones.controlador.php";
require_once "../modelos/ubicaciones.modelo.php";

class AjaxUbicaciones{

	/*=============================================
	EDITAR UBICACIONES
	=============================================*/	

	public $idUbicaciones;



	public function ajaxEditarUbicaciones(){

		$item = "id";
		$valor = $this->idUbicaciones;
		$respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

		

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR UBICACIONES
=============================================*/	
if(isset($_POST["idUbicaciones"])){

	$rubro = new AjaxUbicaciones();
	$rubro -> idUbicaciones = $_POST["idUbicaciones"];
	$rubro -> ajaxEditarUbicaciones();
}