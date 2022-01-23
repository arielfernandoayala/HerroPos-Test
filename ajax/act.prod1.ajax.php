<?php

require_once "../controladores/act.prod1.controlador.php";
require_once "../modelos/act.prod1.modelo.php";

require_once "../controladores/ubicaciones.controlador.php";
require_once "../modelos/ubicaciones.modelo.php";

class AjaxActProd1{

  /*=============================================
  EDITAR EN ACT 1
  =============================================*/ 

  public $inputActProd1;
  public $actProd1Ubicacion;

  public function ajaxMostrarActProd1(){

    $item = "id";
    $valor = $this->inputActProd1;

    $respuesta = ControladorActProd1::ctrMostrarActProd1($item, $valor);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>"; // BUEN METODO DE DEBUG

    //var_dump($respuesta) ; SI DESCOMETNO ESTO, FALLA

    echo json_encode($respuesta);

  }

  public function ajaxMostrarDescUbicacion(){

    $item = "id";
    $valor = $this->actProd1Ubicacion;

    $respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>"; // BUEN METODO DE DEBUG

    //var_dump($respuesta) ; //SI DESCOMETNO ESTO, FALLA

    echo json_encode($respuesta);

    //echo "<script>console.log('Debug Objects: " . $respuesta . "' );</script>";

  }
}

/*=============================================
MOSTRAR DATOS DE PRODUCTO
=============================================*/ 
if(isset($_POST["inputActProd1"])){

  $codActProd1 = new AjaxActProd1();
  $codActProd1 -> inputActProd1 = $_POST["inputActProd1"];
  $codActProd1 -> ajaxMostrarActProd1();
}

if(isset($_POST["actProd1Ubicacion"])){

  $descUbicacion = new AjaxActProd1();
  $descUbicacion -> actProd1Ubicacion = $_POST["actProd1Ubicacion"];
  $descUbicacion -> ajaxMostrarDescUbicacion();
}