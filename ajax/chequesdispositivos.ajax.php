<?php
require_once "../controladores/chequera.controlador.php";
require_once "../modelos/chequera.modelo.php";

class AjaxChqDispositovos{


  public $id_Cheque;
  public $traerCheque;
  public $bancoCheque;

  public function ajaxTraerChqs(){

    if($this->traerCheque == "ok"){
      //seteo en null para que traiga todos los productos
      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorChequera::ctrMostrarCheques($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else if($this->nombreBanco != ""){

      $item = "banco_chq";
      $valor = $this->nombreBanco;
      $orden = "id";

      $respuesta = ControladorChequera::ctrMostrarCheques($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}



/*=============================================
TRAER CHEQUE
=============================================*/ 

if(isset($_POST["traerCheque"])){

  $traerCheque = new AjaxChqDispositovos();
  $traerCheque -> traerCheque = $_POST["traerCheque"];
  $traerCheque -> ajaxTraerChqs();

}
/*=============================================
TRAER CHEQUE DESDE DISPOSITIVOS
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $nombreBanco = new ajaxTraerChqs();
  $nombreBanco -> nombreBanco = $_POST["nombreBanco"];
  $nombreBanco -> ajaxTraerChqs();

}







