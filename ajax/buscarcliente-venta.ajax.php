<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxBuscarCliente{

  /*=============================================
  EDITAR CATEGORÍA
  =============================================*/ 

  public $seleccionarClientePresupuestoRapido;


  public function ajaxMostrarCliente(){

    $item = "documento";
    $valor = $this->seleccionarClientePresupuestoRapido;

    $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>"; // BUEN METODO DE DEBUG

    //var_dump($respuesta) ; SI DESCOMETNO ESTO, FALLA

    echo json_encode($respuesta);

  }
}

/*=============================================
MOSTRAR NOMBRE DE CLIENTE
=============================================*/ 
if(isset($_POST["seleccionarClientePresupuestoRapido"])){

  $docCliente = new AjaxBuscarCliente();
  $docCliente -> seleccionarClientePresupuestoRapido = $_POST["seleccionarClientePresupuestoRapido"];
  $docCliente -> ajaxMostrarCliente();
}
