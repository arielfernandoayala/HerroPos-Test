<?php

require_once "../controladores/rubroingresos.controlador.php";
require_once "../modelos/rubroingresos.modelo.php";

class AjaxRubroIngresos{

	/*=============================================
	EDITAR RUBRO INGRESOS
	=============================================*/	

	public $idRubroIngresos;



	public function ajaxEditarRubroIngresos(){

		$item = "id";
		$valor = $this->idRubroIngresos;
		$respuesta = ControladorRubroIngresos::ctrMostrarRubroIngresos($item, $valor);

		

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR RUBRO INGRESOS
=============================================*/	
if(isset($_POST["idRubroIngresos"])){

	$rubro = new AjaxRubroIngresos();
	$rubro -> idRubroIngresos = $_POST["idRubroIngresos"];
	$rubro -> ajaxEditarRubroIngresos();
}