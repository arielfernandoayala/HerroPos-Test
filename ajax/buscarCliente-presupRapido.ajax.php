<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxBuscarCliente{

  /*=============================================
  EDITAR CATEGORÍA
  =============================================*/ 

  public $seleccionarClientePresupuestoRapido;
  public $seleccionarClienteVenta;



  public function ajaxMostrarClientePresupRapido(){

    $item = "documento";
    $valor = $this->seleccionarClientePresupuestoRapido;

    $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>"; // BUEN METODO DE DEBUG

    //var_dump($respuesta) ; SI DESCOMETNO ESTO, FALLA

    echo json_encode($respuesta);

  }


  public function ajaxMostrarClienteVenta(){

    $item = "documento";
    $valor = $this->seleccionarClienteVenta;

    $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>"; // BUEN METODO DE DEBUG

    //var_dump($respuesta) ; SI DESCOMETNO ESTO, FALLA

    echo json_encode($respuesta);

  }
}

/*=============================================
MOSTRAR NOMBRE DE CLIENTE EN PRESUPUESTO RAPDIO
=============================================*/ 
if(isset($_POST["seleccionarClientePresupuestoRapido"])){

  $docCliente = new AjaxBuscarCliente();
  $docCliente -> seleccionarClientePresupuestoRapido = $_POST["seleccionarClientePresupuestoRapido"];
  $docCliente -> ajaxMostrarClientePresupRapido();
}

/*=============================================
MOSTRAR NOMBRE DE CLIENTE EN VENTA
=============================================*/ 
if(isset($_POST["seleccionarClienteVenta"])){

  $docCliente = new AjaxBuscarCliente();
  $docCliente -> seleccionarClienteVenta = $_POST["seleccionarClienteVenta"];
  $docCliente -> ajaxMostrarClienteVenta();
}

