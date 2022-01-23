<?php

require_once "../controladores/estadosentrega.controlador.php";
require_once "../modelos/estadosentrega.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxEstadoEntregas{

  /*=============================================
  EDITAR CATEGORÍA
  =============================================*/ 

  public $idVentaAsociada;

  public function ajaxActualizarEstado(){

    $item = "id";
    $valor = $this->idVentaAsociada;

    $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

    //echo $respuesta;

    echo json_encode($respuesta);

  }
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/ 
if(isset($_POST["idVentaAsociada"])){

  $estadoEntrega = new AjaxEstadoEntregas();
  $estadoEntrega -> idVentaAsociada = $_POST["idVentaAsociada"];
  $estadoEntrega -> ajaxActualizarEstado();
}
