<?php

require_once "../controladores/rubroegresos.controlador.php";
require_once "../modelos/rubroegresos.modelo.php";

class AjaxRubroEgresos{

	/*=============================================
	EDITAR RUBRO EGRESOS
	=============================================*/	

	public $idRubroEgresos;



	public function ajaxEditarRubroEgresos(){

		$item = "id";
		$valor = $this->idRubroEgresos;
		$respuesta = ControladorRubroEgresos::ctrMostrarRubroEgresos($item, $valor);

		

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR RUBRO EGRESOS
=============================================*/	
if(isset($_POST["idRubroEgresos"])){

	$rubro = new AjaxRubroEgresos();
	$rubro -> idRubroEgresos = $_POST["idRubroEgresos"];
	$rubro -> ajaxEditarRubroEgresos();
}